<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
  public static function getStateListArray($country_id = NULL, $default = [])
  {
    $return_array = $default;

    if (!empty($country_id))
    {
      $states = self::where('country_id', $country_id)->get();
    }
    else
    {
      $states = self::all();
    }

    if (!empty($states))
    {
      foreach ($states as $state)
      {
        $return_array[$state->id] = $state->name;
      }
    }

    return $return_array;
  }
}
