<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
  public static function getCityListArray($state_id = NULL, $default = [])
  {
    $return_array = $default;

    if (!empty($state_id))
    {
      $cities = self::where('state_id', $state_id)->orderBy('name', 'ASC')->get();
    }
    else {
      $cities = self::orderBy('name', 'ASC')->get();
    }

    if (!empty($cities))
    {
      foreach ($cities as $city)
      {
        $return_array[$city->id] = $city->name;
      }
    }

    return $return_array;
  }
}
