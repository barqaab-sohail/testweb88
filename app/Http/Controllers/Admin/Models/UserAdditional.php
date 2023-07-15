<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class UserAdditional extends Model
{
    protected $fillable = [
        'user_id',
        'firstname',
        'lastname',
        'company',
        'name',
        'mobile',
        'address',
        'address2',
        'city',
        'state',
        'postalcode',
        'country_id',
        'phone'
    ];
    protected $table = "user_additional";
    
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
