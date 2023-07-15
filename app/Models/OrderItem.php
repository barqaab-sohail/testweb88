<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model {

    /**
     * Generated
     */

    protected $table = 'order_items';
    protected $fillable = ['id', 'user_id', 'order_id', 'services', 'cycle', 'qty', 'price', 'addons'];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function order(){
        return $this->belongsTo('App\Models\Order');
    }
    public function plan(){
        return $this->belongsTo('App\Models\Plan');
    }
    public static function getItems(){

     $records = DB::table('order_items')->select('order_id','services','cycle','qty', 'price')->orderBy('id', 'asc')->get()->toArray();

     return $records;
   }


}
