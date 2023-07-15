<?php



namespace App\Http\Controllers\Admin;



use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Models\Article;

use App\Models\Order;

use App\Models\OrderItem; // added

use App\Models\User;

use App\Models\Country;

use App\Models\State;

use App\Models\City;

use App\Models\Client;

use App\Models\Category;

use App\Models\PaymentMethod;

use App\Models\Promotion;

use App\Models\DomainPricing;

use App\Models\DomainPricingList;

use App\Models\Page;

use App\Models\PageCms;

use App\Models\Plan;

use App\Http\Requests\ArticleCreateRequest;

use Illuminate\Support\Facades\Log;

use App\Http\Requests\ArticleUpdateRequest;

use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Input;

use Session;

use DB;

use View;

use PDF;

use File;

use Carbon\Carbon;

use Mail;

use Storage;

use App\Models\domain;

use App\Models\PlanFeature;

use App\Models\PlanFeatureDetail;

use App\Models\GstRate;



use App\Http\Controllers\Frontend\DomainsController;

use Auth;



class OrdersController extends Controller

{

    public function __construct()

    {

        $this->middleware('auth');

        $this->OrderModel = new Order();

        $this->CategoryModel = new Category();

    }



    public function orders_list(Request $request, $per_page = 10)

    {

        // echo "<pre>";

        // print_r($request->all());

        // die



        $sort_by = $request->query('sort');

        // dd($request->all());

        //$articles = Article::orderBy('created_at','desc')->paginate($page);

        //return view('admin.articles.index', ['articles' => $articles, 'select_page' => $page, 'recent_update' => $this->recentUpdate('App\Models\Article')]);

        $keywords = array();

        if ($sort_by === 'total_order_amount') {

            $query = Order::with([

                'user.client.country',

                'payment_method'

            ])->orderBy('total_amount', 'desc');

        } else if ($sort_by === 'country') {

            $query = Order::select('orders.*', 'countries.*')

                ->with([

                    'user.client.country',

                    'payment_method'

                ])

                ->join('users', 'orders.user_id', '=', 'users.id')

                ->join('client_registration_info as client_info', 'users.id', '=', 'client_info.user_id')

                ->join('countries', 'client_info.country_id', '=', 'countries.id')

                ->orderBy('orders.id', 'desc')

                ->orderBy('countries.sortname', 'desc');

            //->orderBy('orders.total_amount', 'desc');

        } else {

            $query = Order::with([

                'user.client.country',

                'payment_method'

            ])->orderBy('id', 'desc');

        }

        //echo $query->toSql();

        //->paginate($per_page);

        // if($request->has('transaction_id') || $request->has('id') || $request->has('client_name') || $request->has('client_id')){

        //dd($request->all());

        //DB::enableQueryLog(); // Enable query log

        if ($request->has('transaction_id')) {



            $find = 'MY-';

            $replace = '';

            $og_txn_id = trim($request->transaction_id);



            $transaction_id = str_replace($find, $replace, $og_txn_id);

            $query->where('transaction_id', $transaction_id);

            $keywords['transaction_id'] = $og_txn_id;

        }





        if ($request->has('id')) {

            $query->OrWhere('id', $request->id);

            $keywords['id'] = $request->id;

        }





        if ($request->has('start') || $request->has('end')) {

            $newDateFormat3 = \Carbon\Carbon::parse($request->start)->format('Y-m-d');

            $newDateFormat4 = \Carbon\Carbon::parse($request->end)->format('Y-m-d');

            $query->OrWhereDate('created_at', '>=', $newDateFormat3);

            $query->WhereDate('created_at', '<=', $newDateFormat4);

            $keywords['start'] = $request->start;

            $keywords['end'] = $request->end;

            //where('created_at', $request->start);

        }



        // if($request->has('end')){

        // 	$query->OrWhereDate('created_at', '<=', $request->end);

        //        $keywords['end'] = $request->end;

        // }



        if ($request->has('total_amount')) {

            $query->OrWhere('total_amount', $request->total_amount);

            $keywords['total_amount'] = $request->total_amount;

        }



        if ($request->has('payment_status')) {



            if ($request->payment_status == 'paid') {

                $status = 'COMPLETED';

                $query->OrWhere('status', $status);

            }

            if ($request->payment_status == 'failed') {

                $status = 'FAILED';

                $query->OrWhere('status', $status);

            }



            if ($request->payment_status != 'none')

                $keywords['payment_status'] = $request->payment_status;

        }



        if ($request->has('client_name')) {

            $client_name = $request->client_name;

            //  $client = explode(' ',$client_name);

            // $fname = isset($client[0]) ? $client[0] : '';

            //   $lname = isset($client[1]) ? $client[1] : '';

            $data = Client::where('first_name', 'Like', '%' . $client_name . '%')->orwhere('last_name', 'Like', '%' . $client_name . '%')->first();







            $client_name = isset($data) ? $data->user_id : '';



            $query->OrWhereHas('user', function ($q) use ($client_name) {

                $q->where('id', '=', $client_name);

            });





            $keywords['client_name'] = $request->client_name;

        }





        if ($request->has('client_id')) {



            $client_id = $request->client_id;

            $find1 = 'B-';

            $find2 = '-MY';

            $replace = '';

            $client_id  = Str_replace($find1, $replace, $client_id);

            $client_id  = Str_replace($find2, $replace, $client_id);

            //remove special chars

            $client_id = preg_replace("/[^0-9]/", "", $client_id);

            $query->OrWhereHas('user', function ($q) use ($client_id) {

                $q->where('id', '=', $client_id);

            });





            $keywords['client_id'] = $request->client_id;

        }



        if ($request->has('payment_method')) {

            $payment_method = PaymentMethod::where('name', '=', $request->payment_method)->first();

            $payment_id = isset($payment_method) ? $payment_method->id : '';

            $query->OrWhere('payment_method_id', $payment_id);

            $keywords['payment_method'] = $request->payment_method;

        }





        //dd(DB::getQueryLog());



        /*if($request->has('page')){



        	}*/



        //}



        $this->data['page'] = $per_page;

        //$this->data['item'] = $item;



        $lastUpdated = $this->OrderModel->getLastUpdated(True);

        // dd($query->get()->toArray());

        $orders = $query->paginate($per_page);



        //$orders = Order::with('user')->orderBy('id','desc')->paginate($per_page);

        //DB::table('orders')->orderBy('id','desc')->with('user')->paginate($per_page);



        //$this->NewsletterModel->getSubscribers($item, $page);



        //// Total user groups

        // $totalOrders = DB::table('orders')->orderBy('id','desc')->get();



        $this->data['countOrders'] = count($query->get());



        $this->data['lastUpdated'] = $lastUpdated;



        $this->data['orders'] = $orders;



        $this->data['success'] = Session::get('response');

        Session::forget('response');



        $this->data['page_title'] = 'Order :: Listing';



        /*if($this->data['countSubscribers'] < $item and $page!=1){

			return Redirect::to('web88cms/newsletter/'.$item.'/1');

		}*/

        $include_notification = False;

        if ($request->isMethod('post')) {

            $include_notification = True;

        }

        $ord = $this->data;

        return view('admin.orders.orders_list')->with(

            [

                'orders' => $ord,

                'keywords' => $keywords,

                'include_notification' => $include_notification

            ]

        );

    }



    public function ordersDynamicData(Request $request)

