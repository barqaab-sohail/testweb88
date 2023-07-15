<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class cartitem extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cartitems';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['domain_name', 'qty', 'user_id', 'price', 'addons'];


    public function user(){
        return $this->belongsTo(User::class);
    }
    
}
