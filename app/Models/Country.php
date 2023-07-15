<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
  public static function getCountryListArray($default = [])
  {
    $return_array = $default;

    $countries = self::all();

    foreach ($countries as $country)
    {
      $return_array[$country->id] = $country->name;
    }

    return $return_array;
  }
}
