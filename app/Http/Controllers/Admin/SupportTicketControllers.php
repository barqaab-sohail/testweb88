<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tickets;
use App\Models\askForQota;
use App\Models\Ticket_thread;
use App\Models\FreequoteEnquiry;
use DB;
use Auth;
use Session;

class SupportTicketControllers extends Controller
{
	public function __construct()
    {
        $this->middleware('auth', []);
        $this->view_loction = 'admin.support_tickets.';
    }
    
    public function index()
    {
		$search_ticket_id = isset($_GET['ticket_id']) ? $_GET['ticket_id'] : '';
		$search_subject = isset($_GET['subject']) ? $_GET['subject'] : '';
		$search_department = isset($_GET['department']) ? $_GET['department'] : '';
		$search_status = isset($_GET['status']) ? $_GET['status'] : '';
		$search_client_id = isset($_GET['client_id']) ? $_GET['client_id'] : '';
		$search_client_name = isset($_GET['client_name']) ? $_GET['client_name'] : '';
		$search_client_email = isset($_GET['client_email']) ? $_GET['client_email'] : '';
		
		$orderBy = isset($_GET['sortBy']) ? $_GET['sortBy'] : 'id';
		$order = isset($_GET['sort']) ? $_GET['sort'] : 'desc';
		$orderBy2 = isset($_GET['sortBy2']) ? $_GET['sortBy2'] : 'updated_at';
		$order2 = isset($_GET['sort2']) ? $_GET['sort2'] : 'desc';
		$orderBy3 = isset($_GET['sortBy3']) ? $_GET['sortBy3'] : 'updated_at';
		$order3 = isset($_GET['sort3']) ? $_GET['sort3'] : 'desc';
		
		$limit = isset($_GET['limit']) ? $_GET['limit'] : 100; 
		$limit2 = isset($_GET['limit2']) ? $_GET['limit2'] : 100; 
		$limit3 = isset($_GET['limit3']) ? $_GET['limit3'] : 100; 
		         
			$data = Tickets::join('client_registration_info as ci', function($join){
					$join->on('tickets.user_id', '=', 'ci.user_id');
				});
			if(!empty($search_ticket_id))	
				$data= $data->orWhere('ticket_id', 'like', '%'.$search_ticket_id.'%');
			if(!empty($search_subject))
				$data = $data->orWhere('subject', 'like', '%'.$search_subject.'%');
			if(!empty($search_department) && $search_department != 0)
				$data = $data->orWhere('department', 'like', '%'.$search_department.'%');
			if(!empty($search_status) && $search_status != '- Please select -')
				$data= $data->orWhere('tickets.status', 'like', '%'.$search_status.'%');
			if(!empty($search_client_id))
				$data = $data->orWhere('tickets.client_id', 'like', '%'.$search_client_id.'%');
			if(!empty($search_client_name))
				$data= $data->orWhere('first_name', 'like', '%'.$search_client_name.'%')->orWhere('last_name', 'like', '%'.$search_client_name.'%');
			if(!empty($search_client_email)){
				$data = $data->join('users as u', function($j){
					$j->on('ci.user_id', 'u.id');
					})->orWhere('email', 'like', '%'.$search_client_email.'%');
				}
			$data = $data->orderBy($orderBy, $order)
			->select('tickets.*','ci.first_name','ci.last_name','ci.client_id')
			->paginate($limit2);
			
			$data2 = FreequoteEnquiry::orderBy($orderBy2, $order2)->paginate($limit2);
			$data3 = askForQota::orderBy($orderBy3, $order3)->paginate($limit3);
		return view($this->view_loction.'ticket_listing', ['data' => $data, 'limit' => $limit, 'data2' => $data2, 'data3' => $data3, 'sort' => $order, 'sortBy' => $orderBy, 'sort2' => $order2, 'sortBy2' => $orderBy2, 'sort3' => $order3, 'sortBy3' => $orderBy3, 'limit' => $limit, 'limit2' => $limit2, 'limit3' => $limit3]);
	}
	
