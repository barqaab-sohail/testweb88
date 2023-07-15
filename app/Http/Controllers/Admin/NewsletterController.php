<?php

namespace App\Http\Controllers\Admin;


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
use App\Models\Tickets;
use App\Models\Newsletter;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

use Illuminate\Validation\Rule;

use Storage;
use Session;
use Auth;
use DB;

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
	function index($per_page=10)
	{
		$this->data['page'] = $per_page;
		//$this->data['item'] = $item;

		$lastUpdated = $this->NewsletterModel->getLastUpdated(True);

		$subscribers = Newsletter::orderBy('id','desc')
														 ->paginate($per_page);

		//$this->NewsletterModel->getSubscribers($item, $page);

		//// Total user groups
		$totalSubscribers = Newsletter::all();
		$this->data['countSubscribers'] = count($totalSubscribers);

		$this->data['lastUpdated'] = $lastUpdated;

		$this->data['subscribers'] = $subscribers;

		$this->data['success'] = Session::get('response');
		Session::forget('response');

		$this->data['page_title']='Newsletter Subscribers:: Listing';

		/*if($this->data['countSubscribers'] < $item and $page!=1){
			return Redirect::to('web88cms/newsletter/'.$item.'/1');
		}*/
		//dd($this->data);
		$news = $this->data;
		return view('admin.newsletter.index')->with('news', $news);
	}


	/**
	 * Add Subscriber
	 */
	function addSubscriber(Request $request) {
		$validation_rules = [
			'subscriber_status ' => 'sometimes|accepted',
			'name'							 => 'required|regex:/^[a-zA-Z\s\-]+$/|max:40',
			'email'					 		 => 'required|email|unique:newsletter,email,NULL,id,deleted_at,NULL',
			'company'						 => 'required|max:40',
			'telephone'			 		 => 'required|digits_between:7,10'
		];

		$fields = Input::all();
		$save_status = [
			'save_status' 		=> False,
			'save_status_msg' => 'Failed to save subscriber data. Please try again.'
		];

		$validator = Validator::make($fields, $validation_rules);

		if ($validator->fails()) {
			$request->flash();

			return redirect('/newsletter')->withErrors($validator)
																		->with([ 'create-error' => True ]);
		}

		$subscriber = new Newsletter();

		if ($subscriber->addSubscriber($fields)) {
			$save_status['save_status'] = True;
			$save_status['save_status_msg'] = 'Subscriber successfully saved!';
		}

		return redirect('/newsletter')->with($save_status);
	}


	/**
	 * Edit Subscriber
	 */
	public function editSubscriber(Request $request) {
		if($request->isMethod('post'))
		{
			$subscriber = DB::table('newsletter')->select('name','email','company','telephone','status')->where('id',$request->id)->first();
			if(isset($subscriber)){
			echo json_encode(array('success' => 'success', 'status' => true , 'data' => $subscriber ));
			}
			else{
			echo json_encode(array('success' => 'error', 'status' => false));
		}
		}
	}

    /**
	 * update Subscriber
	 */
	public function  updatesubscriber(Request $request ){
		$fields = Input::all();

		$validation_rules = [
			'edit_subscriber_status '  => 'sometimes|accepted',
			'edit_name'			 				   => 'required|regex:/^[a-zA-Z\s\-]+$/|max:40',
			'edit_email'					 		 => 'required|email|unique:newsletter,email,' . $fields['subscriber_id'] . ',id,deleted_at,NULL',
			'edit_company'						 => 'required|max:40',
			'edit_telephone'			 		 => 'required|digits_between:7,10'
		];

		$save_status = [
			'save_status' 		=> False,
			'save_status_msg' => 'Failed to update subscriber data. Please try again.'
		];

		$validator = Validator::make($fields, $validation_rules);

		if ($validator->fails()) {
			$request->flash();

			return redirect('/newsletter')->withErrors($validator)
																		->with([ 'edit-error' => True ]);
		}

		$subscriber = new Newsletter();

		if ($subscriber->updateSubscriber($fields)) {
			$save_status['save_status'] = True;
			$save_status['save_status_msg'] = 'Subscriber data is successfully updated.';
		}

		return redirect('/newsletter')->with($save_status);
	}




	// function editSubscriber(Request $request)
	// {

	// 	if($request->isMethod('post'))
	// 	{
	// 		$validator = Validator::make($request->all(),[
	// 			'subscriberName' => 'required',
	// 			'email' => 'required|email'
	// 		]);

	// 		if ($validator->fails()) {
	// 			$json['error'] = $validator->errors()->all();
	// 			echo json_encode($json);
	// 			exit;
	// 		}else{

	// 			$this->NewsletterModel->updateSubscriber(Request::input());

	// 			echo json_encode(array('success' => 'success'));
	// 			exit;
	// 		}
	// 	}

	// }


	/**
	 * Delete Subscriber
	 */
	function deleteSubscriber()
	{
		if(Request::isMethod('post'))
		{
			$this->NewsletterModel->deleteSubscribers(Request::input());

			return Redirect::to('web88cms/newsletter')->withFlashMessage('Subscriber(s) has been deleted successfully..');
		}
	}

	/**
	 * Delete All Subscriber
	 */
	function deleteAll()
	{
		$this->NewsletterModel->deleteAll();

		return Redirect::to('web88cms/newsletter')->withFlashMessage('All Subscribers has been deleted successfully..');
	}



	/**
	 * Export Newsletter Subscribers Table into CSV file
	 */
	function generateCsv(){
		// $table = DB::table('newsletter')->get();
		$table = Newsletter::all();

		$filename = 'subscribers-export-' . date('Y-m-d_h-i-s') . '.csv';

		$handle = fopen($filename, 'w+');
		fputcsv($handle, [ 'name', 'email', 'company', 'telephone', 'status' ]);

		foreach($table as $row) {
			$status = 'Active';

			if (intval($row->status) === 0)
			{
				$status = 'Inactive';
			}

			$data = [ $row->name, $row->email, $row->company, $row->telephone, $status ];

			fputcsv($handle, $data);
		}

		fclose($handle);

		$headers = array(
			'Content-Type' => 'text/csv',
			'Content-Disposition' => 'attachment; filename="' + $filename + '"',
		);

		return response()->download($filename, $filename, $headers);
	}
}
