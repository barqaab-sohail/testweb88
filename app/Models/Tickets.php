<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Tickets extends Model
{
	public $timestamps = false;
	protected $table = 'tickets';
    protected $fillable = [
        'status',
        'client_id',
        'ticket_id',
        'user_id',
        'department',
        'relative_services',
        'priority',
        'domain',
        'subject',
        'created_date',
        'updated_date'
    ];

}
