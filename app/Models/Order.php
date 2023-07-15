<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use App\Models\Promotion;
class Order extends Model
{
  use SoftDeletes;

  protected $fillable = [
    'user_id',
    'transaction_id',
    'payer_id',
    'total_amount',
    'status',
    'object'
  ];

  public function user()
  {
    return $this->belongsTo('App\Models\User');
  }

  public function payment_method()
  {
    return $this->belongsTo('App\Models\PaymentMethod');
  }

  function getLastUpdated($withDeleted = False)
  {
    if ($withDeleted)
    {
      $last_updated_item = self::withTrashed()
                               ->orderBy('updated_at', 'desc')
                               ->first();
    }
    else
    {
      $last_updated_item = self::orderBy('updated_at', 'desc')->first();
    }

    if ($last_updated_item) {
      return $last_updated_item->updated_at;
    }

    return False;
  }
  public static function updateOrderInfo($order_id, $order_data, $user_id){
    $order = self::find($order_id);

    if (empty($order))
    {
      return False;
    }

    $order->transaction_id    = $order_data['order-txn-id'];
    $order->due_date          = date('Y-m-d H:i:s', strtotime($order_data['order-due-date']));
    $order->payment_date      = date('Y-m-d H:i:s', strtotime($order_data['order-payment-date']));
    $order->payment_method_id = $order_data['order-payment-method'];

    $order->user_id = $user_id;

    if (intval($order_data['order-payment-method']) === 4)
    {
      $order->cheque_number = $order_data['order-cheque-num'];
    }

    if (!$order->save())
    {
      return False;
    }

    return True;
  }
  public static function AddInfo($order_data)
  {
    $order = new self();
    $order->transaction_id    = $order_data['order-txn-id'];
    $order->due_date          = date('Y-m-d H:i:s', strtotime($order_data['invoice-due-date']));
    $order->payment_date      = date('Y-m-d H:i:s', strtotime($order_data['invoice-payment-date']));
    $order->payment_method_id = $order_data['invoice-payment-method'];
    $order->type = 1;
    $order->user_id = $order_data['user-client-target'];
    $order->payer_id = str_random(13);
    $order->total_amount = 0.00;
    $order->status = $order_data['status'];

    if (intval($order_data['invoice-payment-method']) === 4)
    {
      $order->cheque_number = $order_data['order-cheque-num'];
    }

    if (!$order->save())
    {
      return False;
    }

    return $order->id;
  }
  public static function updateOrderStatus($order_id, $status) {
    $order = self::find($order_id);

    if(empty($order))
    {
      return False;
    }

    $order->status = $status;

    if (!$order->save())
    {
      return False;
    }

    return True;
  }
  public static function updateOrderprice($orderid){
    $order = self::find($orderid);
    /*
    if(empty($order))
    {
      return False;
    }
    $orderItems = OrderItem::where('order_id', $order->id)->get();
    $domainPricing = DomainPricing::where('type', 'addons')->where('status','1')->get();

    $row_price = 0.00;
    $discount = 0.00;
    $setup_fee = 0.00;
    foreach($orderItems as $k => $v){
      $row_price += $v->price;

      if(isset($v->addons) && $v->addons != "" && $v->addons != null){
        $addons_vl = explode(',', $v->addons);    
        foreach($addons_vl as $addon){
          foreach($domainPricing as $dprice){
          
          if($addon == $dprice->id){ 
              $row_price += $dprice->price;
            }
          }
        }
      }
      if(!empty($v->ssl_price) && $v->ssl_price != '0.00'){ 
        $ssl_vl = explode('-', $v->ssl_price);
        $row_price += $ssl_vl[1];
      }
      if($v->plan_id != "" && $v->plan_id != null && $v->plan_id != 0){
        $discount = Promotion::get_discount($v->plan_id);
        if($discount != NULL){
         $discount = json_decode(json_encode($discount));
        
        if($discount->discount_by == 'amount'){
          $discount = $discount->discount;
        }else{
          $discount = ( $v->price * $discount->discount / 100);
        }
       }else{
        $discount = 0.00;
       }
      }else{
        $discount = 0.00;
        $row_price += $v->setup_fee;
      }
      // echo '<pre>';print($discount);
      $row_price -= $discount;
    }
    */
    // return $row_price;
    return $order->total_amount;
  }

  public function orderItems() {
    return $this->hasMany('App\Models\OrderItem');
  }
  
}
