<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\State;
use App\Models\City;
use Illuminate\Http\Request;
use App\Models\DomainPricingList; // For index page domain pricing || Added by mrloffel/ For transfer login page || Added by mrloffel
use Auth;
use Response;
use App\Models\UserAdditional;
use App\Models\UserBilling;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Plan;
use App\Models\DomainPricing;
use App\Models\PaymentMethod;
use App\Models\domain;
use App\Models\GstRate;
use App\Models\Cartitem;
use App\Models\Promotion;
use App\Http\Requests\Frontend\CartRequest;
use DB;
use Log;
use Datatables;

class ShoppingCartController extends Controller
{
	public function index(Request $request)
	{

		$cart = session('cart');

		// unset($cart['total_price']);
		// unset($cart['discount']);

		$items = [];
		if ($cart) {
			foreach ($cart as $key => $value) {
				$value["id"] = $key;
				array_push($items, $value);
			}
		}

		$items = collect($items);

		$items = $this->addServices($items);

		// $setupFee = $items->map(function ($item, $key) {
		// 	foreach ($item as $key => $value) {
		// 		if ($key == 'plan_id' && !empty($value)) {
		// 			$plan = Plan::find($value);
		// 			return   $plan->setup_fee_one_time;
		// 		}
		// 	}
		// });
		$discount = 0.0;

		if ($items->isNotEmpty()) {
			$discount = $this->discount($items);
		}

		$addonsTotal = 0.0;
		if ($items->isNotEmpty()) {
			$addonsTotalCost = $items->map(function ($item, $key) {
				$data =  $this->checkAddons($item['services']);
				return  $data['total'];
			});
			$addonsTotal = $addonsTotalCost->sum();
		}


		//setup fee already add in price $setupFee->sum()
		$sum = $items->sum('price') +  $addonsTotal;

		$total =  number_format($sum, 2);
		$gstRate = GstRate::where('status', 1)->first()->rate;
		$gst = $sum * (float)$gstRate / 100;
		$grandTotal =  number_format(($sum + $gst - $discount), 2);
		$gst = number_format($gst, 2);
		$discount = number_format($discount, 2);


		if ($request->ajax()) {
			return DataTables::of($items)
				->addIndexColumn()
				->editColumn('cycle', function ($row) {
					$plan = Plan::find($row['plan_id']);
					$year = $row['cycle'] == '1' ? ' year' : ' years';
					$firstYear =  isset($plan->price_annually) ? $plan->price_annually : '';
					$secondYear = isset($plan->price_biennially) ? $plan->price_biennially : '';
					$thirdYear = isset($plan->price_triennially) ? $plan->price_triennially : '';
					if (($firstYear == '' && $secondYear == '' && $thirdYear == '' && $row['plan_id'] != "")) {
						$editIcon = '';
					} else if ($firstYear == '0.00' && $secondYear == '0.00' && $thirdYear == '0.00') {
						$editIcon = '';
					} else {
						$editIcon = '<i class="fa fa-pencil sitecolor">';
					}

					$class = 'servicePrice';
					if ($row['plan_id'] == null) {
						$class = 'domainPrice';
					}


					return  "<div class='cycle_value'>" . $row['cycle'] . ' ' . $year . '<div class="pull-right"><a href="#" data-hover="tooltip"   class="editYear ' . $class . '" data-id="' . $row['id'] . '" title="Edit">' . $editIcon . '</i></a></div>' .  "</div>";
				})
				->editColumn('qty', function ($row) {

					// if (str_contains($row['services'], 'Domain Addons')) {
					//     $count = substr_count($row['services'], '<br/>');
					$data = $this->checkAddons($row['services']);
					if ($data) {
						$extraBreak = $data['addon_qty'] == 1 ? '<br/>' : '';
						$qty =  $row['qty'] . "<br/> $extraBreak"   . "<i class='fa'" . str_repeat("<br/>", $data['count'] > 4 ? $data['count'] : $data['count'] - 1) . "</i>";
						$qty .=  1 . '<br/>';
						if ($data['addon_qty'] > 1) {
							$qty .= 1;
						}
						return $qty;
					} else {
						return $row['qty'];
					};
				})

				->editColumn('price', function ($row) {
					$data = $this->checkAddons($row['services']);
					if ($data) {
						$extraBreak = $data['addon_qty'] == 1 ? '<br/>' : '';
						$qty =  'RM ' . number_format($row['price'], 2) . "<br/> $extraBreak" . "<i class='fa'" . str_repeat("<br/>", $data['count'] > 4 ? $data['count'] : $data['count'] - 1) . "</i>";
						$qty .=  'RM ' .  number_format($data['price'][0], 2) . '<br/>';
						if ($data['addon_qty'] > 1) {
							$qty .= 'RM ' .  number_format($data['price'][1], 2);
						}
						return $qty;
					} else {
						return 'RM ' . number_format($row['price'], 2);
					};
				})
				->addColumn('setup_fee', function ($row) {
					if ($row['plan_id']) {
						$plan = Plan::find($row['plan_id']);
						return $plan->setup_fee_one_time;
					}
					return 0.00;
				})


				->addColumn('Delete', function ($row) {


					$btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row['id'] . '" data-original-title="Delete" class="deleteItem"><i class="fa fa-times red"></a>';
					return $btn;
				})
				->with('total', $total)
				->with('gstRate', $gstRate)
				->with('gst', $gst)
				->with('grandTotal', $grandTotal)
				->with('discount', $discount)
				->make(true);
		}


		// $cartItems->services =  array_keys($cart)[0];



		return view('frontend.shopping_cart', compact('total'));
	}


