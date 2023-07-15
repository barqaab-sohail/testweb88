<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Cartitem;
use App\Models\User;
use App\Models\State;
use App\Models\City;
use App\Models\PageCms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
//use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;
use App\Models\DomainPricing; // For index page domain pricing || Added by mrloffel
use App\Models\DomainPricingList; // For index page domain pricing || Added by mrloffel
use Carbon\Carbon; // For transfer login page || Added by mrloffel
use Illuminate\Support\Facades\Validator;
use Session;
use Storage;
use Auth;
use Response;
use App\Libs\Transport;
use App\Models\UserAdditional;
use App\Models\UserBilling;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PlanFeature;
use App\Models\Plan;
use App\Models\PaymentMethod;
use App\Models\domain;
use DB;
use Log;

class ShoppingCartController extends Controller
{
	public function index(Request $request) {
		// print "<pre>";print_r($request->all());exit;
		$info = "";
		$page = "";
		
		if($request->has('page')){
			$page = $request->page;
		}
		if($request->has('info')){
			$info = $request->info;
		}

		// if($page){
		// 	$featured_plans = PlanFeature::where('page', $page)->where('status', 1)->get();
		// }
		
        $server_configuration_details = $request->server_configuration_details;
		$cartitems 		 = Cartitem::with('user')->where('user_id', Auth::id())->get()->toArray();
		$domain_pricings = DomainPricing::where('type', 'addons')->where('status','1')->get();
		if (Auth::id() == null) {
			$cookie           = isset($_COOKIE['cart_items_cookie2']) ? $_COOKIE['cart_items_cookie2'] : "";
			$cookie           = stripslashes($cookie);
			$saved_cart_items = json_decode($cookie, true);

			$cartitems 		  = array();
			if (isset($saved_cart_items)) {
				$i = 0;
				foreach ($saved_cart_items as $key => $value) {
					$cartitems[$i]['services'] 	= $key;
					$cartitems[$i]['cycle']    	= $value['cycle'];
					$cartitems[$i]['qty']      	= $value['qty'];
					$cartitems[$i]['price']    	= $value['price'];
					$cartitems[$i]['plan_id']   = $value['plan_id'];
					$cartitems[$i]['page']   	= $value['page'];
					if (isset($value['addons']))
					$cartitems[$i]['addons'] = $value['addons'];
					$i++;

				}
			}

		}
		
		// print "<pre>";print_r($cartitems);exit("here");
		$domain = $request->search_domain;
        $server_configuration_details =  json_decode($server_configuration_details);
//		dd($server_configuration_details,$request->all());
		return view('frontend.shopping_cart', compact('domain', 'server_configuration_details', 'cartitems', 'domain_pricings', 'info', 'page', 'plans', 'data', 'featured_plans'));
	}

	public function checkoutItems (Request $request)
	{
		$user_id 	 = Auth::id();
		$form_data = $request->all();

		// print "<pre>";print_r($form_data);exit("ci");

		if (empty($form_data['domain-name']))
		{
			return $this->index($request);
		}

		foreach ($form_data['domain-name'] as $domain )
		{
			$item = NULL;

			if ($user_id)
			{
				$item = Cartitem::where('user_id', $user_id)
						->where('services', $domain)
						->first();
			}

			if (!$item)
			{
				$price_cycle = $form_data['domain-price-cycle'][$domain];
				$price_cycle = explode('|', $price_cycle);



				$addons = [];

				if (!empty($form_data['domain-addon'][$domain]))
				{
					$addons = $form_data['domain-addon'][$domain];
				}

				$domain_data = [
					'domain' 	=> $domain,
					'price'	 	=> $price_cycle[1],
					'cycle'	 	=> $price_cycle[0],
					'addons' 	=> $addons,
					'plan_id' 	=> '',
					'page' 		=> ''
				];

				Cartitem::addItem($user_id, $domain_data);
			}
		}

		if (empty($user_id))
		{
			foreach ($form_data['domain-name'] as $domain)
			{
				$price_cycle = $form_data['domain-price-cycle'][$domain];
				$price_cycle = explode('|', $price_cycle);

				$cart_data = [
					'services' => $domain,
					'cycle'		 => $price_cycle[0],
					'qty' 		 => 1,
					'price' 	 => $price_cycle[1]
				];

				$this->add_to_cart_cookies($cart_data);
			}
		}

		return redirect('/shopping_cart');
	}

