<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Waiter extends Model
{
   	/**
    * The database table used by the model.
    *
    * @var string
    */
    protected $table = 'user_waiters';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'waiter_id'];
}
