<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    /**
    * The database table used by the model.
    *
    * @var string
    */
    protected $table = 'questions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['question'];
}