	public function addServices($items)
	{
		$items = $items->map(function ($item, $key) {
			//  $item['services'] = 'sohail afzal';
			$addonsTitle = '';
			if ($item['addons']) {
				$addons = explode(",", $item['addons']);
				$domain_addons = DomainPricing::where('type', 'addons')->whereIn('id', $addons)->get();
				$addonsTitle = "<b>Domain Addons:</b><br/>";
				foreach ($domain_addons as $addons) {
					$addonsTitle .= "<i class='fa icon-arrow-right'>&nbsp;&nbsp;" . $addons->title . ' (RM ' . number_format($addons->price, 2) . ")<br/>";
				}
			}
			$domainRegistration = "<b>Domain Registration:</b> <span class='sitecolor'>" . $item['id'] . "</span><br/>";
			$domainRegistration .= $addonsTitle;

			if ($item['plan_id']) {
				$plan = Plan::find($item['plan_id']);
				$services = "<b>Product Detail: </b> <span class='sitecolor caps'>" . $plan->page  . "</span><br/>";
				$services .= "<b>Service Code: </b> <span class='sitecolor'>" . $plan->service_code  . "</span><br/>";
				$services .= "<b>Hosting Plan: </b> <span class='sitecolor caps'>" . $plan->plan_name  . "</span><br/>";
				$services .= "<b>Server Specifications: </b><br/>";
				foreach ($plan->planFeatureDetails as $feature) {
					if ($feature->description) {
						$services .= "<i class='fa icon-arrow-right'>&nbsp;&nbsp;" . $plan->planFeatureTitle($feature->plan_feature_id) . ': ' . $feature->description . "<br/>";
					}
				}
				// $services .= "<div class='clearfix margin_bottom2'></div>";
				$services .= '<br/>';
				$services .= $domainRegistration;

				$item['services'] = "<div class='pull-left'>" . $services . "</div>";
			} else {
				$item['services'] = $domainRegistration;
			}

			return  $item;
		});

		return $items;
	}

	public function emptyCart()
	{
		unset($cart);
		session()->put('cart', []);
		return Response::json(array(
			'success' => true,
			'errors' => ['message' => 'Removed successfully']
		), 200);
	}

	public function checkAddons($data)
	{

		if (str_contains($data, 'Domain Addons')) {
			$count = substr_count($data, '<br/>');
			$Addons = substr($data, strpos($data, "Domain Addons"));
			$onlyAddons = substr($Addons, strpos($Addons, "<br/>"));
			$addonCount = substr_count($onlyAddons, '<br/>') - 1;
			$price = explode("RM", $onlyAddons);
			$price1 = substr($price[1], 0, 6);
			if ($addonCount > 1) {
				$price2 = substr($price[2], 0, 6);
			} else {
				$price2 = null;
			}
			return $addon = [
				'count' => $count,
				'addon_qty' => $addonCount,
				'price' => [$price1,  $price2],
				'total' => floatval($price1) + floatval($price2)
			];
		} else {
			return null;
		}
	}

