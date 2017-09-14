<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Waiters extends Model
{
   	/**
    * The database table used by the model.
    *
    * @var string
    */
    protected $table = 'waiters';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'lastname', 'url'];

    public function getFullNameAttribute()
    {
        return $this->name. " " .$this->lastname;
    }
}
