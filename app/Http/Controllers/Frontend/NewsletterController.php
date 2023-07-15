<?php

namespace App\Http\Controllers\Frontend;


use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\City;
use App\Models\Client;
use App\Models\Client_billing_info;
use App\Models\Country;
use App\Models\domain;
use App\Models\GeneralFeature;
use App\Models\IndexPlan;
use App\Models\OfferSerivce;
use App\Models\Page;
use App\Models\State;
use App\Models\Testimonial;
use App\Models\User;
use App\Models\Video;
use App\Models\Banner;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Storage;
use App\Models\Tickets;
use App\Models\Newsletter;


class NewsletterController extends Controller {
	/*function __construct() {

	}*/
	private $data = array();

	/*
	|--------------------------------------------------------------------------
	| Newsletter Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "Newslettr Subscribers".
	|
	*/

	/**
	 * construct
	 */
	public function __construct()
	{
		$this->middleware('auth');
		$this->NewsletterModel = new Newsletter();
	}


	/**
	 * Dashboard Page for Newsletter
	 */
	function index($item=10, $page=1)
	{
		$this->data['page'] = $page;
		$this->data['item'] = $item;

		$lastUpdated = $this->NewsletterModel->getLastUpdated();

		$subscribers = $this->NewsletterModel->getSubscribers($item, $page);

		//// Total user groups
		$totalSubscribers = DB::table('newsletter')->orderBy('id','desc')->get();
		$this->data['countSubscribers'] = count($totalSubscribers);

		$this->data['lastUpdated'] = $lastUpdated;

		$this->data['subscribers'] = $subscribers;

		$this->data['success'] = Session::get('response');
		Session::forget('response');

		$this->data['page_title']='Newsletter Subscribers:: Listing';

		if($this->data['countSubscribers'] < $item and $page!=1){
			return Redirect::to('web88cms/newsletter/'.$item.'/1');
		}

		return view('admin.newsletter.index', $this->data);
	}


	/**
	 * Add Subscriber
	 */
	function addSubscriber(Request $request)
	{
		/*if(Request::isMethod('post'))
		{
			$validator = Validator::make(Request::all(),[
				//'subscriberName' => 'required',
				'email' => 'required|email'
			]);

			if ($validator->fails()) {
				$json['error'] = $validator->errors()->all();
				echo json_encode($json);
				exit;
			}else{*/
				if($this->NewsletterModel->addSubscriber($request)){
					echo json_encode(array('success' => 'success', 'status' => true));
				}else{
					echo json_encode(array('success' => 'error', 'status' => false));
				}


				exit;
			/*}
		}*/
	}


	/**
	 * Edit Subscriber
	 */
	function editSubscriber()
	{
		if(Request::isMethod('post'))
		{
			$validator = Validator::make(Request::all(),[
				'subscriberName' => 'required',
				'email' => 'required|email'
			]);

			if ($validator->fails()) {
				$json['error'] = $validator->errors()->all();
				echo json_encode($json);
				exit;
			}else{

				$this->NewsletterModel->updateSubscriber(Request::input());

				echo json_encode(array('success' => 'success'));
				exit;
			}
		}

	}


	/**
	 * Delete Subscriber
	 */
	function deleteSubscriber(Request $request) {
		$return_data = [ 'delete_status' => False ];

		$delete = Newsletter::where('id', $request->get('target_subscriber'))->delete();

		if ($delete) {
			$return_data['delete_status'] = True;
		}

		return redirect('/newsletter')->with($return_data);
	}

	/**
	 * Delete selected subscribers
	 */
	function deleteSubscriberSelected(Request $request) {
		$session_status = [ 'delete_status' => False ];

		$subscribers = Newsletter::destroy(Input::get('subscribers_checkbox'));

		if ($subscribers) {
			$session_status['delete_status'] = True;
		}

		return redirect('/newsletter')->with($session_status);
	}


	/**
	 * Delete All Subscriber
	 */
	function deleteAll() {
		$session_status = [ 'delete_status' => False ];

		if (Newsletter::whereNotNull('id')->delete()) {
			$session_status['delete_status'] = True;
		}
		return redirect('/newsletter')->with($session_status);
	}



	/**
	 * Export Newsletter Subscribers Table into CSV file
	 */
	function csv(){
		$table = DB::table('newsletter')->get();

		$filename = "subscribers.csv";
		$handle = fopen($filename, 'w+');
		fputcsv($handle, array('name', 'email'));

		foreach($table as $row) {
			fputcsv($handle, array($row->name, $row->email));
		}

		fclose($handle);

		$headers = array(
			'Content-Type' => 'text/csv',
			'Content-Disposition' => 'attachment; filename="subscribers.csv"',
		);

		return Response::download('subscribers.csv', 'subscribers.csv', $headers);
	}

	public function empty_newsletter(Request $request){

		if($request->has('id')){
			$cart = Newsletter::where('id', $request->id)->delete();
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

		$cart = Newsletter::WhereIn('id', $request->ids)->delete();
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

}