    {

        if ($request->ajax()) {

            $html = "";

            $per_page = $request->per_page;

            $sort_by = $request->query('sort');



            $keywords = array();

            if ($sort_by === 'total_order_amount') {

                $query = Order::with([

                    'user.client.country',

                    'payment_method'

                ])->orderBy('total_amount', 'desc');

            } else if ($sort_by === 'country') {

                $query = Order::select('orders.*', 'countries.*')

                    ->with([

                        'user.client.country',

                        'payment_method'

                    ])

                    ->join('users', 'orders.user_id', '=', 'users.id')

                    ->join('client_registration_info as client_info', 'users.id', '=', 'client_info.user_id')

                    ->join('countries', 'client_info.country_id', '=', 'countries.id')

                    ->orderBy('orders.id', 'desc')

                    ->orderBy('countries.sortname', 'desc');

                //->orderBy('orders.total_amount', 'desc');

            } else {

                $query = Order::with([

                    'user.client.country',

                    'payment_method'

                ])->orderBy('id', 'desc');

            }

            if ($request->has('transaction_id')) {



                $find = 'MY-';

                $replace = '';

                $og_txn_id = trim($request->transaction_id);



                $transaction_id = str_replace($find, $replace, $og_txn_id);

                $query->where('transaction_id', $transaction_id);

                $keywords['transaction_id'] = $og_txn_id;

            }





            if ($request->has('id')) {

                $query->OrWhere('id', $request->id);

                $keywords['id'] = $request->id;

            }





            if ($request->has('start') || $request->has('end')) {

                $newDateFormat3 = \Carbon\Carbon::parse($request->start)->format('Y-m-d');

                $newDateFormat4 = \Carbon\Carbon::parse($request->end)->format('Y-m-d');

                $query->OrWhereDate('created_at', '>=', $newDateFormat3);

                $query->WhereDate('created_at', '<=', $newDateFormat4);

                $keywords['start'] = $request->start;

                $keywords['end'] = $request->end;

                //where('created_at', $request->start);

            }



            if ($request->has('total_amount')) {

                $query->OrWhere('total_amount', $request->total_amount);

                $keywords['total_amount'] = $request->total_amount;

            }



            if ($request->has('payment_status')) {



                if ($request->payment_status == 'paid') {

                    $status = 'COMPLETED';

                    $query->OrWhere('status', $status);

                }

                if ($request->payment_status == 'failed') {

                    $status = 'FAILED';

                    $query->OrWhere('status', $status);

                }



                if ($request->payment_status != 'none')

                    $keywords['payment_status'] = $request->payment_status;

            }



            if ($request->has('client_name')) {

                $client_name = $request->client_name;

                $data = Client::where('first_name', 'Like', '%' . $client_name . '%')->orwhere('last_name', 'Like', '%' . $client_name . '%')->first();







                $client_name = isset($data) ? $data->user_id : '';



                $query->OrWhereHas('user', function ($q) use ($client_name) {

                    $q->where('id', '=', $client_name);

                });





                $keywords['client_name'] = $request->client_name;

            }





            if ($request->has('client_id')) {



                $client_id = $request->client_id;

                $find1 = 'B-';

                $find2 = '-MY';

                $replace = '';

                $client_id  = Str_replace($find1, $replace, $client_id);

                $client_id  = Str_replace($find2, $replace, $client_id);

                //remove special chars

                $client_id = preg_replace("/[^0-9]/", "", $client_id);

                $query->OrWhereHas('user', function ($q) use ($client_id) {

                    $q->where('id', '=', $client_id);

                });





                $keywords['client_id'] = $request->client_id;

            }



            if ($request->has('payment_method')) {

                $payment_method = PaymentMethod::where('name', '=', $request->payment_method)->first();

                $payment_id = isset($payment_method) ? $payment_method->id : '';

                $query->OrWhere('payment_method_id', $payment_id);

                $keywords['payment_method'] = $request->payment_method;

            }

            //  $this->data['page'] = $per_page;



            $lastUpdated = $this->OrderModel->getLastUpdated(True);

            $total_reocrds = $query->count();

            $orders = $query->paginate($per_page);

            $links = (string)$orders->links();



            $this->data['countOrders'] = count($query->get());



            $this->data['lastUpdated'] = $lastUpdated;



            $this->data['orders'] = $orders;



            $this->data['success'] = Session::get('response');

            Session::forget('response');



            $this->data['page_title'] = 'Order :: Listing';



            /*if($this->data['countSubscribers'] < $item and $page!=1){

			return Redirect::to('web88cms/newsletter/'.$item.'/1');

		}*/

            $include_notification = False;

            if ($request->isMethod('post')) {

                $include_notification = True;

            }

            $ord = $this->data;

            $html = View::make('admin.orders.search_order')->with([

                'orders' => $ord,

                'keywords' => $keywords,

                'include_notification' => $include_notification

            ])->render();



            return response()->json([

                "message"       => 'get successfully.',

                "isSucceeded"   => TRUE,

                "data"          => $html,

                "record_from"   => (($request->page - 1) * $per_page) + 1,

                "record_to"   => ($total_reocrds < $request->page * $per_page) ? $total_reocrds : ($request->page * $per_page),

                "links" => $links

            ]);

        }

    }

    function delete(Request $request)

    {

        $return_data = ['delete_status' => False];



        $delete = Order::where('id', $request->get('target_order'))->delete();



        if ($delete) {

            $return_data['delete_status'] = True;

        }



        return redirect('admin/orders_list')->with($return_data);

    }



    public function deleteSelected(Request $request)

    {

        $return_data = ['delete_status' => False];



        $deleted_orders = Order::destroy(Input::get('orders_checkbox'));



        if ($deleted_orders) {

            $return_data['delete_status'] = True;

        }



        return redirect('admin/orders_list')->with($return_data);

    }

    //aklima added

    public function deleteSelectedItem(Request $request)

    {

        $return_data = ['delete_status' => False];

        $selected_items = $request->get('items_checkbox');

        $order_id = $request->item_order_id;

        // dd($selected_items);die();

        if (!empty($selected_items)) {

            foreach ($selected_items as $i) {

                OrderItem::find($i)->delete();

                $filename = 'receipt_' . $i . '.pdf';

                $exists = Storage::disk('pdf')->exists($filename);

                if ($exists) {

                    // $pdf_route = asset('storage/pdf/'.$filename);

                    Storage::disk('pdf')->delete($filename);

                }

            }





            // $deleted_orders = OrderItem::whereIn('id', explode(',', $selected_items))->delete();

            $return_data['update_status']  = True;

            $return_data['update_message'] = 'Order Items successfully Deleted.';

            return redirect()->route('order_edit', ['id' => $order_id])

                ->with($return_data);

        }

    }

    public function deleteAllItem(Request $request)

    {

        $return_data = ['delete_status' => False];

        $order_id = $request->items_order_id;

        if (OrderItem::where('order_id', $order_id)->delete()) {

            $return_data['update_status']  = True;

            $return_data['update_message'] = 'All Items successfully Deleted.';

        }



        return redirect()->route('order_edit', ['id' => $order_id])

            ->with($return_data);

    }

    public function deleteAll(Request $request)

    {

        $return_data = ['delete_status' => False];



        if (Order::whereNotNull('id')->delete()) {

            $return_data['delete_status'] = True;

        }



        return redirect('admin/orders_list')->with($return_data);

    }

    public function fetchCategory(Request $request)

    {



        // $category_id = Request::Input('category_id');

        $category_id = $request->category_id;

        //      $result = DB::table('products as p')->select('p.*','c.display_order')->leftJoin('product_to_category as c','p.id','=','c.product_id')->where('p.status','1')->where('c.category_id',$category_id)->groupBY('p.id')->get();

        $result = DB::table('plans as p')

            ->select(

                'p.*',

                'c.sort_order'

            )->leftJoin('categories as c', 'p.category', '=', 'c.id')

            ->where('p.status', '1')

            ->where('c.parent', $category_id)

            ->orWhere('c.id', $category_id)

            ->latest()->get();



        // print_r(DB::getQueryLog());exit;

        foreach ($result as $key => $item) {



            $item->price = $item->price_annually + $item->setup_fee_one_time;

            $item->quantity = 1;

            $new_res[] = $item;

        }



        $query2 = Plan::getPomocodebycategory($category_id);

        $query4 = Plan::getDiscountByCategory($category_id);



        if (count($new_res) > 0)

            echo json_encode(array('products' => $new_res, 'promocode' => $query2, 'discount' => $query4));

    }

    public function editItems(Request $request, $id)

    {

        $order   = OrderItem::where('id', $id)->first();

        $lastUpdated    = $this->OrderModel->getLastUpdated();

        $this->data['order']       = $order;

        $this->data['lastUpdated'] = $lastUpdated;

        $this->data['success']     = Session::get('response');

        $page_slug = 'ssl_certificates';

        $page_name = strtolower(str_replace('_', ' ', $page_slug));

        $this->data['page_name'] = $page_name;

        $this->data['domain_pricings'] = DomainPricing::where('type', 'addons')->where('status', '1')->get();

        // $this->data['page_cms'] = Page::where(['name' => $page_name])->first();

        $this->data['hosting_plan'] = Plan::where(['page' => $page_name])->get();

        $data = $this->data;



        return view('admin.orders.billing_invoiceitem_edit')->with(['data' => $data]);

    }





    public function billing_invoice_edit(Request $request, $id)

    {



        $order   = Order::where('id', $id)->with(['user.client.country', 'orderItems', 'orderItems.plan'])->first();

        $gstAmount = $order->gst_rate;

        $totalAmount = $order->total_amount;

        $gstRate = 0;

        if ($totalAmount > 0) {

            $gstRate = $gstAmount / $totalAmount * 100;

        }

        $users   = new User();

        $default_option = ['_default' => '- Please select -'];

        $lastUpdated    = $this->OrderModel->getLastUpdated();

        $this->data['order']        = $order;

        $this->data['lastUpdated'] = $lastUpdated;



        $this->data['success']     = Session::get('response');



        $this->data['countries'] = Country::getCountryListArray($default_option);



        $this->data['payment_methods'] = PaymentMethod::getPaymentMethodListArray($default_option);

        $this->data['categories'] = $categories = Category::where(['parent' => 0, 'status' => 1])->orderBy('sort_order')->get(); //

        $this->data['custom_category'] = $custmo = $this->CategoryModel->getCategoriesTree();



        $this->data['user_client_accounts'] = $users->getUserClientList($this->getAccountType(@$order->user->client->account_type));

        Session::forget('response');

        $this->data['discounts'] = Promotion::orderBy('id', 'desc')->get();

        $this->data['plans'] = Plan::where('status', 1)->orWhere('status', 2)->get();

        $page_slug = 'ssl_certificates';

        $page_name = strtolower(str_replace('_', ' ', $page_slug));

        $this->data['page_name'] = $page_name;

        // $this->data['page_cms'] = Page::where(['name' => $page_name])->first();

        // $this->data['hosting_plan'] = Plan::where(['page'=> $page_name])->get();

        $this->data['domain_pricings'] = DomainPricing::where('type', 'addons')->where('status', '1')->get();

        // $this->data['category_all'] =  Category::where(['status' => 1])->orderBy('sort_order')->get();

        // Added by Rejohn

        $this->data['hosting_plan'] = Plan::where('page', $page_name)->where('status', 1)->get();

        $this->data['category_all'] =  Category::where('slug', 'ssl_certificates')->where('status', 1)->first();

        //$this->data['page_title']='Order :: Listing';

        $this->data['featured_plans'] = PlanFeature::with('details')->where('page', 'dedicated servers')->get();

        $this->data['gstRate'] = GstRate::where(function ($query) {

            $query->where('status', 1)

                ->orWhere('status', 2);

        })->first();

        // if (isset($this->data['order'])) {

        //     $this->data['dueDate'] = ($this->data['order']->due_date != '0000-00-00 00:00:00') ? Carbon::createFromFormat('Y-m-d H:i:s', $this->data['order']->due_date)->format('m/d/Y') : '00/00/0000';

        // } else {

        //     $this->data['dueDate'] = "10/10/2023";

        // }

        if ($this->data['order']->due_date == '0000-00-00 00:00:00') {

            $this->data['dueDate'] = Carbon::createFromFormat('Y-m-d H:i:s', $this->data['order']->payment_date)->format('m/d/Y');

        } else {

            $this->data['dueDate'] = Carbon::createFromFormat('Y-m-d H:i:s', $this->data['order']->due_date)->format('m/d/Y');

        }



        $data = $this->data;



        return view('admin.orders.billing_invoice_edit')->with(['data' => $data, 'order' => $order, 'gstAmount' => $gstAmount, 'gstRate' => $gstRate]);

    }