	public function discount($items)
	{
		$planIdAndPrice = $items->map(function ($item, $key) {
			$data = [];
			foreach ($item as $key => $value) {
				if ($key == 'plan_id') {
					$data['plan_id'] = $value;
				}
				if ($key == 'price') {
					$data['price'] = $value;
				}
			}
			return $data;
		});

		foreach ($planIdAndPrice as $planId) {
			if ($planId['plan_id']) {
				$discount = Promotion::get_discount($planId['plan_id']);
				if ($discount != null) {
					$discount = json_decode(json_encode($discount));

					if ($discount->discount_by == 'amount') {
						$discount = $discount->discount;
					} else {
						$discount = ($planId['price'] * $discount->discount) / 100;
					}
				} else {
					$discount = 0.0;
				}
			} else {
				$discount = 0.0;
			}

			$discount += $discount;
		}
		return $discount;
	}

	public function get_tld_price(Request $request)
	{
		$id = $request->tld;
		$www = substr($id, 0, 4);
		if($www =='www.'){
			$id = substr($id, 4);
		}
		
		$domainName = strstr($id, '.', true);
		if ($domainName == false) {
			$domainName = $id;
			$domainTld = 'com';
		} else {
			$domainTld = str_replace($domainName . '.', '', $id);
		}

		$domainPriceList =  DB::table('domain_pricing_lists')->where('tld', $domainTld)->first();

		//return response()->json($domainPriceList);
		if ($domainPriceList) {
			$prices = [];
			$pricing = json_decode($domainPriceList->pricing);
			foreach ($pricing as $price) {
				array_push($prices, number_format($price->s,2));
			}
			return response()->json($prices);
		} else {
			return '';
		}
	}

	public function get_price(Request $request)
	{

		$id = $request->tld;
		$cart = session('cart');
		$cart = collect($cart);
		$data = $cart[$id];
		$planId = $data['plan_id'];
		$plan = Plan::find($planId);
		$firstYear =  $plan->price_annually;
		$secondYear = $plan->price_biennially;
		$thirdYear = $plan->price_triennially;

		if ($secondYear == '0.00' && $thirdYear == '0.00') {
			$prices = ["1 year @ RM $firstYear"];
		} else if ($thirdYear == '0.00') {
			$prices = ["1 year @ RM $firstYear", "2 years @ RM $secondYear"];
		} else {
			$prices = ["1 year @ RM $firstYear", "2 years @ RM $secondYear", "3 years @ RM $thirdYear"];
		}

		return response()->json($prices);
	}

	public function update_cycle(Request $request)
	{
		$cart = session('cart');

		$data = $request->cycle;
		$cycle = substr($data, 0, 1);
		$price = explode("RM", $data)[1];
		$cart[$request->id]["cycle"] = $cycle;
		$cart[$request->id]["price"] = str_replace(",", "", $price);
		// return response()->json($price);
		session()->put('cart', $cart);
		return Response::json(array(
			'success' => true,
			'errors' => ['message' => 'Added successfully']
		), 200);
	}

	public function validateUserDomainSearchInput($domain)
	{
		//dd($domain);
		$spaces       = '/\s/';
		$noneUrlChars = '/[!\@\[#$%^&*()+?<>=~\,\?\`\?\;\'\"|_\{\\\}]/';
		$domain       = preg_replace($spaces, '', $domain);
		$domain       = strtolower(preg_replace($noneUrlChars, '', $domain));
		$domainArr    = explode('.', $domain);

		//dd($domainArr);
		$domainRoot   = in_array('www', $domainArr) ? $domainArr[0] : '';
		if (in_array('www', $domainArr)) {
			if (!empty($domain[2]) && (count($domainArr) == 4)) {
				$domain = $domainArr[1] . '.' . $domainArr[2] . '.' . $domainArr[3];
			} else {
				$domain = $domainArr[1] . '.' . $domainArr[2];
			}
		}
		$domainName = strstr($domain, '.', true);
		if ($domainName == false) {
			$domainName = $domain;
			$domainTld = 'com';
		} else {
			$domainTld = str_replace($domainName . '.', '', $domain);
		}

		//check if such tld exist in Database
		$tldExist = DomainPricingList::where('tld', $domainTld)->first();
		$domainTld = $tldExist ? $domainTld : 'com';
		if (!empty($domainRoot)) {
			return [$domainRoot . '.' . $domainName . '.' . $domainTld, $domainTld];
		} else {
			return [$domainName . '.' . $domainTld, $domainTld];
		}
	}

