<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Order;
use App\Models\User;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Client;
use App\Models\PaymentMethod;
use App\Models\Plan;
use App\Http\Requests\ArticleCreateRequest;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\ArticleUpdateRequest;
use App\Models\Category;
use App\Models\Promotion;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Session;
use DB;
use View;
use function foo\func;

class PromotionsController extends Controller {
	private $data = array();
	private $PromotionModel = null;
	private $CategoryModel = null;
		
	public function __construct()
	{
		$this->middleware('admin');
		$this->PromotionModel = new Promotion();
		$this->CategoryModel = new Category();
		$this->PlanModel = new Plan();
		
	}

	function listGlobalDiscounts()
	{
		$this->data['success'] = Session::get('response');
		Session::forget('response');
		
		
		// get global discounts
		$this->data['global_discounts'] = $this->PromotionModel->getGlobalDiscounts();
		
		// get pagination record status
		$this->data['pagination_report'] = $this->PromotionModel->getTotalProducts(Input::get('page'));
		
		// get category list
		$this->data['categories'] = $categories = $this->CategoryModel->getCategoriesTree();
		// dd($categories);
		// get last updated
		$this->data['plans'] = $this->PlanModel->getPlan();
		$this->data['last_modified'] = DB::table('global_discounts')->orderBy('last_modified','desc')->pluck('last_modified')->first();
		
		$this->data['page_title'] = 'Global Discounts:: Listing';

		

		$data = $this->data;
		
		// foreach($categories as $key => $vat){
  //       $categoryDetails = Category::where('id', $vat->id)->first();
  //       // echo 'Category Name: '.$categoryDetails->id;
  //       echo '<pre>';print_r($categoryDetails->toArray());
  //       if($categoryDetails->parent==0){
  //         $subCategories = Category::where(['parent'=>$categoryDetails->id])->get();
  //         $subCategories = json_decode(json_encode($subCategories));
  //         // echo '<pre>';print_r($subCategories);
  //         $cat_ids = [];
  //         foreach($subCategories as $subcat){
  //             $cat_ids[] = $subcat->id;
  //         }
  //         // $productsAll = "SELECT * FROM `plans` WHERE category IN ('.$cat_ids.') and status = 1 order by id desc";
  //         $productsAll = Plan::whereIn('category', $cat_ids)->where('status','1')->orderBy('id','desc')->get();
  //         $productsAll = json_decode(json_encode($productsAll));
  //      	  foreach($productsAll as $pro){
  //      	  	echo $pro->plan_name;
  //      	  }
       	  
  //       // echo '<pre>';print_r($productsAll);
  //       }
  //       else{
  //           $productsAll = Plan::where(['category'=>$categoryDetails->id])->where('status','1')->orderBy('id','Desc');
  //       }
              
  //       }                 
		return view('admin.promotions.global_discounts_list')->with(['data' => $data, 'page' => 'promotions']);
		
	}
	
	function addGlobalDiscount(Request $request)
	{
		if($request->isMethod('post'))
		{		
			$input = $request->all();	
			// dd($input);die;			
			$validator = Validator::make($input,[
							'discount_name' => 'required',
							'from_amount' => 'required',
							'to_amount' => 'required',
							'discount'	=> 'required'

						]											
					); 			        
	
		  if ($validator->fails()) {  
				$json['error'] = $validator->errors()->all(); 
				echo json_encode($json);
				exit;				
				
			}
			else
			{		
				
				$input['status'] = 0;	
				if ($request->has('status')) {
	                $input['status'] = 1;
	            }	
	            if ($request->discount_by == '%') {
	                $input['discount_by'] = 'percentage';
	            }else{
	            	$input['discount_by'] = 'amount';
	            }
	            
				$this->PromotionModel->addGlobalDiscount($input);
				Session::flash('success', 'Global discount added successfully.');
	            return response()->json([
	                'success'=> true,
	                'message' => 'Global discount created!.'
	            ],201);
			}			
		}	
	}
	
	function deleteGlobalDiscounts(Request $request)
	{		
		$return_data = ['delete_status' => False];
		$brands = $this->PromotionModel->deleteGlobalDiscounts($request->get('target_order'));
		Session::put('response', 'Item(s) deleted successfully.');	
		return redirect('admin/promotions/globalDiscounts')->with($return_data);
	}
	
	public function deleteSelected(Request $request)
    {
        $return_data = ['delete_status' => False];

        $deleted_orders = $this->PromotionModel->deleteGlobalDiscounts(Input::get('orders_checkbox'), $multiple = true);

        if ($deleted_orders) {
            $return_data['delete_status'] = True;
        }
		
        return redirect('admin/promotions/globalDiscounts')->with($return_data);
    }

	public function deleteAll(Request $request)
    {
        $return_data = ['delete_status' => False];

        if ($this->PromotionModel->deleteGlobalDiscountsAll()) {
            $return_data['delete_status'] = True;
        }

        return redirect('admin/promotions/globalDiscounts')->with($return_data);
    }
	
	function updateGlobalDiscount(Request $request)
	{
		if($request->isMethod('post'))
		{	
		$input = $request->all();						
			$validator = Validator::make($input,[
							'discount_name' => 'required',
							'from_amount' => 'required',
							'to_amount' => 'required',
							'discount'	=> 'required'

						]											
					); 			        
			        
	
		  if ($validator->fails()) {  
				$json['error'] = $validator->errors()->all(); 
				echo json_encode($json);
				exit;				
				
			}
			else
			{				
				$this->PromotionModel->updateGlobalDiscount($input);
				
				Session::put('response', 'Global discount updated successfully.');
				
				echo json_encode(array('success' => true));
			}			
		}	
	}
	// Add by aklima
	public function getDiscount($id){
		$data = $this->PromotionModel->getDiscountAmount($id);
		
		echo json_encode($data);
	}
}