	public function create(){
		$user = Auth::user();
		if ($user) {
			if ($user->role == 'Admin') {
				return redirect('/web88/admin');
			} else {
				$user_id = $user->id;
				$all_tickets = Tickets::where('user_id', $user_id)->get();
				return view($this->view_loction.'new_ticket', ['user' => $user, 'all_tickets' => $all_tickets]);
			}
 
		} else {
			return redirect('/login');
		}
	}
	
	public function store(Request $request){
		$user = Auth::user();
		$client_id = $request->get('client_id');
		$user = DB::table('client_registration_info')->where('client_id', $client_id)->first();
		$user_id = $user->user_id;
		
		$department = $request->get('department');
		$related_service = $request->get('related_service');
		$priority = $request->get('priority');
		$domain = $request->get('domain');
		$subject = $request->get('subject');
		$message = $request->get('message');
		$updated_date = $created_date = date('Y-m-d H:i:s');
		$admin_user_id = Auth::user()->id;
		if(!empty($user_id))
		{
			$ticket_id = time();
			Tickets::insert([
				'client_id' => $client_id,
				'ticket_id' => $ticket_id,
				'user_id' => $user_id,
				'status' => 'Open',
				'department' => $department,
				'relative_services' => $related_service,
				'priority' => $priority,
				'domain' => $domain,
				'subject' => $subject,
				'created_date' => $created_date,
				'updated_date' => $updated_date
			]);
			$image_attachments = $request->attachment;

			$img_arr = [];
			if(!empty($image_attachments))
			{
				foreach($image_attachments as $key => $value){
						$nDate = ceil(time()/1000);
						$nme = $value->getClientOriginalName();
						$nm = explode(".", $nme);
						$rd = rand(100,1000);
						$image_name = $user_id.'_'.$rd.'_'.$nDate.'.'.end($nm);
						$value->move(base_path() . '/public_html/images/ticket_attachments/' , $image_name);
						array_push($img_arr, $image_name);
				}
			}
			Ticket_thread::insert([
				'ticket_id' => $ticket_id,
				'user_id' => $admin_user_id,
				'msg' => $message,
				'thumbnail' => json_encode($img_arr),
				'replied_by' => '1',
				'created_date' => $created_date
			]);
			$data = Tickets::where(['ticket_id'=> $ticket_id, 'user_id'=> $user_id])->select('id')->first();
			Session::flash('success', 'The information has been saved successfully.');
			return redirect('admin/success?id='.base64_encode($data->id.'-'.$ticket_id));
			
		}else{
			die('Not logged in!');
		}
		
	}
	
	public function reply_store(Request $request){
		
		$ordinal_user = Tickets::where('id', $request->get('update_id'))->first();
		//$user = Auth::user();
		$user_id = $ordinal_user->user_id;
		$client_id = $request->get('client_id');
		$message = $request->get('message');
		$updated_date = $created_date = date('Y-m-d H:i:s');
		
		if(!empty($user_id))
		{
			$p_id = $request->get('update_id');
			$tickets = Tickets::find($p_id);
			$image_attachments = $request->attachment;
			$img_arr = [];
			
			if(!empty($image_attachments))
			{
				foreach($image_attachments as $key => $value){
					
						$nDate = ceil(time()/1000);
						$nme = $value->getClientOriginalName();
						$nm = explode(".", $nme);
						$rd = rand(100,1000);
						$image_name = $user_id.'_'.$rd.'_'.$nDate.'.'.end($nm);
						$value->move(base_path() . '/public_html/images/ticket_attachments/' , $image_name);
						array_push($img_arr, $image_name);
				}
			}
			Ticket_thread::insert([
				'ticket_id' => $tickets->ticket_id,
				'user_id' => Auth::user()->id,
				'msg' => $message,
				'thumbnail' => json_encode($img_arr),
				'replied_by' => '1',
				'created_date' => $created_date
			]);
			Tickets::where('id', $p_id)->update(array('status' => $request->get('status'), 'updated_date' => $updated_date, 'department' => $request->get('department'),'relative_services' => $request->get('relative_services'),'domain' => $request->get('domain'),'priority' => $request->get('priority')));
			Session::flash('success', 'The information has been saved successfully.');
			return redirect('admin/support_tickets');
			
		}else{
			die('Not logged in!');
		}
		
	}
	