	public function checkoutItems(Request $request)
	{

		$form_data = $request->all();

		if (empty($form_data['domain-name'])) {
			return $this->index($request);
		}
		$plan_id = '';
		foreach ($form_data['domain-name'] as $domain) {
			$addons = [];
			$price_cycle = $form_data['domain-price-cycle'][$domain];
			$price_cycle = explode('|', $price_cycle);
			$price = $price_cycle[1];
			$cycle = $price_cycle[0];
			if (!empty($form_data['plan_id'][$domain])) {
				$plan_id = $form_data['plan_id'][$domain];
				$plan_details = Plan::where('id', $plan_id)->first();
				$price = $plan_details->price_annually + $plan_details->setup_fee_one_time + $price;
			}
			if (!empty($form_data['domain-addon'][$domain])) {
				$addons = $form_data['domain-addon'][$domain];
				$addons = implode(',', $addons);
			}

			$type = $form_data['type'][$domain];
			$id = $domain;
			$cart = session()->get('cart');
			$cart_data = [
				'price'         => $price_cycle[1],
				'cycle'         => $price_cycle[0],
				'addons'     => $addons,
				'plan_id'     => $plan_id,
				'qty'        => 1,
				'page'         => '',
				'type'        => $type
			];

			// $cart[$id]["price"] = $price;
			// $cart[$id]["plan_id"]	= $plan_id;
			// $cart[$id]["addons"]	= $addons;
			// $cart[$id]["cycle"]  = $cycle;
			if (!$cart) {

				$cart = [$id => $cart_data];
				session()->put('cart', $cart);
			}
			if (isset($cart[$id])) {
				$cart[$id]["price"] = $price;
				$cart[$id]["plan_id"]    = $plan_id;
				$cart[$id]["addons"]    = $addons;
			}
			session()->put('cart', $cart);
		}

		return redirect('/shopping_cart');
	}

	public function add_to_cart(Request $request)
	{

		if ($request->type != '') {
			$type = $request->type;
		} else {
			$type = 1;
		}
		if ($request->cycle != '') {
			$cycle = $request->cycle;
		} else {
			$cycle = 1;
		}

		$form = array();
		$form['services'] = $id = $request->domain;
		$form['cycle']         = $request->cycle;
		$form['qty']         = $request->qty;
		$form['price'] = $price = $request->price;
		$form['plan_id']     = $request->plan_id;
		$form['page']         = $request->page;
		$form['type']        = $type;
		$form['addons']        = '';
		// Added by rejohn  
		if ($request->price != '') {
			$form['domain_cycle']    = $request->domain_cycle;
			$form['domain_price']    = $price;
		} else {
			$form['domain_cycle']    = '';
			$form['domain_price']    = '';
		}

		if ($form['plan_id']) {
			$plan_details = Plan::where('id', $form['plan_id'])->first();
			if ($plan_details->price_type == 'Recurring')
				$price = $plan_details->price_annually + $plan_details->setup_fee_one_time;

			if ($plan_details->price_type == 'One Time')
				$price = $plan_details->price_one_time + $plan_details->setup_fee_one_time;

			if ($plan_details->price_type == 'Free')
				$price = $price;
		}
		// $res 		   = $this->add_to_cart_cookies($form);
		$cart = session()->get('cart');
		$cart_data = [
			'cycle'            => $cycle,
			'qty'             => $form['qty'],
			'price'         => $price,
			'plan_id'         => $form['plan_id'],
			'page'             => $form['page'],
			'type'            => $form['type'],
			'addons'        => $form['addons'],
			'domain_cycle'    => $form['domain_cycle'],
			'domain_price'    => $form['domain_price']
		];

		if (!$cart) {
			$cart = [$id => $cart_data];
			session()->put('cart', $cart);
			return Response::json(array(
				'success' => true,
				'errors' => ['message' => 'Added successfully']
			), 200);
		}
		if (isset($cart[$id])) {
			return Response::json(array(
				'success' => true,
				'errors' => ['message' => 'Item already in cart']
			), 200);
		}
		$cart[$id] = $cart_data;
		session()->put('cart', $cart);
		return Response::json(array(
			'success' => true,
			'errors' => ['message' => 'Added successfully']
		), 200);
	}

