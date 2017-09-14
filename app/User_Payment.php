<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Payment extends Model
{
   	/**
    * The database table used by the model.
    *
    * @var string
    */
    protected $table = 'user_payment';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'payment_id'];
}
