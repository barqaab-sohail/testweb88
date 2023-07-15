<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Order extends Model
{
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

    function getLastUpdated() {
      $last_updated_item = self::orderBy('updated_at', 'desc')->first();

      if ($last_updated_item) {
        return $last_updated_item->updated_at;
      }

      return False;
    }
}