	public function checkout_login(Request $request)
	{
		$total_price = $request->total_price;
		$discount    = $request->discount;
		$gst_rate    = $request->gst_rate;

		//add total price and discount to session
		$cart = session()->get('cart');

		// echo '<pre/>'; print_r($cart);

		$cart['total_price'] = $total_price;
		$cart['discount']    = $discount;
		session()->put('cart', $cart);

		// print_r($cart); exit;

		if ($total_price != null && $total_price != "") {
			$user_info = User::with('client')->where('id', Auth::id())->first();
			if ($user_info->client->state_id != null) {
				$state = $this->get_state($user_info->client->state_id);
				$state = $state[0];
			}

			if ($user_info->client->city_id != null) {
				$city = $this->get_city($user_info->client->city_id);
				$city = $city[0];
			}
			$pm = PaymentMethod::all();
			return view('frontend.checkout_login', compact('pm', 'user_info', 'state', 'city', 'total_price', 'gst_rate'));
		}
	}

	public function get_state($state_id)
	{
		return State::where('id', $state_id)->pluck('name');
	}
	public function get_city($city_id)
	{
		return City::where('id', $city_id)->pluck('name');
	}

	public function order_confirmation_login(Request $request)
	{
		$cart = session()->get('cart');

		// print_r($cart);exit;
		// dd($request->all());
		// die;
		// if($request->purchase_amount == 0.00){
		// 	$return_data = [
		// 		'update_status'  	   => False,
		// 		'update_message' 		 => 'Please add some products to go further'
		// 	];
		// 	return redirect('/shopping_cart')->with($return_data);
		// }
		if (!empty($request->billing['address'])) {
			//check exist
			$item = UserBilling::where('user_id', Auth::id())->first();
			if ($item) {
				$item->delete();
				$save = UserBilling::create($request->billing);
			} else {
				$save = UserBilling::create($request->billing);
			}
		}

		if (!empty($request->additional['address'])) {
			$item = UserAdditional::where('user_id', Auth::id())->first();
			if ($item) {
				$item->delete();
				$save = UserAdditional::create($request->additional);
			} else {
				$save = UserAdditional::create($request->additional);
			}
		}
		//dd($request->all());
		if (empty($request->orderId)) {
			$form                    = new Order;
			$form->user_id           = Auth::id();
			$form->transaction_id    = str_random(17);
			$form->payer_id          = str_random(13);
			$form->total_amount      = $request->purchase_amount;
			$form->gst_rate          = $request->gst_rate_amount;
			$form->payment_method_id = $request->paid_by;
			$form->discount          = isset($cart['discount']) ? $cart['discount'] : 0;
			$form->status            = 'INCOMPLETE';
			$form->payment_date      = date('Y-m-d');
			$form->object            = serialize($request->detail);
			$form->save();
		}
		//adding item into order items table after payment success
		// $cart_items = Cartitem::all();

		//dd($cart_items);
		$cartitems = array();

		if (session('cart')) {
			$i = 0;
			foreach (session('cart') as $key => $value) {
				//exception data
				if (!in_array($key, ['discount', 'total_price'])) {
					if ($value['plan_id'] != '') {
						$plan_id = $value['plan_id'];
					} else {
						$plan_id = '';
					}
					$price        = $value['price'];
					$domain_price = (isset($value['domain_price']) && $value['domain_price'] != '') ? $value['domain_price'] : 0;

					$cartitems[$key]['user_id']      = Auth::id();
					$cartitems[$key]['order_id']     = $form->id;
					$cartitems[$key]['services']     = $key;
					$cartitems[$key]['cycle']        = $value['cycle'];
					$cartitems[$key]['domain_cycle'] = $value['cycle'];
					$cartitems[$key]['qty']          = $value['qty'];
					$cartitems[$key]['price']        = $price;
					$cartitems[$key]['domain_price'] = $domain_price;
					$cartitems[$key]['plan_id']      = $plan_id;
					$cartitems[$key]['type']         = $value['type'];
					if (isset($value['addons']))
						$cartitems[$key]['addons'] = json_encode($value['addons']);
					$i++;
				}
			}
		}
		// dd($cartitems);
		//adding item into order items table after payment success - end
		OrderItem::insert($cartitems);
		$domainArr = array();
		if (!empty($request->paid_by) && in_array($request->paid_by, [2, 3, 4])) {
			foreach (session('cart') as $key => $value) {
				//exception data
				if (!in_array($key, ['discount', 'total_price'])) {
					$domainArr[$key]['user_id']     = Auth::id();
					$domainArr[$key]['name']         = $key;
					$domainArr[$key]['status']      = "Active";
					$domainArr[$key]['created_at']  = date('Y-m-d');
					$domainArr[$key]['exp_date']    = date('Y-m-d', strtotime('+' . $value['cycle'] . 'years'));
					$domainArr[$key]['updated_at']  = date('Y-m-d');
				}
			}
			//Adding domain information to domain table after payment success
			domain::insert($domainArr);
		}

		// Cartitem::truncate(); //empty cartitem
		$cart = session()->get('cart');
		unset($cart);
		session()->put('cart', []);
		$orderID = !empty($request->orderId) ? $request->orderId : $form->transaction_id;
		$name      = "domain";
		return view('frontend.order_confirmation_login', compact('orderID', 'name'));
	}

