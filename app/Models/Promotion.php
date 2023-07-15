<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;

class Promotion extends Model{
	protected $table = 'global_discounts';
	
	public static function addGlobalDiscount($formData)
	{
		unset($formData['_token']);
		
		if(isset($formData['category_id']))
		{
			$category_id = $formData['category_id'];
			unset($formData['category_id']);
		}
		
		$product_ids = '';
		if(isset($formData['product_id']))
		{
			$product_ids = $formData['product_id'];
			unset($formData['product_id']);
		}
		
		$formData['status'] = (isset($formData['status'])) ? '1' : '0';
		$formData['last_modified'] = date('Y-m-d H:i:s');
		
		// add global discount

		DB::table('global_discounts')->insert($formData);
		$global_discount_id = DB::getPdo()->lastInsertId();
		
		// add global_discounts_to_category
		if($category_id)
		{
			$insert_data['global_discount_id'] = $global_discount_id;
			$insert_data['category_id'] = $category_id;
			
			DB::table('global_discounts_to_category')->insert($insert_data);	
		}
		
		// add global_discounts_to_products
		if($product_ids)
		{
			$insert_product['global_discount_id'] = $global_discount_id;
			
			foreach($product_ids as $product_id)
			{
				$insert_product['product_id'] = $product_id;
				DB::table('global_discounts_to_products')->insert($insert_product);
			}
		}		
		
	}
	
	// get all records
	function getGlobalDiscounts()
	{
		$per_page = (Session::has('global_discounts.per_page')) ? Session::get('global_discounts.per_page') : 30;
		return DB::table('global_discounts')->paginate($per_page);	
	}
	// Get discount amount by aklima
	public static function getDiscountAmount($id){
		$data = DB::table('global_discounts')->select('discount', 'discount_by')->where('id', $id)->first();
		return $data;
	}
	
	// get record for pagination report
	function getTotalProducts($current_page)
	{
		$current_page = ($current_page) ? $current_page : 1;
		$per_page = (Session::has('global_discounts.per_page')) ? Session::get('global_discounts.per_page') : 30;
		$total_records = DB::table('global_discounts')->count();
		
		$page_to = (($current_page * $per_page) > $total_records) ? $total_records : ($current_page * $per_page);
		
		$msg = 'Showing '. ((($current_page-1) * $per_page) + 1) .' to '. $page_to .' of '. $total_records .' entries';
		
		//return array('total_records' => $total_records, 'current_page' => $current_page, 'per_page' => $per_page, 'message' => $msg);
		return $msg;
	}
	
	function deleteGlobalDiscounts($item_id, $multiple = false)
	{
		if(!$multiple){
			$item_id = explode(',', $item_id);
		}
		// delete global_discounts
		DB::table('global_discounts')->whereIn('id', $item_id)->delete();
		
		// delete global_discounts_to_category
		DB::table('global_discounts_to_category')->whereIn('global_discount_id', $item_id)->delete();
		
		// delete global_discounts_to_products
		DB::table('global_discounts_to_products')->whereIn('global_discount_id', $item_id)->delete();			
	}

	function deleteGlobalDiscountsAll()
	{
		// delete global_discounts
		DB::table('global_discounts')->delete();
		
		// delete global_discounts_to_category
		DB::table('global_discounts_to_category')->delete();
		
		// delete global_discounts_to_products
		DB::table('global_discounts_to_products')->delete();			
	}
	
	function updateGlobalDiscount($formData)
	{
		unset($formData['_token']);
		
		if(isset($formData['category_id']))
		{
			$category_id = $formData['category_id'];
			unset($formData['category_id']);
		}
		
		$product_ids = '';
		if(isset($formData['product_id']))
		{
			$product_ids = $formData['product_id'];
			unset($formData['product_id']);
		}
		
		$global_discount_id = $formData['global_discount_id'];
		unset($formData['global_discount_id']);
		
		$formData['status'] = (isset($formData['status'])) ? '1' : '0';
		
		// update global discount
		$formData['from_amount'] = str_replace(',','',$formData['from_amount']);
		$formData['to_amount'] = str_replace(',','',$formData['to_amount']);
		$formData['discount'] = str_replace(',','',$formData['discount']);
		$formData['last_modified'] = date('Y-m-d H:i:s');
		
		DB::table('global_discounts')->where('id',$global_discount_id)->update($formData);
				
		// delete category
		DB::table('global_discounts_to_category')->whereIn('global_discount_id',array('0' => $global_discount_id))->delete();
		
		// add global_discounts_to_category
		if($category_id)
		{
			$insert_data['global_discount_id'] = $global_discount_id;
			$insert_data['category_id'] = $category_id;
			
			DB::table('global_discounts_to_category')->insert($insert_data);	
		}
		
		// delete global_discounts_to_products
		DB::table('global_discounts_to_products')->whereIn('global_discount_id',array('0' => $global_discount_id))->delete();
		
		// add global_discounts_to_products
		if($product_ids)
		{
			$insert_product['global_discount_id'] = $global_discount_id;
			
			foreach($product_ids as $product_id)
			{
				$insert_product['product_id'] = $product_id;
				DB::table('global_discounts_to_products')->insert($insert_product);
			}
		}	
	}
	public static function get_discount($product_id){

		$category_id = Plan::select('category')->where('id', $product_id)->first();
		
		$category_id = $category_id->category;

		$discount = DB::table('global_discounts')
			    ->select('global_discounts.*')
			    ->join('global_discounts_to_products', function($join) use($product_id){
			        $join->on('global_discounts.id', '=', 'global_discounts_to_products.global_discount_id')
			            ->where('global_discounts_to_products.product_id', '=', $product_id);
			    })->first();
		

		    if(is_array($discount)?count($discount) > 0:false){
		    	return $discount;
		    }else{

			    $discount = DB::table('global_discounts')
		    ->select('global_discounts.*')
		    ->join('global_discounts_to_category', function($join) use($category_id)
		    {
		        $join->on('global_discounts.id', '=', 'global_discounts_to_category.global_discount_id')
		             ->where('global_discounts_to_category.category_id', '=', $category_id);
		    })->first();
		    return $discount;
		    }

	}
	
}