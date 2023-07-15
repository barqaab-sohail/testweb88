<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Ticket_thread extends Model
{
	public $timestamps = false;
	protected $table = 'ticket_thread';
    protected $fillable = [
        'ticket_id',
        'user_id',
        'msg',
        'thumbnail',
        'replied_by',
        'created_date',
    ];

}
