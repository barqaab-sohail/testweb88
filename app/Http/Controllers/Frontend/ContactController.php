<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\FreequoteEnquiry;
use App\Models\askForQota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Session;
use Storage;
use Validator;
use App\Mail\EnquiryMail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller {

	public function index() {
		return view('frontend.contact_us');  
	}

	public function ValidateForm($fields, $rules){
        $validator = Validator::make($fields, $rules)->validate();
    }
	public function contactEnquiry(Request $request,FreequoteEnquiry $enquiry, askForQota $askForQota){


        return redirect()->back()->with('success', 'IT WORKS!');


        $rules = [
            'name' => 'required',
            'email' => 'required',
            'service' => 'required',
            'company' => 'required',
            'phone' => 'required',
            'website' => 'required',
            'message' => 'required'
        ];
        $this->ValidateForm($request->all(), $rules);
		if($request->redirect == 'dedicated_server'){
			$askForQota->name  = $request->name;
			$askForQota->email  = $request->email;
			$askForQota->service = $request->service;
			$askForQota->company  = $request->company;
			$askForQota->phone  = $request->phone;
			$askForQota->website  = $request->website;
			$askForQota->message  = $request->message;
			$askForQota->save();
           /* return redirect()->to('/services/dedicated_servers')*/;
            return redirect()->back(); 
        }else{
			$enquiry->name  = $request->name;
			$enquiry->email  = $request->email;
			$enquiry->service = $request->service;
			$enquiry->company  = $request->company;
			$enquiry->phone  = $request->phone;
			$enquiry->website  = $request->website;
			$enquiry->message  = $request->message;
			$enquiryID = $enquiry->save();
			if($enquiryID) {
				$mail_data = [
					'name' => $enquiry->name,
					'email' => $enquiry->email,
					'service' => $enquiry->service,
					'company' => $enquiry->company,
					'phone' => $enquiry->phone,
					'website' => $enquiry->website,
					'message' => $enquiry->message,
				];
			}
		}
	}
}
