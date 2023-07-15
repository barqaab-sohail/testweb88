<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class UserBilling extends Model
{
    protected $fillable = [
        'user_id',
        'address',
        'address2',
        'city',
        'state',
        'postalcode',
        'phone',
        'mobile'
    ];

    protected $table = "user_billing";
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
