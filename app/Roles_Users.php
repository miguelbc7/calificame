<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roles_Users extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'role_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['role_id', 'user_id'];

    public $timestamps = false;

    public function user(){
      return $this->belongsTO('App\User');
    }
    public function role(){
      return $this->belongsTO('App\Roles');
    }
}
