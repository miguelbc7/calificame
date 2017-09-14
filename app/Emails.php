<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Emails extends Model
{
   	/**
    * The database table used by the model.
    *
    * @var string
    */
    protected $table = 'emails';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['email'];
}
