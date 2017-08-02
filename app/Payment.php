<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    /**
    * The database table used by the model.
    *
    * @var string
    */
    protected $table = 'Payments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['dateIn', 'dateOut', 'amount', 'type', 'user_id'];
}