	public function empty_cart(Request $request)
	{

		$cart = session()->get('cart');
		if ($request->has('id')) {

			if (isset($cart[$request->id])) {
				unset($cart[$request->id]);
				session()->put('cart', $cart);
			}
			session()->flash('success', 'successfully removed!');
			return Response::json(array(
				'success' => true,
				'errors' => ['message' => 'Removed successfully']
			), 200);
		} else {
			unset($cart);
			session()->put('cart', []);
			return Response::json(array(
				'success' => true,
				'errors' => ['message' => 'Removed successfully']
			), 200);
		}
	}

	public function save_before_payment(Request $request)
	{

		if (!empty($request->billing['address'])) {
			//check exist
			$item = UserBilling::where('user_id', Auth::id())->first();
			if ($item) {
				$item->delete();
				$save = UserBilling::create($request->billing);
			} else {
				$save = UserBilling::create($request->billing);
			}
		}

		if (!empty($request->additional['address'])) {
			$item = UserAdditional::where('user_id', Auth::id())->first();
			if ($item) {
				$item->delete();
				$save = UserAdditional::create($request->additional);
			} else {
				$save = UserAdditional::create($request->additional);
			}
		}
		return Response::json(array(
			'success' => true,
			'errors' => ['message' => 'Removed successfully']
		), 200);
	}

	public function payment_done(Request $request)
	{
		$cart = session()->get('cart');
		// Log::info(print_r($request->data, true));
		// print_r($request->data);
		// echo '<pre>';
		// print_r(session)
		// dd(session('cart'));
		if (!empty($request->data)) {
			$form                      = new Order;
			$form->user_id           = Auth::id();
			$form->transaction_id    = $request->data['orderID'];
			$form->payer_id          = $request->data['payerID'];
			$form->total_amount      = $request->detail['purchase_units'][0]['amount']['value'];
			$form->payment_method_id = 7;
			$form->status            = $request->detail['status'];
			$form->discount          = isset($cart['discount']) ? $cart['discount'] : 0;
			$form->payment_date      = date('Y-m-d');
			$form->object            = serialize($request->detail);

			if ($form->save()) {

				$cartitems = array();
				if (session('cart')) {
					foreach (session('cart') as $key => $value) {
						//exception data
						if (!in_array($key, ['discount', 'total_price'])) {
							if ($value['plan_id'] != '') {
								$plan_id = $value['plan_id'];
							} else {
								$plan_id = '';
							}
							if (!empty($value['addons'])) {
								$addons = $value['addons'];
							} else {
								$addons = '';
							}
							$price        = $value['price'];
							$domain_price = (isset($value['domain_price']) && $value['domain_price'] != '') ? $value['domain_price'] : 0;

							$cartitems[$key]['user_id']      = Auth::id();
							$cartitems[$key]['order_id']     = $form->id;
							$cartitems[$key]['services']     = $key;
							$cartitems[$key]['cycle']        = $value['cycle'];
							$cartitems[$key]['qty']          = $value['qty'];
							$cartitems[$key]['price']        = $price;
							$cartitems[$key]['plan_id']      = $plan_id;
							$cartitems[$key]['type']         = $value['type'];
							$cartitems[$key]['addons']       = $addons;
							$cartitems[$key]['domain_cycle'] = $value['domain_cycle'];
							$cartitems[$key]['domain_price'] = $domain_price;
						}
					}
				}

				OrderItem::insert($cartitems);

				//adding item into order items table after payment success - end

				foreach (session('cart') as $key => $value) {
					//exception data
					if (!in_array($key, ['discount', 'total_price'])) {
						$domainArr[$key]['user_id']     = Auth::id();
						$domainArr[$key]['name']         = $key;
						$domainArr[$key]['status']      = "Active";
						$domainArr[$key]['created_at']  = date('Y-m-d');
						$domainArr[$key]['exp_date']    = date('Y-m-d', strtotime('+' . $value['cycle'] . 'years'));
						$domainArr[$key]['updated_at']  = date('Y-m-d');
					}
				}
				//Adding domain information to domain table after payment success
				domain::insert($domainArr);

				unset($cart);
				session()->put('cart', []);
				return Response::json(array(
					'success' => true,
					'errors' => ['message' => 'Payment Done successfully']
				), 200);
			} else {
				return Response::json(array(
					'success' => false,
					'errors' => ['message' => 'errror found, try again later']
				), 200);
			}
		}
		return Response::json(array(
			'success' => false,
			'errors' => ['message' => 'errror found, try again later']
		), 200);
	}

