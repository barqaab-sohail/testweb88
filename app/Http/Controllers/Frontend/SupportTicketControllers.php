<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tickets;
use App\Models\Ticket_thread;
use DB;
use Auth;
use Session;

class SupportTicketControllers extends Controller
{
	public function __construct()
    {
        $this->middleware('auth', []);
        $this->view_loction = 'frontend.support_tickets.';
    }
    
    public function index()
    {
		$search = isset($_GET['search']) ? $_GET['search'] : '';
		$orderBy = isset($_GET['orderBy']) ? $_GET['orderBy'] : 'updated_date';
		$order = isset($_GET['order']) ? $_GET['order'] : 'desc';
		$user = Auth::user();
		$user_id = $user->id;

		if($search!='')
		{
			$data = Tickets::where('user_id', $user_id)->where('ticket_id', 'like', '%'.$search.'%')
			->orWhere('subject', 'like', '%'.$search.'%')
			->orderBy($orderBy, $order)
			->paginate(10);
		}else{
			$data = Tickets::where('user_id', $user_id)->orderBy($orderBy, $order)->paginate(10);
		}
		$all_tickets = Tickets::where('user_id', $user_id)->get();
		return view($this->view_loction.'ticket_listing', ['data' => $data, 'all_tickets' => $all_tickets]);
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
		$user_id = $user->id;
		$client_id = $user->client->client_id;
		$department = $request->get('department');
		$related_service = $request->get('related_service');
		$priority = $request->get('priority');
		$domain = $request->get('domain');
		$subject = $request->get('subject');
		$message = $request->get('message');
		$updated_date = $created_date = date('Y-m-d H:i:s');
		
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
			//echo"<pre>";print_r($image_attachments);die;
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
				'user_id' => $user_id,
				'msg' => $message,
				'thumbnail' => json_encode($img_arr),
				'replied_by' => '0',
				'created_date' => $created_date
			]);
			$data = Tickets::where(['ticket_id'=> $ticket_id, 'user_id'=> $user_id])->select('id')->first();
			Session::flash('success', 'The information has been saved successfully.');
			return redirect('support_tickets/success?id='.base64_encode($data->id.'-'.$ticket_id));
			
		}else{
			die('Not logged in!');
		}
		
	}
	
	public function reply_store(Request $request){
		$user = Auth::user();
		$user_id = $user->id;
		$client_id = $user->client->client_id;
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
				'user_id' => $user_id,
				'msg' => $message,
				'thumbnail' => json_encode($img_arr),
				'replied_by' => '0',
				'created_date' => $created_date
			]);
			Tickets::where('id', $p_id)->update(array('status' => 'Client-Reply', 'updated_date' => $updated_date));
			Session::flash('success', 'The information has been saved successfully.');
			return redirect('support_tickets');
			
		}else{
			die('Not logged in!');
		}
		
	}
	
	public function reply(){
		$id = $_GET['id'];
		$user = Auth::user();
		$ticket = Tickets::find($id);
		if(isset($ticket) && !empty($ticket)){
			$thread = Ticket_thread::where('ticket_id', $ticket->ticket_id)->orderBy('id', 'desc')->get();
			$user_id = $user->id;
			$all_tickets = Tickets::where('user_id', $user_id)->get();
			return view($this->view_loction.'reply', ['threads' => $thread, 'ticket' => $ticket, 'user' => $user, 'all_tickets' => $all_tickets]);
		}else{
			return redirect('support_tickets');
		}
	}
	
	public function close_this(){
		$id = $_GET['id'];
		$updated_date = date('Y-m-d H:i:s');
		Tickets::where('id', $id)->update(array('status' => 'Closed', 'updated_date' => $updated_date));
		return redirect('support_tickets');
	}
	
	public function success(){
		$user = Auth::user();
		$user_id = $user->id;
		$all_tickets = Tickets::where('user_id', $user_id)->get();
		return view($this->view_loction.'ticket_submit', ['all_tickets' => $all_tickets]);
	}
}