    //new 

    public function get_invoice_details($id)

    {

        $item = OrderItem::where('id', $id)->first();

        $plans = Plan::where(['status' => 1, 'id' => $item->plan_id])->first();

        return json_encode(array('items' => $item, 'plans' => $plans));

        // return $item;

    }

    public function billing_invoice_list(Request $request, $per_page = 10)

    {

        $keywords = array();

        $query = Order::with([

            'user.client.country',

            'payment_method'

        ])->orderBy('id', 'desc');





        if ($request->has('transaction_id')) {



            $find = 'MY-';

            $replace = '';

            $og_txn_id = trim($request->transaction_id);



            $transaction_id = str_replace($find, $replace, $og_txn_id);

            $query->where('transaction_id', $transaction_id);

            $keywords['transaction_id'] = $og_txn_id;

        }





        if ($request->has('id')) {

            $query->OrWhere('id', $request->id);

            $keywords['id'] = $request->id;

        }





        if ($request->has('start') || $request->has('end') || $request->has('payment_date')) {

            $newDateFormat3 = \Carbon\Carbon::parse($request->start)->format('Y-m-d');

            $newDateFormat4 = \Carbon\Carbon::parse($request->end)->format('Y-m-d');

            $newDateFormat5 = \Carbon\Carbon::parse($request->payment_date)->format('Y-m-d');

            $request->OrWhereDate('payment_date', '=', $newDateFormat5);

            $query->OrWhereDate('created_at', '>=', $newDateFormat3);

            $query->WhereDate('created_at', '<=', $newDateFormat4);

            $keywords['start'] = $request->start;

            $keywords['end'] = $request->end;

            $keywords['payment_date'] = $request->payment_date;

            //where('created_at', $request->start);

        }



        // if($request->has('end')){

        //  $query->OrWhereDate('created_at', '<=', $request->end);

        //        $keywords['end'] = $request->end;

        // }



        if ($request->has('total_amount')) {

            $query->OrWhere('total_amount', $request->total_amount);

            $keywords['total_amount'] = $request->total_amount;

        }



        if ($request->has('payment_status')) {



            if ($request->payment_status == 'paid') {

                $status = 'COMPLETED';

                $query->OrWhere('status', $status);

            }

            if ($request->payment_status == 'failed') {

                $status = 'FAILED';

                $query->OrWhere('status', $status);

            }



            if ($request->payment_status != 'none')

                $keywords['payment_status'] = $request->payment_status;

        }



        if ($request->has('client_name')) {

            $client_name = $request->client_name;

            //  $client = explode(' ',$client_name);

            // $fname = isset($client[0]) ? $client[0] : '';

            //   $lname = isset($client[1]) ? $client[1] : '';

            $data = Client::where('first_name', 'Like', '%' . $client_name . '%')->orwhere('last_name', 'Like', '%' . $client_name . '%')->first();







            $client_name = isset($data) ? $data->user_id : '';



            $query->OrWhereHas('user', function ($q) use ($client_name) {

                $q->where('id', '=', $client_name);

            });





            $keywords['client_name'] = $request->client_name;

        }





        if ($request->has('client_id')) {



            $client_id = $request->client_id;

            $find1 = 'B-';

            $find2 = '-MY';

            $replace = '';

            $client_id  = Str_replace($find1, $replace, $client_id);

            $client_id  = Str_replace($find2, $replace, $client_id);

            //remove special chars

            $client_id = preg_replace("/[^0-9]/", "", $client_id);

            $query->OrWhereHas('user', function ($q) use ($client_id) {

                $q->where('id', '=', $client_id);

            });





            $keywords['client_id'] = $request->client_id;

        }



        if ($request->has('payment_method')) {

            $payment_method = PaymentMethod::where('name', '=', $request->payment_method)->first();

            $payment_id = isset($payment_method) ? $payment_method->id : '';

            $query->OrWhere('payment_method_id', $payment_id);

            $keywords['payment_method'] = $request->payment_method;

        }

        $query->Where('type', 1);

        $this->data['page'] = $per_page;

        //$this->data['item'] = $item;



        $lastUpdated = $this->OrderModel->getLastUpdated(True);

        // dd($query->get()->toArray());

        $orders = $query->paginate($per_page);



        $this->data['countOrders'] = count($query->get());



        $this->data['lastUpdated'] = $lastUpdated;



        $this->data['orders'] = $orders;



        $this->data['success'] = Session::get('response');

        Session::forget('response');



        $this->data['page_title'] = 'Invoice :: Listing';

        $include_notification = False;

        if ($request->isMethod('post')) {

            $include_notification = True;

        }

        $ord = $this->data;



        return view('admin.invoices.billing_invoices_list')->with(

            [

                'orders' => $ord,

                'keywords' => $keywords,

                'include_notification' => $include_notification

            ]

        );

    }

    function deleteInvoice(Request $request)

    {

        $return_data = ['delete_status' => False];



        $delete = Order::where('id', $request->get('target_order'))->delete();



        if ($delete) {

            OrderItem::where('order_id', $request->get('target_order'))->delete();



            $return_data['delete_status'] = True;

        }



        return redirect('admin/billing_invoices_list')->with($return_data);

    }

    public function updateItems(Request $request, $id)

    {



        $fields = $request->all();

        $return_data = [

            'update_status'        => False,

            'update_message'         => 'Failed to Insert order information. Please try again.'

        ];



        $validation_rules = [

            'custom_plan_category' => 'required',

            'custom_plan_category'     => 'required',

            'search_domain'               => 'required',

            'unit_price'    => 'required',

            'quantity' => 'required|numeric'

        ];

        $validator = Validator::make($fields, $validation_rules);



        if ($validator->fails()) {

            $request->flash();

            $return_data['update_message'] = 'Some of the provided data are invalid. Please check the errors below.';

            $return_data['error'] = $validator->errors()->all();

            return redirect()->route('editItems', ['id' => $id])

                ->with($return_data);

        }

        if ($request->service_plan == 'custom_plan') {

            $plan = new Plan;

            $plan->status = 2;

            $plan->plan_name = $request->custom_plan_name;

            $plan->service_code = $request->custom_plan_code;

            $plan->category = $request->custom_plan_category;

            $plan->price_annually = $request->unit_price;

            $plan->setup_fee_one_time = $request->setupfree;



            $plan->save();

            $plan_id = $plan->id;

            if ($request->has('custom_title')) {

                // $users = [];

                foreach ($request->custom_title as $key => $value) {

                    // dd($value);

                    if (!empty($value)) {

                        $add = new PlanFeature;

                        $add->title = $value;

                        $add->plan_id = $plan_id;

                        $add->status  = 1;

                        $add->save();

                        $feature_id = $add->id;

                        if ($add) {

                            foreach ($request->custom_description as $k => $vl) {

                                if ($key == $k) {

                                    $details = new PlanFeatureDetail;

                                    $details->description = $vl;

                                    $details->status = 1;

                                    $details->plan_feature_id = $feature_id;

                                    $details->plan_id = $plan_id;

                                    // dd($details);

                                    $details->save();

                                }

                            }

                        }

                    }

                }

            }

            // $plan->

        } else {

            $plan_id = $request->service_plan;

        }

        $item = OrderItem::where('id', $id)->first();

        $item->user_id = Auth::id();

        $item->order_id = $order_id = $request->order_id;

        $item->plan_id = $plan_id;

        $item->services = $request->search_domain;

        $item->qty = $request->quantity;



        $item->ssl_price = $request->ssl_price;

        // if($request->service_plan){

        // $item->plan_id      = $request->service_plan;

        // $plan_details = Plan::where('id', $request->service_plan)->first();

        $price = $request->unit_price + $request->setupfree;

        // } 

        if (!empty($request->domain_pricing)) {

            $pricing = explode('-', $request->domain_pricing);

            $price_val = $pricing[1];

            $cycle = $pricing[0];

            // $item->domain_price = $domain_price = $request->domain_pricing;

            $price += $price_val;

        } else {

            $cycle = $request->cycle;

        }

        $item->cycle = $cycle;



        $discount_id = $request->discount_id;

        $discount_amount = $request->discount_amount;

        $discount_rate = $request->discount_rate;

        if ($discount_amount != '' && $discount_amount != 0.00) {

            $discount = $this->calculateDiscount($price, $discount_amount, $discount_rate);

        } else {

            $discount = 0.00;

        }

        $item->discount = $discount;

        $item->price        = $price;

        $promo_id = $request->promo_id;



        $promo_type = $request->select;

        $promo_code = $request->promo_code;

        if ($request->has('addons')) {

            $item->addons = implode(',', $request->addons);

        }

        $item->save();

        // save and update 

        $return_data['update_status']  = True;

        $return_data['update_message'] = 'Invoice Items successfully Updated.';

        // $json['id'] = $invoice_id;

        return redirect()->route('order_edit', ['id' => $order_id])

            ->with($return_data);

    }