	public function add_to_cart(Request $request){

		if(Auth::check()){
			//check already exist in cart or not
			$item = Cartitem::where('user_id', Auth::id())
					->where('services', $request->domain)
					->first();
			if($item){
				return Response::json(array(
	               'success' => true,
	               'errors' => ['message' => 'Item already added in cart. Continue to Cart...' ]
	           ), 200);
			}
			//check already exist in cart or not - end
			//ADd UP THE PRICE OF THE SERVICE, IF attached

			$form 				= new Cartitem;
	        $form->user_id 		= Auth::id();
	        $form->services 	= $request->domain;
	        $form->cycle 		= $request->cycle;
	        $form->qty 			= $request->qty;
	        $price 				= $request->price;
	        
	        if($request->plan_id){
	        	$form->plan_id 		= $request->plan_id;
	        	$plan_details = Plan::where('id', $request->plan_id)->first();
	        	$price = $plan_details->price_annually + $plan_details->setup_fee_one_time + $price;
	        } 

	        $form->price 		= $price;

	        if($request->page) $form->page 		= $request->page;

	        if($request->has('addons')){
	        	$form->addons = implode(',', $request->addons);
	        }

	        $form->save();
		}else{
			//dd(Cookie::get('cart_items'));
		//	dd(Cookie::get('cart_items'));
			$form = array();
			//(object)[];

	        $form['services'] 	= $request->domain;
	        $form['cycle'] 		= $request->cycle;
	        $form['qty'] 		= $request->qty;
	        $form['price'] 		= $request->price;
	        $form['plan_id'] 	= $request->plan_id;
	        $form['page'] 		= $request->page;

	        $res 		   = $this->add_to_cart_cookies($form);
	        if($res == 'exist'){
	        	return Response::json(array(
	               'success' => false,
	               'errors' => ['message' => 'Item already added in cart' ]
	           ), 200);
	        }
	        //dd(Cookie::make('cart_items', $form, 10080));
			//dd(Cookie::queue('cart_items', $form, 10080));
		}

		//dd($cartitems->toArray());
		return Response::json(array(
               'success' => true,
               'errors' => ['message' => 'Added successfully' ]
           ), 200);
	}

	public function checkout_login(Request $request){

		$total_price = $request->total_price;

		if($total_price != null && $total_price != ""){
			$user_info = User::with('client')->where('id', Auth::id())->first();
			if($user_info->client->state_id != null){
				$state = $this->get_state($user_info->client->state_id);
				$state = $state[0];
			}

			if($user_info->client->city_id != null){
				$city = $this->get_city($user_info->client->city_id);
				$city = $city[0];
			}
			$pm = PaymentMethod::all();
			return view('frontend.checkout_login', compact('pm','user_info', 'state', 'city', 'total_price'));
		}

	}

	public function get_state($state_id) {
		return State::where('id', $state_id)->pluck('name');
	}
	public function get_city($city_id) {
		return City::where('id', $city_id)->pluck('name');
	}

	public function order_confirmation_login(Request $request){
		//dd($request->all());
		if(!empty($request->billing['address'])){
			//check exist
			$item = UserBilling::where('user_id', Auth::id())->first();
			if($item){
				$item->delete();
				$save = UserBilling::create($request->billing);
			}else{
				$save = UserBilling::create($request->billing);
			}
		}

		if(!empty($request->additional['address'])){
			$item = UserAdditional::where('user_id', Auth::id())->first();
			if($item){
				$item->delete();
				$save = UserAdditional::create($request->additional);
			}else{
				$save = UserAdditional::create($request->additional);
			}
		}
		//dd($request->all());
		if (empty($request->orderId)) {
			$form 		             = new Order;
	        $form->user_id           = Auth::id();
	        $form->transaction_id    = str_random(17);
	        $form->payer_id          = str_random(13);
	        $form->total_amount      = $request->purchase_amount;
	        $form->payment_method_id = $request->paid_by;
	        $form->status            = 'INCOMPLETE';
	        $form->payment_date      = date('Y-m-d');
	        $form->object            = serialize($request->detail);
	        $form->save();
		}
		//adding item into order items table after payment success
		$cart_items = Cartitem::all();
		//dd($cart_items);
		$data_array = array();
		foreach ($cart_items as $key => $value) {
			$data_array[$key]['user_id']  = Auth::id();
			$data_array[$key]['order_id'] = $form->id;
			$data_array[$key]['services'] = $value->services;
			$data_array[$key]['cycle']    = $value->cycle;
			$data_array[$key]['qty']      = $value->qty;
			$data_array[$key]['price']    = $value->price;
			$data_array[$key]['addons']   = $value->addons;
		}
		//adding item into order items table after payment success - end
		OrderItem::insert($data_array);

		if(!empty($request->paid_by) && in_array($request->paid_by, [2, 3, 4])) {
			foreach ($cart_items as $key => $value) {
				$domainArr[$key]['user_id']     = Auth::id();
				$domainArr[$key]['name'] 	    = $value->services;
				$domainArr[$key]['status']      = "Active";
				$domainArr[$key]['created_at']  = date('Y-m-d');
				$domainArr[$key]['exp_date']    = date('Y-m-d', strtotime('+'.$value->cycle.'years'));
				$domainArr[$key]['updated_at']  = date('Y-m-d');
			}
			//Adding domain information to domain table after payment success
			domain::insert($domainArr);
		}

		Cartitem::truncate(); //empty cartitem
		$orderID = !empty($request->orderId) ? $request->orderId : $form->transaction_id;
		$name 	 = "domain";
		return view('frontend.order_confirmation_login', compact('orderID', 'name'));

	}

