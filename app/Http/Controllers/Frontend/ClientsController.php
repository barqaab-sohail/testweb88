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
use App\Models\Article;
use App\Models\Plan;
use App\Models\GstRate;

use Excel;
use App\Exports\InvoiceExport;
use PDF;

class ClientsController extends Controller
{
	public function index()
	{
		$order_items = OrderItem::OrderBy('created_at', 'Desc')->with('order')->take('5')->get();

		$orders = Order::OrderBy('created_at', 'Desc')->take('5')->get();

		$domain_pricings = DomainPricing::where('type', 'addons')->where('status', '1')->get();

		//dd($order_items->toArray());
		return view('frontend.client_area_home', compact('order_items', 'orders', 'domain_pricings'));
	}

	public function order_history_list()
	{
		if (isset($_GET['search'])) {
			if (strstr($_GET['search'], 'MY')) {
				$searchString = explode('-', $_GET['search']);
				$searchString = $searchString[1];
			} else {
				$searchString = $_GET['search'];
			}
			$orderBy = isset($_GET['orderBy']) ? $_GET['orderBy'] : 'updated_at';
			$order   = isset($_GET['order']) ? $_GET['order'] : 'asc';
			$orders  = Order::where('user_id', Auth::id())->where('id', 'like', '%' . $searchString . '%')
				->orWhere('transaction_id', 'like', '%' . $searchString . '%')
				->orderBy($orderBy, $order)
				->paginate(30);
		} else {
			$orders = Order::where('user_id', Auth::id())->OrderBy('created_at', 'Desc')->paginate(30);
		}
		$counts = array();
		foreach ($orders as $key => $value) {
			if ($value->status === 'COMPLETED') {
				$counts[$key] = ['status' => 'Active'];
				$value->status = 'PAID';
			} else if ($value->status === 'INCOMPLETE' || $value->status === 'FAILED') {
				$counts[$key] = ['status' => 'Pending'];
				$value->status = 'UNPAID';
			} else {
				$counts[$key] = ['status' => 'Expired'];
				$value->status = 'Expired';
			}
		}
		$totalOrders         = Order::where('user_id', Auth::id())->OrderBy('created_at', 'Desc')->count();
		$totalPaidOrders     = Order::where(['user_id' => Auth::id(), 'status' => 'COMPLETED'])->count();
		$totalUnpaidOrders   = Order::where(['user_id' => Auth::id(), 'status' => 'INCOMPLETE'])->count();
		$totalFailedOrders   = Order::where(['user_id' => Auth::id(), 'status' => 'FAILED'])->count();
		// dd($orders);die();
		// $totalPendingOrders = Order::where(
		//               	function ($query) use ($user_id) {
		// 		    $query->where('user_id', $user_id)
		// 		        ->where('status', '=', 'INCOMPLETE');
		// 		})->orWhere(function($query) use($user_id) {
		// 		    $query->where('user_id', $user_id)
		// 		        ->where('status', '=', 'FAILED');	
		// 		});		
		// $totalPendingOrders = $totalPendingOrders->count();
		// echo '<pre>';echo( json_encode($orders));die();
		return view('frontend.order_history_list', compact('orders', 'totalPendingOrders', 'totalOrders', 'totalPaidOrders', 'totalUnpaidOrders', 'totalFailedOrders', 'counts'));
	}

	/***
		Get Specific order details
	 ***/
	public function orderDetails($id)
	{

		$orderDetails 	 = Order::with('orderItems.plan')->where(['user_id' => Auth::id(), 'id' => $id])->first();
		$domain_pricings = DomainPricing::where('type', 'addons')->where('status', '1')->get();
		$plans = Plan::where('status', '1')->get();
		$gstRate = GstRate::where(function ($query) {
			$query->where('status', 1)
				->orWhere('status', 2);
		})->first();
		return view('frontend.order_details', compact('orderDetails', 'domain_pricings', 'plans', 'gstRate'));
	}

