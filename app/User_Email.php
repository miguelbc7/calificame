<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Email extends Model
{
   	/**
    * The database table used by the model.
    *
    * @var string
    */
    protected $table = 'user_email';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'email_id'];
}