    public function add_new_invoice($invoice_id, Request $request)

    {

        // dd($request->all());die();

        // $order = Order::find($invoice_id);

        // dd($order);die();

        // $item = OrderItem::find($invoice_id);

        $fields = $request->all();

        $return_data = [

            'update_status'        => False,

            'update_message'         => 'Failed to Insert order information. Please try again.'

        ];



        $validation_rules = [

            'custom_plan_category' => 'required',

            // 'service_plan'     => 'required',

            'search_domain'               => 'required',

            // 'unit_price'    => 'required',

            'quantity' => 'required|numeric'

        ];

        $validator = Validator::make($fields, $validation_rules);



        if ($validator->fails()) {

            $request->flash();

            $return_data['update_message'] = 'Some of the provided data are invalid. Please check the errors below.';

            $json['error'] = $validator->errors()->all();

            echo json_encode($json);

            exit;

        }

        if ($request->service_plan == 'custom_plan') {

            $plan = new Plan;

            $plan->status = 2;

            $plan->plan_name = $request->custom_plan_name;

            $plan->service_code = $request->custom_plan_code;

            $plan->category = $request->custom_plan_category;

            $plan->price_annually = $request->unit_price;

            $plan->setup_fee_one_time = $request->setupfree;



            $plan->save();

            $plan_id = $plan->id;





            if ($request->has('custom_title')) {

                // $users = [];

                foreach ($request->custom_title as $key => $value) {

                    // dd($value);

                    if (!empty($value)) {

                        $add = new PlanFeature;

                        $add->title = $value;

                        $add->plan_id = $plan_id;

                        $add->status  = 1;

                        $add->save();

                        $feature_id = $add->id;

                        if ($add) {

                            foreach ($request->custom_description as $k => $vl) {

                                if ($key == $k) {

                                    $details = new PlanFeatureDetail;

                                    $details->description = $vl;

                                    $details->status = 1;

                                    $details->plan_feature_id = $feature_id;

                                    $details->plan_id = $plan_id;

                                    // dd($details);

                                    $details->save();

                                }

                            }

                        }

                    }

                }

            }

            // $plan->

        } else {

            $plan_id = $request->service_plan;

        }

        $item = new OrderItem();

        $item->user_id = Auth::id();

        $item->order_id = $invoice_id;

        $item->plan_id = $plan_id;

        $item->services = $request->search_domain;

        $item->category_id = $request->custom_plan_category;

        $item->qty = $request->quantity;



        $item->ssl_price = $request->ssl_price;

        // $item->unit_price = $request->unit_price;



        // if($request->service_plan){

        // $item->plan_id      = $request->service_plan;

        // $plan_details = Plan::where('id', $request->service_plan)->first();

        $price = $request->unit_price + $request->setupfree;

        // } 

        if (empty($plan_id)) {

            $item->setup_fee = $request->setupfree;

        }

        if (!empty($request->domain_pricing)) {

            $pricing = explode('-', $request->domain_pricing);

            $price_val = $pricing[1];

            $cycle = $pricing[0];

            $item->domain_price = $domain_price = $request->domain_pricing;

            $price += $price_val;

        } else {

            $item->domain_price = 0.0;

            $cycle = $request->cycle;

        }

        $item->cycle = $cycle;



        $discount_id = $request->discount_id;

        $discount_amount = $request->discount_amount;

        $discount_rate = $request->discount_rate;

        if ($discount_amount != '' && $discount_amount != 0.00) {

            $discount = $this->calculateDiscount($price, $discount_amount, $discount_rate);

        } else {

            $discount = 0.00;

        }

        $item->discount = $discount;

        $item->price        = $price;

        $promo_id = $request->promo_id;



        $promo_type = $request->select;

        $promo_code = $request->promo_code;

        if ($request->has('addons')) {

            $item->addons = implode(',', $request->addons);

        }

        // dd($item);

        $save = $item->save();

        if ($save) {

            //  $order = Order::find($invoice_id);

            // $order->total_amount = $price;

            // $order->save();

            $filename = 'receipt_' . $invoice_id . '.pdf';

            $exists = Storage::disk('pdf')->exists($filename);

            if ($exists) {

                // $pdf_route = asset('storage/pdf/'.$filename);

                Storage::disk('pdf')->delete($filename);

            }

        }

        // save and update 

        $return_data['update_status']  = True;

        $return_data['update_message'] = 'New Invoice Items successfully Added.';

        $json['success'] = 'New Invoice Items successfully Added.';

        Session::flash('update_status', True);

        Session::flash('update_message', 'New Invoice Items successfully Added.');

        $json['id'] = $invoice_id;

        // return redirect()->route('order_edit', [ 'id' => $invoice_id ])

        // ->with($return_data);

        echo json_encode($json);

    }

    private function calculateDiscount($product_price, $discount_amount, $type)

    {



        if ($type == '%') {

            $discount = (($discount_amount / 100) * $product_price);

        } else {

            $discount = $discount_amount;

        }

        return $discount;

    }

    public function getPromoCodes($promo_code)

    {

        $result = DB::table('promocodes');



        $result->where('promo_code', $promo_code);



        $result->where('start_date', '<=', date('Y-m-d'));

        $result->where('end_date', '>=', date('Y-m-d'));



        $result->where('status', '=', '1');



        $promocode = $result->first();



        if ($promocode) {

            $count = DB::table('orders')->select('id')->where('promocode_id', '=', $promocode->id)->count();



            if ($count < $promocode->times_to_use) {

                $results = DB::table('promocodes_to_product')->select('product_id')->where('promocode_id', '=', $promocode->id)->get();

                $productApply = array();



                foreach ($results as $result) {

                    $productApply[] = $result->product_id;

                }



                return array(

                    'promocode' => $promocode,

                    'products' => $productApply

                );

            } else {

                return array('warning' => 'Promo code expired!');

            }

        } else {

            return array('warning' => 'Invalid promo code!');

        }

    }



    public function check_domain_availablity(Request $request)

    {



        $search_domain = trim($request->search_domain);

        $domain_availblity = $this->singleSearch($search_domain);

        return json_encode(['response' => $domain_availblity]);

        // dd($domain_availblity);

    }

    public function bulk_search(Request $request)

    {

        // if ($page_name == 'bulk domain search') {

        //            $mainPageData = DomainMainPage::first();

        // dd($this->getDomainNameExtensionArray($request->input('bulk_domains')));

        $bulkDomains = trim($request->input('bulk_domains'));



        $domainPricing = DomainPricing::where('type', 'single')->get();

        $target_domains        = [];

        $bulk_price_cycle_list = [];



        if (!empty($bulkDomains)) {

            $target_domains = $this->getDomainNameExtensionArray($bulkDomains);



            $validate_search = Validator::make(['bulk_domain' => $target_domains], [

                'bulk_domain.*' => [

                    'required',

                    'regex:/^(?!:\/\/)([a-zA-Z0-9-_]+\.)*[a-zA-Z0-9][a-zA-Z0-9-_]+\.[a-zA-Z]{2,11}?$/'

                ]

            ]);



            if ($validate_search->fails()) {

                Session::flash('failed', 'The provided domain names are incorrect');

            } else {

                $bulk_price_cycle_list = DomainPricingList::getPricingListBulk($target_domains);

            }

        }



        $domainPricingList = DomainPricingList::all();

        $domain_pricing = DomainPricing::with('listing', 'bulk_pricing')->where('type', 'single')->get();



        $response = $this->bulkSearch($bulkDomains);



        $RMSALE = array();

        $RMSALE[]['duration'] = '1-5';

        $RMLIST[]['duration'] = '1-5';

        $RMSALE[]['duration'] = '6-20';

        $RMLIST[]['duration'] = '6-20';

        $RMSALE[]['duration'] = '21-49';

        $RMLIST[]['duration'] = '21-49';

        $RMSALE[]['duration'] = '50-100';

        $RMLIST[]['duration'] = '50-100';

        $RMSALE[]['duration'] = '101-200';

        $RMLIST[]['duration'] = '101-200';

        $RMSALE[]['duration'] = '201-500';

        $RMLIST[]['duration'] = '201-500';



        return json_encode(['bulkDomains' => $bulkDomains, 'RMSALE' => $RMSALE, 'RMLIST' => $RMLIST, 'domainPricing' => $domainPricing, 'domain_pricing' => $domain_pricing, 'bulk_price_cycle_list' => $bulk_price_cycle_list, 'domainPricingList' => $domainPricingList, 'response' => $response]);

        // }

    }

    private function getDomainNameExtensionArray($domain_array)

    {

        $domain_info = [];

        $bulk_domains = trim($domain_array);



        if (empty($bulk_domains)) {

            return $domain_info;

        }



        $bulk_domains_array = explode("\r\n", $bulk_domains);



        foreach ($bulk_domains_array as $domain) {

            $formatted_name = $this->getDomainNameExtension($domain);



            $domain_info[] = $formatted_name['name'];

        }



        return $domain_info;

    }



    private function getDomainNameExtension($domain_name)