	public function reply(){
		$id = $_GET['id'];
		$ticket = Tickets::find($id);
		if(isset($ticket) && !empty($ticket)){
			$userData = DB::table('users')->where('id', $ticket->user_id)->first();
			$user_info = DB::table('client_registration_info')->where('user_id', $ticket->user_id)->first();
			$thread = Ticket_thread::where('ticket_id', $ticket->ticket_id)->orderBy('id', 'desc')->get();
			return view($this->view_loction.'reply', ['threads' => $thread, 'ticket' => $ticket, 'user' => $user_info, 'userData' => $userData, 'seu' => 'true']);
		}else{
			return redirect('admin/support_tickets')->with('seu', 'true');
		}
	}
	
	public function close_this(){
		$id = $_GET['id'];
		$updated_date = date('Y-m-d H:i:s');
		Tickets::where('id', $id)->update(array('status' => 'Closed', 'updated_date' => $updated_date));
		return redirect('support_tickets');
	}
	public function deleteThis(){
		$id = isset($_GET['id']) ? $_GET['id'] : 0 ;
		$ids = isset($_GET['deletall']) ? explode('-', $_GET['deletall']) : '';
		if(!empty($ids)){
			Tickets::whereIn('id', $ids)->delete();
		}else{
			Tickets::destroy($id);
		}
		return redirect('admin/support_tickets');
	}
	
	public function success(){
		$user = Auth::user();
		$user_id = $user->id;
		$all_tickets = Tickets::where('user_id', $user_id)->get();
		return view($this->view_loction.'ticket_submit', ['all_tickets' => $all_tickets]);
	}
	
	public function update_reply(Request $request){
		$thread_id = $request->get('id');
		$msg = $request->get('msg');
		DB::table('ticket_thread')->where('id', $thread_id)->update(array('msg' => $msg));
		return redirect('admin/support_tickets');
	}
	
	public function delete_reply(Request $request){
		$thread_id = $request->get('id');
		DB::table('ticket_thread')->where('id', $thread_id)->delete();
		return redirect('admin/support_tickets');
	}
	
	public function fetch_acct_type(Request $request){
		$search = $request->get('search_key');
		$data = DB::table('client_registration_info as i')
				->join('users as u', function($join){
					$join->on('i.user_id', '=', 'u.id');
					});
			if($search != 'all')
				$data = $data->where('account_type', $search);
				$data = $data->select('client_id', 'first_name', 'last_name', 'company', 'email')
				->get();
		echo json_encode($data);
	}
	
	public function dele_service(){
		$id=$_GET['id'];
		if(isset($_GET['type']) && $_GET['type'] == 2){
			askForQota::destroy($id);
		}else{
			FreequoteEnquiry::destroy($id);
		}
		return redirect('admin/support_tickets');
	}
	
	public function multi_delete(Request $request){
		$mode = $request->get('mode');
		$type = $request->get('type');
		$data = $request->get('data');
		if($mode == 1){
			if($type == 1)
				Tickets::whereIn('id', $data)->delete();
			if($type == 2)
				FreequoteEnquiry::whereIn('id', $data)->delete();
			if($type == 3)
				askForQota::whereIn('id', $data)->delete();
				echo json_encode(['success'=>true]);
		}else{
			if($type == 1)
				Tickets::query()->truncate();
			if($type == 2)
				FreequoteEnquiry::query()->truncate();
			if($type == 3)
				askForQota::query()->truncate();
				return redirect('admin/support_tickets');
		}
			
		
	}
}
