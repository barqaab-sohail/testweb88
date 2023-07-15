<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    public function getUserClientIdAttribute() {
      $account_info = $this->id . '-' . $this->client->country->sortname;

      $account_prefix = 'I';

      if (strtolower($this->client->account_type) === 'business account')
      {
        $account_prefix = 'B';
      }

      return $account_prefix . '-' . $account_info;
    }

    public function getFullNameAttribute() {
      return $this->client->first_name . ' ' . $this->client->last_name;
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

     public function client()
    {
        return $this->hasOne("App\Models\Client",'user_id','id');
    }
    public function client_billing()
    {
        return $this->hasOne("App\Models\Client_billing_info",'user_id','id');
    }

    public function domains(){
        return $this->hasMany(domain::class);
    }
    public function orders(){
      return $this->hasMany(Order::class);
    }
    /*public function city()
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
    }*/
    public function get_notify()
    {
        # code...
    }

  public function getUserClientList($user_type = NULL) {
    $users = self::with('client.country')->where('role', '<>', 'Admin');

    if (!empty($user_type) && $user_type !== 'all')
    {
      $users->whereHas('client', function ($query) use ($user_type) {
        if ($user_type === 'business-account')
        {
          $query->where('account_type', 'Business Account');
        } else {
          $query->where('account_type', 'Individual Account');
        }
      });
    }

    $users = $users->get();

    $formatted = [];

    foreach ($users as $user) {
      $formatted[$user->id]['label'] = $user->user_client_id . ': ';
      $formatted[$user->id]['label'] .= $user->full_name . ' ';
      $formatted[$user->id]['label'] .= '(' . $user->client->company . ')';

      if ($user->client->account_type === 'Business Account') {
        $formatted[$user->id]['type'] = 'business-account';
      } else {
        $formatted[$user->id]['type'] = 'individual-account';
      }
    }

    return $formatted;
  }

  public static function createNew($form_data)
  {
    $user = new self();

    DB::beginTransaction();

    try
    {
      $user->email = $form_data['user-client-email'];
      $user->password = bcrypt(self::generateRandomString());
      $user->role = 'Client';
      $user->added_by_admin = 1;

      $user->save();

      Client::createNew($user->id, $form_data);

      DB::commit();

      return $user->id;
    } catch (\Exception $e)
    {
      dd($e);
      DB::rollback();
    }

    return False;
  }

  public static function generateRandomString($length = 32)
  {
    if (empty($length))
    {
      $length = 32;
    }

    $random_string = '';

    $alphabet  = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!%&@#$^*?_~';
    $char_list = str_split($alphabet);
    $list_size = sizeOf($char_list);

    for($char_index = 0; $char_index < $list_size; $char_index++)
    {
      $random_string .= $char_list[$char_index];
    }

    return $random_string;
  }
}
