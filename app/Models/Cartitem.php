<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
class cartitem extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cartitems';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['domain_name', 'qty', 'user_id', 'price', 'addons'];


    public function user(){
        return $this->belongsTo(User::class);
    }

  public static function addItem($user_id, $form_data)
  {
    $domain_item = new self();

    if (!empty($user_id))
    {
      $domain_item->user_id  = $user_id;
    }

    $domain_item->services = $form_data['domain'];
    $domain_item->cycle    = $form_data['cycle'];
    $domain_item->qty      = 1;
    $domain_item->price    = $form_data['price'];
    if (!empty($form_data['type'])){
      $domain_item->type     = $form_data['type'];
    }
    if (!empty($form_data['plan_id'])){
      $domain_item->plan_id     = $form_data['plan_id'];
    }
    if (!empty($form_data['addons']))
    {
      $domain_item->addons = implode(',', $form_data['addons']);
    }

    if (!$domain_item->save())
    {
      return False;
    }

    return True;
  }

  public static function update_cart_item(){
      $cookie = isset($_COOKIE['cart_items_cookie2']) ? $_COOKIE['cart_items_cookie2'] : "";
      $cookie = stripslashes($cookie);
      $saved_cart_items = json_decode($cookie, true);
      // dd($saved_cart_items);
      $cartitems      = array();
      if(Auth::id()){
      if($cookie != ""){
        if(count($saved_cart_items) > 0){
          $i = 0;
          foreach ($saved_cart_items as $key => $value) {
            $cartitems[$i]['user_id'] = Auth::id();
            $cartitems[$i]['services'] = $key;
            $cartitems[$i]['cycle'] = $value['cycle'];
            $cartitems[$i]['qty'] = $value['qty'];
            $cartitems[$i]['plan_id']   = $value['plan_id'];
            $cartitems[$i]['type']    = $value['type'];
            $cartitems[$i]['price'] = $value['price'];
            if(isset($value['addons']))
            $cartitems[$i]['addons'] = $value['addons'];
            $i++;

          }
          Cartitem::insert($cartitems);
          $saved_cart_items = array();
          $json = json_encode($saved_cart_items, true);
            setcookie("cart_items_cookie2", $json, time() + (86400 * 30), '/'); // 86400 = 1 day
            $_COOKIE['cart_items_cookie2']=$json;
        }
      }
      return true;      
    }
  }
}