	public function empty_cart(Request $request){

		if(Auth::id() == null){

			if($request->has('id')){

			$cookie = isset($_COOKIE['cart_items_cookie2']) ? $_COOKIE['cart_items_cookie2'] : "";
			$cookie = stripslashes($cookie);
			$saved_cart_items = json_decode($cookie, true);
				if(count($saved_cart_items) > 0 && $saved_cart_items[$request->id]){
					unset($saved_cart_items[$request->id]);
					$json = json_encode($saved_cart_items, true);
				    setcookie("cart_items_cookie2", $json, time() + (86400 * 30), '/'); // 86400 = 1 day
				    $_COOKIE['cart_items_cookie2']=$json;
					return Response::json(array(
		               'success' => true,
		               'errors' => ['message' => 'Removed successfully' ]
		           ), 200);
				}
			}

			if($request->has('ids')){
				$saved_cart_items = array();
				$json = json_encode($saved_cart_items, true);
			    setcookie("cart_items_cookie2", $json, time() + (86400 * 30), '/'); // 86400 = 1 day
			    $_COOKIE['cart_items_cookie2']=$json;
				return Response::json(array(
	               'success' => true,
	               'errors' => ['message' => 'Removed successfully' ]
	           ), 200);
			}
		}

		if($request->has('id')){
			$cart = Cartitem::where('id', $request->id)->delete();
			if($cart){
				return Response::json(array(
	               'success' => true,
	               'errors' => ['message' => 'Removed successfully' ]
	           ), 200);
			}else{
				return Response::json(array(
	               'success' => false,
	               'errors' => ['message' => 'errror found, try again later' ]
	           ), 200);
			}
		}

		$cart = Cartitem::WhereIn('id', $request->ids)->delete();
		if($cart){
			return Response::json(array(
               'success' => true,
               'errors' => ['message' => 'Removed successfully' ]
           ), 200);
		}else{
			return Response::json(array(
               'success' => false,
               'errors' => ['message' => 'errror found, try again later' ]
           ), 200);
		}
		//dd($request->ids);
	}

	public function save_before_payment(Request $request){

		if(!empty($request->billing['address'])){
			//check exist
			$item = UserBilling::where('user_id', Auth::id())->first();
			if($item){
				$item->delete();
				$save = UserBilling::create($request->billing);
			}else{
				$save = UserBilling::create($request->billing);
			}
		}

		if(!empty($request->additional['address'])){
			$item = UserAdditional::where('user_id', Auth::id())->first();
			if($item){
				$item->delete();
				$save = UserAdditional::create($request->additional);
			}else{
				$save = UserAdditional::create($request->additional);
			}
		}
		return Response::json(array(
               'success' => true,
               'errors' => ['message' => 'Removed successfully' ]
           ), 200);
	}