    {

        if (empty($domain_name)) {

            return NULL;

        }



        $domain_components = explode('.', trim($domain_name));

        $components_length = sizeOf($domain_components);

        //dd($domain_components, $components_length);

        if ($components_length < 2) {

            return [

                'name'        => $domain_components[0],

                'components'  => $domain_components

            ];

        }



        if (sizeOf($domain_components) === 3 && in_array('www', $domain_components)) {

            array_shift($domain_components);

        }



        if (sizeOf($domain_components) === 3 && (!in_array('www', $domain_components))) {

            return [

                'name'        => $domain_components[$components_length - 3] . '.' . $domain_components[$components_length - 2] . '.' . $domain_components[$components_length - 1],

                'components'  => $domain_components

            ];

        }



        if ($components_length == 4) {

            $data =  [

                'name'        => $domain_components[$components_length - 3] . '.' . $domain_components[$components_length - 2] . '.' . $domain_components[$components_length - 1],

                'components'  => $domain_components

            ];

            return $data;

        }



        $data = [

            'name'        => implode('.', $domain_components),

            'components'  => $domain_components

        ];

        return $data;

        //dd($data);

    }



    private function bulkSearch($bulkDomains)

    {

        $bulkDomains = str_replace("\r\n", "\n", $bulkDomains);

        $bulks = explode("\n", $bulkDomains);

        $success = array();

        $error = array();

        $available = "";

        $taken = "";

        foreach ($bulks as $bulk) {

            $bulk = trim($bulk);

            $bulk = str_replace("www.", "", $bulk);

            //            $extension = strstr($bulk, '.');

            $result = [];



            if (!empty($bulk)) {

                $resp = (new DomainsController)->checkDomainAPI($bulk);



                if ($resp[0] == 0) {

                    $success[$bulk] = ['status' => $resp[0]];

                    $success[$bulk] = (object)$success[$bulk];

                    $available .= ",$bulk";

                } else {

                    $error[$bulk] = [

                        'status' => $resp[0]

                    ];

                    $error[$bulk] = (object)$error[$bulk];

                    $taken .= ",$bulk";

                }

            }

        }

        $available = ltrim($available, ',');

        $taken = ltrim($taken, ',');



        return (object)['success' => $success, 'error' => $error, 'available' => $available, 'taken' => $taken];

    }

    private function singleSearch($domain)

    {

        $success = array();

        $error = array();

        $available = "";

        $taken = "";

        $bulk = trim($domain);

        $bulk = str_replace("www.", "", $bulk);

        $domianExt = explode(".", $bulk, 2);

        $bulk = $this->validateUserDomainSearchInput($bulk);

        $price_list = $this->get_domain_price($domianExt[1]);

        $result = [];

        if (!empty($bulk)) {

            $resp = (new DomainsController)->checkDomainAPI($bulk);

            if ($resp[0] == 0) {

                $success[$bulk] = ['status' => $resp[0]];

                $success[$bulk] = (object)$success[$bulk];

                $available = "$bulk";

            } else {

                $error[$bulk] = [

                    'status' => $resp[0]

                ];

                $error[$bulk] = (object)$error[$bulk];

                $taken = "$bulk";

            }

        }

        return (object)['success' => $success, 'error' => $error, 'available' => $available, 'taken' => $taken, 'price_list' => $price_list];

    }



    private function validateUserDomainSearchInput($domain)

    {

        $spaces = '/\s/';

        $noneUrlChars = '/[!\@\[#$%^&*()+?<>=~\,\?\`\?\;\'\"|_\{\\\}]/';

        $domain = preg_replace($spaces, '', $domain);

        $domain = strtolower(preg_replace($noneUrlChars, '', $domain));

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

        return $domainName . '.' . $domainTld;

    }



    function get_domain_price($domianExt)

    {

        return DB::table('domain_pricing_lists')->where('tld', $domianExt)->first();

    }

    public function print_invoice(Request $request)

    {



        $id = $request->id;



        $domain_pricings = DomainPricing::where('type', 'addons')->where('status', '1')->get();

        $orderDetails   = Order::where('id', $id)->with(['user.client.country', 'orderItems.plan'])->first();



        $plans = Plan::where('status', 1)->get();



        return view('admin.orders.billing_invoice_print', compact('orderDetails', 'domain_pricings', 'plans'));

    }



    public function send_pdf(Request $request, $id)

    {

        $from = config('mail.username');





        // $this->validate($request, [

        //          'name' => 'required',

        //          'email' => 'required|email',

        //          'message' => 'required|min:20',

        //          'checkbox' => 'required']);



        $data = array(

            'name' => $request->name,

            'email' => $request->email,

        );



        $users = [];

        foreach ($request->emailcc as $key => $value) {

            if (!empty($value)) {

                $ua = [];

                $ua['email'] = $value;

                $users[$key] = (object)$ua;

            }

        }



        $domain_pricings = DomainPricing::where('type', 'addons')->where('status', '1')->get();

        $orderDetails   = Order::where('id', $id)->with(['user.client.country', 'orderItems.plan'])->first();

        $plans = Plan::where('status', 1)->get();

        $base64 = 'resources/assets/frontend/images/index/logo_large.png';

        $style = 'resources/assets/frontend/css/pdf.css';

        $font = storage_path('fonts/Roboto');

        $filename = 'invoice_' . $id . '.pdf';



        //Feedback mail to client

        $pdf = PDF::loadView('admin.orders.billing_invoice_pdf', compact('orderDetails', 'base64', 'style', 'domain_pricings', 'plans'));



        // $pdf = PDF::loadView('your_view_name', $data)->setPaper('a4'); 



        // dd($users);die();

        Mail::send('emails.invoice', $data, function ($message) use ($from, $data, $pdf, $users, $filename) {

            $message->from($from);

            $message->to($data['email']);

            $message->cc($users);

            $message->subject('Invoice');

            //Attach PDF doc

            $message->attachData($pdf->output(), $filename);

        });



        Session::flash('success', 'Hello &nbsp;' . $data['name'] . '&nbsp;Thank You for choosing us. Will reply to your query as soon as possible');



        // return redirect()->back();

        if (count(Mail::failures()) > 0) {

            // return failed mails

            // return new Error(Mail::failures()); 

            return json_encode(array('success' => 0, 'message' => 'Mail Not send'));

        }



        return json_encode(array('success' => 1, 'message' => 'message Sent successfully'));

        // return redirect()->back();



    }

    private function getAccountType($account_type)

    {

        switch ($account_type) {

            case 'Business Account':

                return 'business-account';

            case 'Individual Account':

                return 'individual-account';

            default:

                return 'all';

        }

    }

    public function update_invoice_order(Request $request, $order_id)

    {

        $current_date = date('m/d/Y', strtotime('tomorrow'));

        $fields       = Input::all();

        $order = Order::find($order_id);

        $order->total_amount = $request->total_number;

        $order->save();

        $return_data['update_status']  = True;

        $return_data['update_message'] = 'Order Items successfully updated.';

        return redirect()->route('order_edit', ['id' => $order_id])

            ->with($return_data);

    }

    public function update(Request $request, $order_id)

    {

        $current_date = date('m/d/Y', strtotime('tomorrow'));

        $fields       = Input::all();

        // dd($fields);die();

        $payment_methods = PaymentMethod::all()->implode('id', ',');

        $cities                  = City::all()->implode('id', ',');

        $states                  = State::all()->implode('id', ',');

        $countries              = Country::all()->implode('id', ',');

        $users                     = User::all()->implode('id', ',');

        $user_id = $request->user_id;

        // dd($user_id);die();



        $return_data = [

            'update_status'         => False,

            'update_message'          => 'Failed to update order information. Please try again.'

        ];



        $validation_rules = [

            'order-invoice-date'     => 'required|date|before:' . $current_date,

            'order-due-date'                => 'required|date',

            'order-payment-date'     => 'required|date|before:' . $current_date,

            'order-payment-method'   => 'required|numeric|in:' . $payment_methods,

            'order-txn-id'                 => 'required|alpha_num',

            'order-cheque-num'         => 'required_if:order-payment-method,4|numeric',



            // 'user-client-process'     			 => 'required|in:existing-user,new-user',



            // 'user-client-target'			 			 => 'required_if:user-client-process,existing-user|in:' . $users,



            // 'user-client-account-type'			 => 'required_if:user-client-process,new-user|in:business-account,individual-account',

            // 'user-client-first-name' 				 => 'required_if:user-client-process,new-user|regex:/^[a-zA-Z\s\-]+$/|max:255',

            // 'user-client-last-name' 				 => 'required_if:user-client-process,new-user|regex:/^[a-zA-Z\s\-]+$/|max:255',

            // 'user-client-company'    				 => 'required_if:user-client-process,new-user|regex:/^[a-zA-Z0-9\s\-\.\,\/]+$/|max:255',

            // 'user-client-email'			 				 => 'required_if:user-client-process,new-user|email|unique:users,email|max:255',

            // 'user-client-phone-number'			 => 'required_if:user-client-process,new-user|numeric|digits_between:8,10',

            // 'user-client-mobile-number'			 => 'required_if:user-client-process,new-user|numeric|digits_between:8,10',

            // 'user-client-address-1'			 		 => 'required_if:user-client-process,new-user|regex:/^[a-zA-Z0-9\s\-\.\,\/]+$/|max:255',

            // 'user-client-address-2'			 		 => 'required_if:user-client-process,new-user|regex:/^[a-zA-Z0-9\s\-\.\,\/]+$/|max:255',

            // 'user-client-postal-code'				 => 'required_if:user-client-process,new-user|numeric',

            // 'user-client-city'			 		 		 => 'required_if:user-client-process,new-user|in:' . $cities,

            // 'user-client-state'			 		 		 => 'required_if:user-client-process,new-user|in:' . $states,

            // 'user-client-country'			 		 	 => 'required_if:user-client-process,new-user|in:' . $countries,

        ];



        $custom_messages = [

            'order-cheque-num.required_if'          => 'Cheque # is required if payment method is "Cheque".',

            'order-payment-method.in'                   => 'Please choose a payment method from the dropdown.',

            'order-payment-method.numeric'                      => 'Please choose a payment method from the dropdown.',

            // 'user-client-first-name.required_if'    => ':attribute is required.',

            // 'user-client-last-name.required_if'  	  => ':attribute is required.',

            // 'user-client-company.required_if'  			=> ':attribute is required.',

            // 'user-client-email.required_if'			 	  => ':attribute is required.',

            // 'user-client-phone-number.required_if'  => ':attribute is required.',

            // 'user-client-mobile-number.required_if' => ':attribute is required.',

            // 'user-client-address-1.required_if' 		=> ':attribute is required.',

            // 'user-client-address-2.required_if' 	  => ':attribute is required.',

            // 'user-client-postal-code.required_if'   => ':attribute is required.',

            // 'user-client-city.required_if'    			=> ':attribute is required.',

            // 'user-client-state.required_if'    			=> ':attribute is required.',

            // 'user-client-country.required_if'    		=> ':attribute is required.'

        ];



        $validator = Validator::make($fields, $validation_rules, $custom_messages);



        if ($validator->fails()) {

            $request->flash();



            $default_option = ['_default' => '- Please select -'];



            $return_data['update_message'] = 'Some of the provided data are invalid. Please check the errors below.';



            // $return_data = $this->addCitiesAndStates($fields, $return_data, $default_option);



            return redirect()->route('order_edit', ['id' => $order_id])

                ->withErrors($validator)

                ->with($return_data);

        }



        // if ($fields['user-client-process'] === 'new-user') {

        // 	$fields['user-client-target'] = User::createNew($fields);

        // }

        Client::Updateclient($user_id, $fields);



        // Save Order Info

        if (Order::updateOrderInfo($order_id, $fields, $user_id)) {

            $return_data['update_status']  = True;

            $return_data['update_message'] = 'Order info successfully updated.';

        } else {

            $request->flash();

        }



        return redirect()->route('order_edit', ['id' => $order_id])

            ->with($return_data);

    }



