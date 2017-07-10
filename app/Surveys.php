<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Surveys extends Model
{
    /**
    * The database table used by the model.
    *
    * @var string
    */
    protected $table = 'surveys';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];
}
