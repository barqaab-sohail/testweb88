<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
  public function orders()
  {
    return $this->hasMany('App\Models\Order');
  }

  public static function getPaymentMethodListArray($default = [])
  {
    $return_array = $default;

    $payment_methods = self::all();

    foreach ($payment_methods as $method)
    {
      $return_array[$method->id] = $method->name;
    }

    return $return_array;
  }
}
