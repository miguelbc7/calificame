<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\EntrustRole;

class Roles extends EntrustRole
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    public function roles_users(){
      return $this->hasOne('App\Roles_Users');
    }
    public function user(){
      return $this->belongsTO('App\User');
    }
}