	public function dedicatedServersShoppingCart(Request $request)
	{
		dd($request->all());
	}

	public function getDomainPriceByYear($domain, $year)
	{
		list($filteredDomain, $tld) = $this->validateUserDomainSearchInput($domain);
		if (!empty($tld)) {
			$findedDomainPrice = DomainPricingList::where([['type', 'new'], ['tld', $tld]])->first();
			$findedDomainPrice = json_decode($findedDomainPrice->pricing, true);
			if (!empty($findedDomainPrice) && !empty($findedDomainPrice[$year])) {
				return $findedDomainPrice[$year]['s'];
			}
		}

		return 0;
	}

	// Added By Rejohn
	public function update_cart(Request $request)
	{
		$oldCart = session()->get('cart');

		if ($request->update_field == 'year') {
			$newCart = array();
			foreach ($oldCart as $key => $value) {
				foreach ($value as $k => $val) {
					if ($key == $request->domain && $k == 'cycle') {
						$newCart[$key][$k] = $request->year;
					} else if ($key == $request->domain && $k == 'price') {
						$newPrice = $this->getDomainPriceByYear($request->domain, (int) $request->year);
						$newCart[$key][$k] = $newPrice == 0 ? $val : $newPrice;
						//$newCart[$key][$k] = floatval($request->selected_price);
					} else {
						$newCart[$key][$k] = $val;
					}
				}
			}
			// dd($request->domain, $oldCart, $newCart);
			unset($oldCart);
			session()->put('cart', $newCart);

			session()->flash('success', 'successfully Update!');
			return Response::json(array(
				'success' => true,
				'errors' => ['message' => 'Update successfully'],
				'data' => floatval($request->selected_price),
			), 200);
		}

		if ($request->update_field == 'quantity') {
			$newCart = array();
			foreach ($oldCart as $key => $value) {
				foreach ($value as $k => $val) {
					if ($key == $request->domain && $k == 'qty') {
						$newCart[$key][$k] = $request->quantity;
					} else if ($key == $request->domain && $k == 'price') {
						$newPrice = $this->getDomainPriceByYear($request->domain, (int) $request->year);
						$newCart[$key][$k] = $newPrice == 0 ? $val : $newPrice;
					} else {
						$newCart[$key][$k] = $val;
					}
				}
			}
			unset($oldCart);
			session()->put('cart', $newCart);

			session()->flash('success', 'successfully Update!');
			return Response::json(array(
				'success' => true,
				'errors' => ['message' => 'Update successfully']
			), 200);
		}

		if ($request->update_field == 'domain_cycle') {
			$newCart = array();
			foreach ($oldCart as $key => $value) {
				foreach ($value as $k => $val) {
					if (
						$key == $request->domain && $k == 'domain_cycle'
					) {
						$newCart[$key][$k] = $request->year;
					} else {
						$newCart[$key][$k] = $val;
					}
				}
			}
			unset($oldCart);
			session()->put('cart', $newCart);

			session()->flash('success', 'successfully Update!');
			return Response::json(array(
				'success' => true,
				'errors' => ['message' => 'Update successfully']
			), 200);
		}
	}
}