	public function payment_done(Request $request){

		//Log::info(print_r($request->data, true));
		if(!empty($request->data)){
			$form 		             = new Order;
	        $form->user_id           = Auth::id();
	        $form->transaction_id    = $request->data['orderID'];
	        $form->payer_id          = $request->data['payerID'];
	        $form->total_amount      = $request->detail['purchase_units'][0]['amount']['value'];
	        $form->payment_method_id = 7;
	        $form->status            = $request->detail['status'];
	        $form->payment_date      = date('Y-m-d');
	        $form->object            = serialize($request->detail);

			if($form->save()){

				//adding item into order items table after payment success
				$cart_items = Cartitem::all();

				$data_array = array();
				foreach ($cart_items as $key => $value) {
					$data_array[$key]['user_id']  = Auth::id();
					$data_array[$key]['order_id'] = $form->id;
					$data_array[$key]['services'] = $value->services;
					$data_array[$key]['cycle']    = $value->cycle;
					$data_array[$key]['qty']      = $value->qty;
					$data_array[$key]['price']    = $value->price;
					$data_array[$key]['addons']   = $value->addons;
				}

				OrderItem::insert($data_array);

				//adding item into order items table after payment success - end

				foreach ($cart_items as $key => $value) {
					$domainArr[$key]['user_id']     = Auth::id();
					$domainArr[$key]['name'] 	    = $value->services;
					$domainArr[$key]['status']      = "Active";
					$domainArr[$key]['created_at']  = date('Y-m-d');
					$domainArr[$key]['exp_date']    = date('Y-m-d', strtotime('+'.$value->cycle.'years'));
					$domainArr[$key]['updated_at']  = date('Y-m-d');
				}
				//Adding domain information to domain table after payment success
				domain::insert($domainArr);

				Cartitem::truncate(); //empty cartitem
				return Response::json(array(
	               'success' => true,
	               'errors' => ['message' => 'Payment Done successfully' ]
	           	), 200);
			}else{
				return Response::json(array(
               		'success' => false,
               		'errors' => ['message' => 'errror found, try again later' ]
           		), 200);
			}

		}
		return Response::json(array(
       		'success' => false,
       		'errors' => ['message' => 'errror found, try again later' ]
   		), 200);
	}

	public function add_to_cart_cookies($cart_items_ar){
		//
	$id = $cart_items_ar['services'];
	//isset($_GET['id']) ? $_GET['id'] : "";
	//$quantity = isset($_GET['quantity']) ? $_GET['quantity'] : 1;
	//$page = isset($_GET['page']) ? $_GET['page'] : 1;

	// make quantity a minimum of 1
	//$quantity=$quantity<=0 ? 1 : $quantity;
	$price = $cart_items_ar['price'];
	if($cart_items_ar['plan_id']){
    	//$plan_details = Plan::select('price_monthly')->where('id', $cart_items_ar['plan_id'])->first();
    	//$price = $plan_details['price_monthly'] + $price;
		$plan_details = Plan::where('id', $cart_items_ar['plan_id'])->first();
		$price = $plan_details->price_annually + $plan_details->setup_fee_one_time + $price;
    }

	// add new item on array
	$cart_items[$id]=array(
	    'cycle'			=> $cart_items_ar['cycle'],
	    'qty' 			=> $cart_items_ar['qty'],
	    'price' 		=> $price,
	    'plan_id' 		=> $cart_items_ar['plan_id'],
	    'page' 			=> $cart_items_ar['page']
	);


	// read
	$cookie = isset($_COOKIE['cart_items_cookie2']) ? $_COOKIE['cart_items_cookie2'] : "";
	$cookie = stripslashes($cookie);
	$saved_cart_items = json_decode($cookie, true);

	// if $saved_cart_items is null, prevent null error
	if(!$saved_cart_items){
	    $saved_cart_items=array();
	}

	// check if the item is in the array, if it is, do not add
	if(array_key_exists($id, $saved_cart_items)){
		return 'exist';
		/*return Response::json(array(
	               'success' => false,
	               'errors' => ['message' => 'Item already added in cart' ]
	           ), 200);*/
	//	dd("exist");
	    // redirect to product list and tell the user it was added to cart
	   // header('Location: product.php?id=' . $id . '&action=exists');
	}

	// else, add the item to the array
	else{
		// if cart has contents
		// dd($saved_cart_items , $cart_items);
	    if(count($saved_cart_items)>0){

	        foreach($saved_cart_items as $key=>$value){
	            // add old item to array, it will prevent duplicate keys
	            $price 				= $value['price'];

	            $cart_items[$key]=array(
	                'cycle'			=> $value['cycle'],
				    'qty' 			=> $value['qty'],
				    'price' 		=> $price,
				    'plan_id' 		=> $value['plan_id'],
				    'page' 			=> $value['page']
	            );
	        }
	    }

	    // put item to cookie
	    $json = json_encode($cart_items, true);
	    setcookie("cart_items_cookie2", $json, time() + (86400 * 30), '/'); // 86400 = 1 day
	    $_COOKIE['cart_items_cookie2']=$json;

	    // redirect to product list and tell the user it was added to cart
	   // header('Location: product.php?id=' . $id . '&action=added');
	}
		//
	}

	public function dedicatedServersShoppingCart(Request $request) {
		dd($request->all());
	}
}
