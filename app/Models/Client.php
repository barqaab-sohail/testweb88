<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Country;

class Client extends Model
{
    protected $table = 'client_registration_info';
	protected $primaryKey = 'client_id';
	public $incrementing = false;

     public function user()
    {
        return $this->belongsTo("App\Models\User",'id');
    }
    public function city()
    {
        return $this->belongsTo("App\Models\City");
    }
    public function state()
    {
        return $this->belongsTo("App\Models\State");
    }

    public function country()
    {
        return $this->belongsTo("App\Models\Country");
    }
    public function get_notify()
    {
        # code...
    }

  public static function createNew($user_id, $form_data)
  {
    $client = new self();

    $client->user_id       = $user_id;
    $client->first_name    = $form_data['user-client-first-name'];
    $client->last_name     = $form_data['user-client-last-name'];
    $client->company       = $form_data['user-client-company'];
    $client->address1      = $form_data['user-client-address-1'];
    $client->address2      = $form_data['user-client-address-2'];
    $client->state_id      = $form_data['user-client-state'];
    $client->city_id       = $form_data['user-client-city'];
    $client->country_id    = $form_data['user-client-country'];
    $client->phone_number  = $form_data['user-client-phone-number'];
    $client->mobile_number = $form_data['user-client-mobile-number'];
    $client->news_letter   = 1;
    $client->status = 1;
    $client->postal_code   = $form_data['user-client-postal-code'];

    if ($form_data['user-client-account-type'] === 'business-account')
    {
      $client->account_type  = 'Business Account';
    }
    else
    {
      $client->account_type  = 'Individual Account';
    }

    $client->client_id = self::generateClientId($user_id, $form_data);

    $client->save();
  }
  
  public static function Updateclient($user_id, $form_data)
  {

    $client = self::where('user_id', $user_id)->first();
    
    if(empty($client)){
        return false;
    }
    
    $client->first_name    = $form_data['user-client-first-name'];
    $client->last_name     = $form_data['user-client-last-name'];
    $client->company       = $form_data['user-client-company'];
    $client->address1      = $form_data['user-client-address-1'];
    $client->address2      = $form_data['user-client-address-2'];
    $client->state_id      = $form_data['user-client-state'];
    $client->city_id       = $form_data['user-client-city'];
    $client->country_id    = $form_data['user-client-country'];
    $client->phone_number  = $form_data['user-client-phone-number'];
    $client->mobile_number = $form_data['user-client-mobile-number'];
    $client->news_letter   = 1;

    $client->postal_code   = $form_data['user-client-postal-code'];
    $client->account_type  = $form_data['user-client-account-type']; 
    $client->save();
    if (!$client->save())
    {
      return False;
    }

    return True;
  }

  private static function generateClientId($user_id, $form_data)
  {
    $country = Country::find($form_data['user-client-country']);

    $client_id = 'I';

    if ($form_data['user-client-account-type'] === 'business-account')
    {
      $client_id = 'B';
    }

    $client_id .= '-' . $user_id;

    if (!empty($country))
    {
      $client_id .= '-' . $country->sortname;
    }
    else
    {
      $client_id .= '-XX';
    }

    return $client_id;
  }
}