    private function addCitiesAndStates($fields, $data, $default_option)

    {

        if ($fields['user-client-process'] === 'new-user') {

            $data['states'] = State::getStateListArray($fields['user-client-country'], $default_option);

            $data['cities'] = City::getCityListArray($fields['user-client-state'], $default_option);

        }



        return $data;

    }



    public function statusUpdate(Request $request, $order_id)

    {

        $status_constants = [

            'COMPLETED',

            'INCOMPLETE',

            'FAILED'

        ];



        $status = $request->get('status');



        $return_data = [

            'update_status'  => False,

            'update_message' => 'Failed to update invoice status. Please try again.'

        ];



        if (empty($order_id) || !in_array($status, $status_constants)) {

            return redirect()->route('order_edit', ['id' => $order_id])

                ->with($return_data);

        }



        if (Order::updateOrderStatus($order_id, $status)) {

            $return_data['update_message'] = 'Invoice status successfully updated.';

            $return_data['update_status']  = True;

        }



        return redirect()->route('order_edit', ['id' => $order_id])

            ->with($return_data);

    }



    public function delete_invoice_item(Request $request)

    {

        // dd($request->all());

        $return_data = ['update_status' => False];

        $id = $request->item_id;

        $order_id = $request->order_id;



        $items = orderItem::find($id);



        $delete = $items->delete();

        if ($delete) {



            $filename = 'receipt_' . $id . '.pdf';

            $exists = Storage::disk('pdf')->exists($filename);

            if ($exists) {

                // $pdf_route = asset('storage/pdf/'.$filename);

                Storage::disk('pdf')->delete($filename);

            }

        }

        $return_data['update_message'] = 'Invoice successfully deleted.';

        $return_data['update_status']  = True;

        Session::flash('update_status', True);

        Session::flash('update_message', 'Item was deleted successfully');

        return redirect()->route('order_edit', ['id' => $order_id])->with($return_data);;

    }

    public function print_pdf($id)

    {



        $data['title'] = "Invoice Print";

        // $id = $request->id;  

        $filename = 'invoice_' . $id . '.pdf';

        header('Content-type: application/pdf');

        header('Content-Disposition: inline; filename="document.pdf"');

        header('Content-Transfer-Encoding: binary');

        $domain_pricings = DomainPricing::where('type', 'addons')->where('status', '1')->get();

        $orderDetails   = Order::where('id', $id)->with(['user.client.country', 'orderItems.plan', 'payment_method'])->first();

        $base64 = 'resources/assets/frontend/images/index/logo_large.png';



        $style = 'resources/assets/frontend/css/pdf.css';

        // return view('admin.orders.billing_invoice_pdf', compact('orderDetails','base64','style','domain_pricings', 'plans'));

        // die;

        $gstRate = GstRate::where(function ($query) {

            $query->where('status', 1)

                ->orWhere('status', 2);

        })->first();

        $html = view('admin.orders.billing_invoice_pdf', compact('orderDetails', 'base64', 'style', 'domain_pricings', 'plans', 'gstRate'));

        $filename = 'invoice_' . $id . '.pdf';

        return @\PDF::loadHTML($html, 'utf-8')->stream();

    }

    public function invoice_pdf($id)

    {



        // $id = $request->id;  

        // header('Content-type: application/pdf');

        // header('Content-Disposition: inline; filename="document.pdf"');

        // header('Content-Transfer-Encoding: binary');

        $data['title'] = "Invoice Table List";

        $domain_pricings = DomainPricing::where('type', 'addons')->where('status', '1')->get();

        $orderDetails   = Order::where('id', $id)->with(['user.client.country', 'orderItems.plan'])->first();

        // $plans = Plan::where('status', 1)->get();

        $base64 = 'resources/assets/frontend/images/index/logo_large.png';

        $style = 'resources/assets/frontend/css/pdf.css';

        // dd($base64);die();

        // $html = view('admin.orders.billing_invoice_pdf', compact('orderDetails','base64','style','domain_pricings', 'plans'))->render();

        $filename = 'invoice_' . $id . '.pdf';

        $font = storage_path('fonts/Open_sans');

        // return @\PDF::loadHTML($html, 'utf-8')->stream();

        $total_price = 0;

        $discount_price = 0.00;

        $pdf = @\PDF::loadView('admin.orders.billing_invoice_pdf', compact('orderDetails', 'base64', 'style', 'domain_pricings', 'plans', 'total_price', 'discount_price'));

        return $pdf->download($filename);

        // $html = view('admin.orders.billing_invoice_pdf', compact('orderDetails', 'domain_pricings', 'plans'))->render();

        // $pdf = @\PDF::loadView('admin.orders.billing_invoice_pdf', compact('orderDetails','base64','style', 'domain_pricings', 'plans'));

        // return $pdf->download('invoice.pdf');

        // $pdf =  PDF::loadView('admin.orders.billing_invoice_pdf', compact('orderDetails','base64','style', 'domain_pricings', 'plans'))

        //     ->setPaper('a4', 'landscape');

        // return $pdf->download('invoice.pdf');







        // return view('admin.orders.billing_invoice_pdf', compact('base64','style','orderDetails', 'domain_pricings', 'plans'));

    }

    public function generate_receipt(Request $request)

    {

        $id = $request->id;

        set_time_limit(300);

        $domain_pricings = DomainPricing::where('type', 'addons')->where('status', '1')->get();

        $orderDetails   = Order::where('id', $id)->with(['user.client.country', 'orderItems.plan'])->first();

        // dd($orderDetails);

        $plans = Plan::where('status', 1)->orWhere('status', 2)->get();

        $base64 = 'resources/assets/frontend/images/index/logo_large.png';

        $style = 'resources/assets/frontend/css/pdf.css';

        $bootstrap = 'resources/assets/admin/vendors/boostrap/css/bootstrap.min.css';

        // dd($base64);die();

        // $html = view('admin.orders.billing_receipt_pdf', compact('orderDetails','bootstrap','base64','style','domain_pricings', 'plans'))->render();

        // return @\PDF::loadHTML($html, 'utf-8')->stream();

        // die;

        $total_price = 0;

        $discount_price = 0.0;

        $pdf = @\PDF::loadView('admin.orders.billing_receipt_pdf', compact('orderDetails', 'base64', 'style', 'domain_pricings', 'plans', 'total_price', 'discount_price'));

        // $pdf->set_option('font_dir', );

        // $pdf->stream();

        $output = $pdf->output();



        $filename = 'receipt_' . $id . '.pdf';

        $exists = Storage::disk('pdf')->exists($filename);



        if ($exists) {

            // dd('exists');

            // $pdf_route = asset('storage/pdf/'.$filename);

            // Storage::disk('pdf')->delete ($filename);

            // Storage::disk('pdf')->->putFileAs('pdf', $output, $filename);

            // Storage::disk('pdf')->put($filename, $output);

            $pdf_route = asset('storage/pdf/' . $filename);

        } else {

            // dd('not exists');

            file_put_contents(storage_path('pdf/' . $filename), $output);

            // $pdf_route = Storage::url('app/public/pdf/'.$filename);

            $pdf_route = asset('storage/pdf/' . $filename);

        }

        // Storage::disk('pdf')->putFileAs('pdf', $output, $filename);

        $response = array();

        $response['pdf_route'] = $pdf_route;

        return response()->json($response);



        // return $pdf->download($filename);

    }

    public function billing_invoice_new()