	public function receiptDetails($id)
	{
		$filename = 'receipt_' . $id . '.pdf';
		$orderDetails 	 = Order::with(['user.client.country', 'orderItems.plan'])->where(['user_id' => Auth::id(), 'id' => $id])->first();
		if ($orderDetails->status == 'COMPLETED') {
			$domain_pricings = DomainPricing::where('type', 'addons')->where('status', '1')->get();

			$plans = Plan::where('status', '1')->get();
			$base64 = 'resources/assets/frontend/images/index/logo_large.png';
			$style = 'resources/assets/frontend/css/reset.css';
			$style2 = 'resources/assets/frontend/css/style.css';
			$bootstrap = 'resources/assets/frontend/js/mainmenu/bootstrap.min.css';
			$html = view('frontend.receipt_detail', compact('orderDetails', 'base64', 'style', 'style2', 'bootstrap', 'domain_pricings', 'plans'))->render();
			@\PDF::setOptions(['fontDir' => storage_path('fonts/Open_sans')]);
			return @\PDF::loadHTML($html, 'utf-8')->stream();
			// return view('frontend.receipt_detail', compact('orderDetails','base64','style','style2', 'domain_pricings', 'plans'));
		} else {
		}
	}
	public function downloadExcel(Request $request, $type)
	{


		try {
			// run your code here
			// Excel::create('Filename', function($excel) {

			//     $excel->sheet('Sheetname', function($sheet) {

			//         $sheet->fromArray(array(
			//             array('data1', 'data2'),
			//             array('data3', 'data4')
			//         ));

			//     });

			// })->export('xls');
			$data = Article::get()->toArray();
			//dd($data);
			return Excel::create('example', function ($excel) use ($data) {

				$excel->sheet('mySheet', function ($sheet) use ($data) {

					$sheet->fromArray($data);
				});
			})->download($type);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function receiptDetailsf($id)
	{

		$today = Carbon::today()->format('Y-m-d');
		$orderDetails 	 = Order::with(['user.client.country', 'orderItems'])->where(['user_id' => Auth::id(), 'id' => $id])->first();
		$domain_pricings = DomainPricing::where('type', 'addons')->where('status', '1')->get();
		ob_end_clean();
		ob_start();
		\Excel::create("Report", function ($excel) use ($FileViewdata) {

			$excel->setTitle('Invoice Receipt');
			$excel->setDescription('Details of invoice');

			$excel->sheet("page 1", function ($sheet) {
				$sheet->loadView("frontend.receipt_detail", array('orderDetails', 'domain_pricings'));
			});
		})->store('xls', storage_path('exports')); // ->export('xls');


		$report_excelFilepath = storage_path('exports') . "/Report.xls";


		return response()->download($report_excelFilepath, "Report.xls", [
			'Content-Type' => 'application/vnd.ms-excel',
			'Content-Disposition' => "attachment; filename='Report.xls'"
		]);
	}
	public function pdf()
	{
		header('Content-type: application/pdf');
		header('Content-Disposition: inline; filename="document.pdf"');
		header('Content-Transfer-Encoding: binary');
		$data['title'] = "Invoice List";
		//    $html = view('pdf.invoice', $data)->render();
		// return @\PDF::loadHTML($html, 'utf-8')->stream(); 
		$html =
			'<html><body>' .
			'<style>table {
		width: 100%;
		border-collapse: collapse;
		border-spacing: 0;
		margin-bottom: 20px;
		}

		table tr:nth-child(2n-1) td {
		background: #F5F5F5;
		}
		table th,
		table td {
		text-align: center;
		}
		table th {
		padding: 5px 20px;
		color: #5D6975;
		border-bottom: 1px solid #C1CED9;
		white-space: nowrap;        
		font-weight: normal;
		}
		table .service,
		table .desc {
		text-align: left;
		}
		table td {
		padding: 20px;
		text-align: right;
		}
		table td.service,
		table td.desc {
		vertical-align: top;
		}
		table td.unit,
		table td.qty,
		table td.total {
		font-size: 1.2em;
		}
		table td.grand {
		border-top: 1px solid #5D6975;;
		}
		</style>' . '<table>
		 <thead>
		    <tr>
		       <th>Id</th>
		       <th>Title</th>
		       <th>Description</th>
		       <th>Created at</th>
		    </tr>
		 </thead>
		 <tbody>
		    <tr>
		       <td>1</td>
		       <td>this is for test</td>
		       <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		       tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		       quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		       consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		       cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		       proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</td>
		       <td>' . date('d m Y') . '</td>
		    </tr>
		 </tbody>
		</table>' .
			'</body></html>';
		//    $html = view('pdf.invoice', $data)->render();

		return @\PDF::loadHTML($html, 'utf-8')->stream();
		//    $pdf = PDF::loadView('pdf.invoice', $data);
		// return $pdf->download('invoice.pdf');

	}

	public function billing_my_invoices()
	{
		if (!empty($_GET['search'])) {
			if (strstr($_GET['search'], 'MY')) {
				$searchString = explode('-', $_GET['search']);
				$searchString = $searchString[1];
			} else {
				$datetime = strtotime($_GET['search']);
				if (checkdate(date('m', $datetime), date('d', $datetime), date('Y', $datetime)))
					$searchString = date('Y-m-d', $datetime);
				else
					$searchString = $_GET['search'];
			}
			$orderBy = isset($_GET['orderBy']) ? $_GET['orderBy'] : 'updated_at';
			$order   = isset($_GET['order']) ? $_GET['order'] : 'asc';
			$orders  = Order::where('user_id', Auth::id())->where('transaction_id', 'like', '%' . $searchString . '%')
				->orWhere('created_at', 'like', '%' . $searchString . '%')
				->orWhere('due_date', 'like', '%' . $searchString . '%')
				->orderBy($orderBy, $order)
				->paginate(30);
		} else {
			$orders = Order::where('user_id', Auth::id())->OrderBy('created_at', 'Desc')->paginate(10);
		}
		$counts = array();
		foreach ($orders as $key => $value) {
			if ($value->status === 'COMPLETED') {
				$counts[$key] = ['status' => 'Active'];
				$value->status = 'PAID';
			} else if ($value->status === 'INCOMPLETE' || $value->status === 'FAILED') {
				$counts[$key] = ['status' => 'Pending'];
				$value->status = 'UNPAID';
			} else {
				$counts[$key] = ['status' => 'Expired'];
				$value->status = 'Expired';
			}
		}
		$totalOrders             = Order::where('user_id', Auth::id())->OrderBy('created_at', 'Desc')->count();
		$totalPaidOrders         = Order::where(['user_id' => Auth::id(), 'status' => 'COMPLETED'])->count();
		$totalUnpaidOrders       = Order::where(['user_id' => Auth::id(), 'status' => 'INCOMPLETE'])->count();
		$totalFailedOrders       = Order::where(['user_id' => Auth::id(), 'status' => 'FAILED'])->count();
		$totalUnpaidOrdersAmount = Order::where(['user_id' => Auth::id(), 'status' => 'INCOMPLETE'])->sum('orders.total_amount');
		return view('frontend.billing_my_invoices', compact('totalUnpaidOrdersAmount', 'orders', 'totalPendingOrders', 'totalOrders', 'totalPaidOrders', 'totalUnpaidOrders', 'totalFailedOrders', 'counts'));
	}

	public function billing_mass_payment()
	{
		if (!empty($_GET['search'])) {
			if (strstr($_GET['search'], 'MY')) {
				$searchString = explode('-', $_GET['search']);
				$searchString = $searchString[1];
			} else {
				$datetime = strtotime($_GET['search']);
				if (checkdate(date('m', $datetime), date('d', $datetime), date('Y', $datetime)))
					$searchString = date('Y-m-d', $datetime);
				else
					$searchString = $_GET['search'];
			}
			$orderBy = isset($_GET['orderBy']) ? $_GET['orderBy'] : 'updated_at';
			$order   = isset($_GET['order']) ? $_GET['order'] : 'asc';
			$orders  = Order::where(['user_id', Auth::id(), 'status' => 'INCOMPLETE'])->where('transaction_id', 'like', '%' . $searchString . '%')
				->orWhere('created_at', 'like', '%' . $searchString . '%')
				->orWhere('due_date', 'like', '%' . $searchString . '%')
				->orderBy($orderBy, $order)
				->paginate(10);
		} else {
			$orders = Order::where(['user_id' => Auth::id(), 'status' => 'INCOMPLETE'])->OrderBy('created_at', 'Desc')->paginate(10);
		}
		$counts = array();
		foreach ($orders as $key => $value) {
			if ($value->status === 'COMPLETED') {
				$counts[$key] = ['status' => 'Active'];
				$value->status = 'PAID';
			} else if ($value->status === 'INCOMPLETE' || $value->status === 'FAILED') {
				$counts[$key] = ['status' => 'Pending'];
				$value->status = 'UNPAID';
			} else {
				$counts[$key] = ['status' => 'Expired'];
				$value->status = 'Expired';
			}
		}
		$totalUnpaidOrders   = Order::where(['user_id' => Auth::id(), 'status' => 'INCOMPLETE'])->count();
		$totalUnpaidOrdersAmount   = Order::where(['user_id' => Auth::id(), 'status' => 'INCOMPLETE'])->sum('orders.total_amount');
		return view('frontend.billing_mass_payment', compact('totalUnpaidOrdersAmount', 'orders', 'counts', 'totalUnpaidOrders'));
	}

	public function payment_done(Request $request)
	{

		if (!empty($request->field)) {
			// print_r($request->field);exit;
			foreach ($request->field as $value) {
				if ($value['name'] == 'order_ids') {
					$order_ids = $value['value'];
				}
			}
			$order_ids = explode(',', $order_ids);
			foreach ($order_ids as $value) {
				$modelOrder = Order::where(['id' => $value])->first();
				if (isset($modelOrder)) {
					$modelOrder->payment_method_id = 7;
					$modelOrder->status            = 'COMPLETED';
					$modelOrder->payment_date      = date('Y-m-d');
					$modelOrder->object            = serialize($request->detail);
					$modelOrder->save();
				}
			}
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

	public function payment_done_other(Request $request)
	{

		if (!empty($request->field)) {
			// print_r($request->field);exit;
			foreach ($request->field as $value) {
				if ($value['name'] == 'order_ids') {
					$order_ids = $value['value'];
				}

				if ($value['name'] == 'paid_by') {
					$paid_by = $value['value'];
				}
			}
			$order_ids = explode(',', $order_ids);
			foreach ($order_ids as $value) {
				$modelOrder = Order::where(['id' => $value])->first();
				if (isset($modelOrder)) {
					$modelOrder->payment_method_id = $paid_by;
					$modelOrder->payment_date      = date('Y-m-d');
					$modelOrder->save();
				}
			}
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
}