    {

        $transaction_id    = str_random(17);

        $exist = Order::where('transaction_id', '=', $transaction_id)->first();

        if (count($exist) > 0) {

            $transaction_id = str_random(17);

        } else {

            $transaction_id;

        }

        $date = date('Y-m-d H:i:s');

        $users   = new User();

        $default_option = ['_default' => '- Please select -'];

        $payment_methods = PaymentMethod::getPaymentMethodListArray($default_option);

        $this->data['user_client_accounts'] = $users = $users->getUserClientList($user_type = 'Client');



        $this->data['countries'] = Country::getCountryListArray($default_option);



        $data = $this->data;

        // echo $transaction_id;

        // dd($data);

        return view('admin.invoices.billing_invoice_new', compact('data', 'transaction_id', 'date', 'payment_methods'));

    }

    public function newinvoice(Request $request)

    {

        // dd($request->all());

        $current_date = date('m/d/Y', strtotime('tomorrow'));

        $fields       = Input::all();

        $payment_methods = PaymentMethod::all()->implode('id', ',');

        $cities                  = City::all()->implode('id', ',');

        $states                  = State::all()->implode('id', ',');

        $countries           = Country::all()->implode('id', ',');

        $users                   = User::all()->implode('id', ',');



        $return_data = [

            'update_status'        => False,

            'update_message'         => 'Failed to update Invoice information. Please try again.'

        ];



        $validation_rules = [

            'invoice-start-date'     => 'required|date|before:' . $current_date,

            'invoice-due-date'               => 'required|date',

            'invoice-payment-date'     => 'required|date|before:' . $current_date,

            'invoice-payment-method'   => 'required|numeric|in:' . $payment_methods,

            'order-txn-id'               => 'required|alpha_num',

            'order-cheque-num'       => 'required_if:order-payment-method,4|numeric',



            'user-client-process'                => 'required|in:existing-user,new-user',



            'user-client-target'                         => 'required_if:user-client-process,existing-user|in:' . $users,



            'user-client-account-type'           => 'required_if:user-client-process,new-user|in:business-account,individual-account',

            'user-client-first-name'                 => 'required_if:user-client-process,new-user|regex:/^[a-zA-Z\s\-]+$/|max:255',

            'user-client-last-name'                  => 'required_if:user-client-process,new-user|regex:/^[a-zA-Z\s\-]+$/|max:255',

            'user-client-company'                    => 'required_if:user-client-process,new-user|regex:/^[a-zA-Z0-9\s\-\.\,\/]+$/|max:255',

            'user-client-email'                          => 'required_if:user-client-process,new-user|email|unique:users,email|max:255',

            'user-client-phone-number'           => 'required_if:user-client-process,new-user|numeric|digits_between:8,10',

            'user-client-mobile-number'          => 'required_if:user-client-process,new-user|numeric|digits_between:8,10',

            'user-client-address-1'                  => 'required_if:user-client-process,new-user|regex:/^[a-zA-Z0-9\s\-\.\,\/]+$/|max:255',

            'user-client-address-2'                  => 'required_if:user-client-process,new-user|regex:/^[a-zA-Z0-9\s\-\.\,\/]+$/|max:255',

            'user-client-postal-code'                => 'required_if:user-client-process,new-user|numeric',

            'user-client-city'                           => 'required_if:user-client-process,new-user|in:' . $cities,

            'user-client-state'                          => 'required_if:user-client-process,new-user|in:' . $states,

            'user-client-country'                        => 'required_if:user-client-process,new-user|in:' . $countries,

        ];



        $custom_messages = [

            'order-cheque-num.required_if'          => 'Cheque # is required if payment method is "Cheque".',

            'invoice-payment-method.in'                 => 'Please choose a payment method from the dropdown.',

            'invoice-payment-method.numeric'                  => 'Please choose a payment method from the dropdown.',

            'user-client-first-name.required_if'    => ':attribute is required.',

            'user-client-last-name.required_if'       => ':attribute is required.',

            'user-client-company.required_if'           => ':attribute is required.',

            'user-client-email.required_if'               => ':attribute is required.',

            'user-client-phone-number.required_if'  => ':attribute is required.',

            'user-client-mobile-number.required_if' => ':attribute is required.',

            'user-client-address-1.required_if'         => ':attribute is required.',

            'user-client-address-2.required_if'       => ':attribute is required.',

            'user-client-postal-code.required_if'   => ':attribute is required.',

            'user-client-city.required_if'              => ':attribute is required.',

            'user-client-state.required_if'             => ':attribute is required.',

            'user-client-country.required_if'           => ':attribute is required.'

        ];



        $validator = Validator::make($fields, $validation_rules, $custom_messages);



        if ($validator->fails()) {

            $request->flash();



            $default_option = ['_default' => '- Please select -'];



            $return_data['update_message'] = 'Some of the provided data are invalid. Please check the errors below.';



            $return_data = $this->addCitiesAndStates($fields, $return_data, $default_option);



            return redirect()->route('billing_invoice_new')

                ->withErrors($validator)

                ->with($return_data);

        }



        if ($fields['user-client-process'] === 'new-user') {

            $fields['user-client-target'] = User::createNew($fields);

        }



        // Save Order Info

        $save_data = Order::AddInfo($fields);

        $return_data['update_status']  = True;

        $return_data['update_message'] = 'New Invoice info successfully Added.Please update your invoice items here.';

        return redirect()->route('order_edit', ['id' => $save_data])

            ->with($return_data);

    }

    public function get_plan_detail($id)

    {



        $plans = Plan::where('id', $id)->where('status', 1)->first();

        $plan_id = $id;

        $query1 = Plan::getPomocodebyPlan($plan_id);

        $query2 = Plan::getDiscountByPlan($plan_id);



        if (count($plans) > 0) {

            echo json_encode(['status' => 1, 'plans' => $plans, 'promocode' => $query1, 'discount' => $query2]);

        } else {

            echo json_encode(['status' => 0]);

        }

    }

    //aklima



    // Added by Rejohn

    public function receipts_list(Request $request)

    {

        $items = 10;

        if ($request->items) {

            $items = $request->items;

        }

        $paidReceipts = Order::where('status', 'COMPLETED')->where('invoice_status', '0')->orderBy('created_at', 'DESC')->paginate(10);

        $paymentInfo = PaymentMethod::all();

        $payments = array();

        foreach ($paymentInfo as $payment) {

            $payments[$payment->id] = $payment->name;

        }

        $clientInfos = Client::all();

        $clients = array();

        foreach ($clientInfos as $client) {

            $clients[$client->user_id] = $client->client_id;

        }

        $userInfos = User::all();

        $users = array();

        foreach ($userInfos as $user) {

            $users[$user->id] = $user->email;

        }

        if ($request->isMethod('post')) {

            $keywords = array();

            $query = Order::orderBy(

                'id',

                'asc'

            );



            if ($request->has('transaction_id')) {

                $find = 'MY-';

                $replace = '';

                $og_txn_id = trim($request->transaction_id);

                $transaction_id = str_replace($find, $replace, $og_txn_id);

                $query->where('transaction_id', $transaction_id);

                $keywords['transaction_id'] = $og_txn_id;

            }



            if ($request->has('id')) {

                $query->OrWhere('id', $request->id);

                $keywords['id'] = $request->id;

            }

            if (

                $request->has('start') || $request->has('end') || $request->has('payment_date')

            ) {

                $newDateFormat3 = \Carbon\Carbon::parse($request->start)->format('Y-m-d');

                $newDateFormat4 = \Carbon\Carbon::parse($request->end)->format('Y-m-d');

                $newDateFormat5 = \Carbon\Carbon::parse($request->payment_date)->format('Y-m-d');

                $request->OrWhereDate('payment_date', '=', $newDateFormat5);

                $query->OrWhereDate('created_at', '>=', $newDateFormat3);

                $query->WhereDate('created_at', '<=', $newDateFormat4);

                $keywords['start'] = $request->start;

                $keywords['end'] = $request->end;

                $keywords['payment_date'] = $request->payment_date;

            }



            if ($request->has('total_amount')) {

                $query->OrWhere('total_amount', $request->total_amount);

                $keywords['total_amount'] = $request->total_amount;

            }



            if ($request->has('payment_status')) {

                if (

                    $request->payment_status == 'paid'

                ) {

                    $status = 'COMPLETED';

                    $query->OrWhere('status', $status);

                }

                if (

                    $request->payment_status == 'failed'

                ) {

                    $status = 'FAILED';

                    $query->OrWhere('status', $status);

                }



                if (

                    $request->payment_status != 'none'

                )

                    $keywords['payment_status'] = $request->payment_status;

            }



            if ($request->has('client_name')) {

                $client_name = $request->client_name;

                $data = Client::where('first_name', 'Like', '%' . $client_name . '%')->orwhere('last_name', 'Like', '%' . $client_name . '%')->first();

                $client_name = isset($data) ? $data->user_id : '';

                $query->OrWhereHas('user', function ($q) use ($client_name) {

                    $q->where('id', '=', $client_name);

                });

                $keywords['client_name'] = $request->client_name;

            }





            if ($request->has('client_id')) {

                $client_id = $request->client_id;

                $find1 = 'B-';

                $find2 = '-MY';

                $replace = '';

                $client_id  = Str_replace($find1, $replace, $client_id);

                $client_id  = Str_replace($find2, $replace, $client_id);

                //remove special chars

                $client_id = preg_replace("/[^0-9]/", "", $client_id);

                $query->OrWhereHas('user', function ($q) use ($client_id) {

                    $q->where('id', '=', $client_id);

                });

                $keywords['client_id'] = $request->client_id;

            }



            if ($request->has('payment_method')) {

                $payment_method = PaymentMethod::where('name', '=', $request->payment_method)->first();

                $payment_id = isset($payment_method) ? $payment_method->id : '';

                $query->OrWhere('payment_method_id', $payment_id);

                $keywords['payment_method'] = $request->payment_method;

            }

            // $query->Where('type', 1);



            $allOrders = $query->paginate($items);

        } else {

            // $allOrders = Order::where('type', 1)->paginate($items);

            $allOrders = Order::where('invoice_status', '1')->orderBy('created_at', 'DESC')->paginate($items);

        }

        $recent_update = $this->recent_update_time();

        // dd($paidReceipts, $allOrders);

        return view('admin.receipt.billing_receipts_list')->with([

            'paidReceipts' => $paidReceipts,

            'allOrders' => $allOrders,

            'payments' => $payments,

            'clients' => $clients,

            'users' => $users,

            'items' => $items,

            'recent_update' => $recent_update

        ]);

    }



    public function generate_pdf(Request $request)

    {

        $id = $request->id;

        $style = 'resources/assets/frontend/css/pdf.css';

        $icons = url('public_html/html_new_design/css/simpleline-icons/simple-line-icons.css');

        $domain_pricings = DomainPricing::where('type', 'addons')->where('status', '1')->get();

        $orderDetails   = Order::where('id', $id)->with(['user.client.country', 'orderItems.plan'])->first();

        $html = view('admin.orders.new_pdf_1', compact('orderDetails', 'domain_pricings','icons', 'style', 'id'))->render();

        //remove sapce between two tags

        $html = preg_replace('/>\s+</', '><', $html);

        return $html;

    }



    public function print_pdf_1($id)

    {

       

        set_time_limit(3000);

        // $id = $request->id;  

        $filename = 'receipt_' . $id . '.pdf';

        $style = 'resources/assets/frontend/css/pdf.css';

        $icons = url('public_html/html_new_design/css/simpleline-icons/simple-line-icons.css');

        $domain_pricings = DomainPricing::where('type', 'addons')->where('status', '1')->get();

        $orderDetails   = Order::where('id', $id)->with(['user.client.country', 'orderItems.plan'])->first();

        //$pdf = PDF::loadView('admin.orders.new_pdf_2', compact('orderDetails', 'domain_pricings', 'icons','style', 'id'));
        $pdf = \PDF::loadView('admin.orders.new_pdf_1', compact('orderDetails', 'domain_pricings','icons', 'style', 'id'));
        return $pdf->download('invoice.pdf');


         $html = view('admin.orders.new_pdf_1', compact('orderDetails', 'domain_pricings','icons', 'style', 'id'));

        // //remove sapce between two tags

        $html = preg_replace('/>\s+</', '><', $html);

        return @\PDF::loadHTML($html, 'utf-8')->stream();

        //  $pdf = PDF::loadHTML($html);

        // return $pdf->download($filename);

          //$dompdf =new  \Dompdf\Dompdf();

        // $dompdf->loadHtml($html);

        // $dompdf->setPaper('A4', 'portrait');

        // $dompdf->render();

        // $dompdf->stream();



    }



    // public function receipt_generate(Request $request)

    // {

    //     $id = $request->id;



    //     $domain_pricings = DomainPricing::where('type', 'addons')->where('status', '1')->get();

    //     $orderDetails   = Order::where('id', $id)->with(['user.client.country', 'orderItems.plan'])->first();

    //     return  view('admin.orders.new_pdf', compact('orderDetails', 'domain_pricings', 'id'))->render();

    // }



    public function receipt_generate(Request $request)

    {

        $id = 422;



        set_time_limit(3000);



        $domain_pricings = DomainPricing::where('type', 'addons')->where('status', '1')->get();



        $orderDetails   = Order::where('id', $id)->with(['user.client.country', 'orderItems.plan'])->first();



        $plans = Plan::where('status', 1)->orWhere('status', 2)->get();



        $base64 = 'resources/assets/frontend/images/index/logo_large.png';



        $style = 'resources/assets/frontend/css/pdf.css';



        $bootstrap = 'resources/assets/admin/vendors/boostrap/css/bootstrap.min.css';



        // dd($base64);die();



        // $html = view('admin.orders.billing_receipt_pdf', compact('orderDetails','bootstrap','base64','style','domain_pricings', 'plans'))->render();



        // return @\PDF::loadHTML($html, 'utf-8')->stream();



        // die;

        // $pdf = @\PDF::loadView('admin.orders.new_pdf', compact('orderDetails', 'domain_pricings', 'id'));

        $pdf = @\PDF::loadView('admin.orders.billing_receipt_pdf', compact('orderDetails', 'base64', 'style', 'domain_pricings', 'plans'));



        //return $pdf->download('test.pdf');



        // $pdf->set_option('font_dir', );



        $pdf->stream();



        $output = $pdf->output();







        $filename = 'receipt_' . $id . '.pdf';







        $exists = Storage::disk('pdf')->exists($filename);



        if ($exists) {



            // $pdf_route = asset('storage/pdf/'.$filename);



            // Storage::disk('pdf')->delete ($filename);



            // Storage::disk('pdf')->->putFileAs('pdf', $output, $filename);



            // Storage::disk('pdf')->put($filename, $output);



            $pdf_route = asset('storage/pdf/' . $filename);

        } else {



            file_put_contents(storage_path('pdf/' . $filename), $output);



            // $pdf_route = Storage::url('app/public/pdf/'.$filename);



            $pdf_route = asset('storage/pdf/' . $filename);

        }



        // Storage::disk('pdf')->putFileAs('pdf', $output, $filename);



        // dd($filename);



        Order::where('id', $id)->update(['invoice_status' => 1, 'invoice_name' => $pdf_route]);



        $response = array();



        $response['pdf_route'] = $pdf_route;



        return response()->json($response);



        // return $pdf->download($filename);

    }



    function receipts_delete(Request $request)

    {

        $delete = Order::where('id', $request->get('target_receipt'))->delete();

        if ($delete) {

            OrderItem::where('order_id', $request->get('target_receipt'))->delete();

            $request->session()->flash('success', 'deleted');

        } else {

            $request->session()->flash('error', 'not deleted');

        }

        return redirect()->back();

    }



    public function receipts_selected_delete(Request $request)

    {

        $orderIdsArray = explode(",", $request->get('target_receipt'));

        foreach ($orderIdsArray as $deleteId) {

            $delete = Order::where('id', $deleteId)->delete();

            if ($delete) {

                OrderItem::where('order_id', $deleteId)->delete();

                $request->session()->flash('success', 'deleted');

            } else {

                $request->session()->flash('error', 'not deleted');

            }

        }

        return redirect()->back();

    }



    public function receipts_csv_export(Request $request)

    {

        $allOrders = DB::table('orders')

            ->join('client_registration_info', 'orders.user_id', '=', 'client_registration_info.user_id')

            ->select('orders.id as receipt', 'client_registration_info.client_id as client_id', 'orders.total_amount as invoice_value', 'orders.transaction_id as invoice')

            ->orderBy('orders.created_at', 'DESC')

            ->get();



        return response()->json($allOrders);

    }



    public function receipts_pdf_send(Request $request)

    {

        $clientInfo = DB::table('client_registration_info')->select('first_name', 'last_name')->where('user_id', $request->user_id)->first();



        $from = config('mail.username');



        $data = array(

            'name' => $clientInfo->first_name . ' ' . $clientInfo->last_name,

            'email' => $request->email,

        );



        $users = [];

        // foreach ($request->emailcc as $key => $value) {

        //     if (!empty($value)) {

        //         $ua = [];

        //         $ua['email'] = $value;

        //         $users[$key] = (object)$ua;

        //     }

        // }



        $domain_pricings = DomainPricing::where('type', 'addons')->where('status', '1')->get();

        $orderDetails   = Order::where('id', $request->order_id)->with(['user.client.country', 'orderItems.plan'])->first();

        $plans = Plan::where('status', 1)->get();

        $base64 = 'resources/assets/frontend/images/index/logo_large.png';

        $style = 'resources/assets/frontend/css/pdf.css';

        $font = storage_path('fonts/Roboto');

        $filename = 'Receipt_' . $request->order_id . '.pdf';



        //Feedback mail to client

        $pdf = PDF::loadView('admin.orders.billing_invoice_pdf', compact('orderDetails', 'base64', 'style', 'domain_pricings', 'plans'));



        // $pdf = PDF::loadView('your_view_name', $data)->setPaper('a4'); 



        // dd($users);die();

        Mail::send('emails.receipt', $data, function ($message) use ($from, $data, $pdf, $users, $filename) {

            $message->from($from);

            $message->to($data['email']);

            // $message->cc($users);

            $message->subject('Receipt');

            //Attach PDF doc

            $message->attachData($pdf->output(), $filename);

        });



        Session::flash('success', 'Hello &nbsp;' . $data['name'] . '&nbsp;Thank You for choosing us. Will reply to your query as soon as possible');



        // return redirect()->back();

        if (count(Mail::failures()) > 0) {

            // return failed mails

            // return new Error(Mail::failures()); 

            return json_encode(array('success' => 0, 'message' => 'Mail Not send'));

        }



        return json_encode(array('success' => 1, 'message' => 'message Sent successfully'));

        // return redirect()->back();



    }



    public function recent_update_time()

    {

        $recent_date_timestamp = Order::select('updated_at')->where("invoice_status", 1)->orderBy('updated_at', 'desc')->first();

        $recent_update = date("d M,Y") . " @ " . date("h:i a");

        if ($recent_date_timestamp) {

            $recent_update = date("d M,Y", strtotime($recent_date_timestamp->updated_at)) . " @ " . date("h:i a", strtotime($recent_date_timestamp->updated_at));

        }

        return $recent_update;

    }

}

