<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'last_name',
        'second_last_name',
        'phone_number',
        'email',
        'role_id',
        'address_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    /*relaciones*/
    public function role()
    {
        return $this->belongsTo('App\Role');
    }
   /* public function registry()
    {
        return $this->belongsTo('App\Registry');
    }*/
    public function student(){
        return $this->hasMany('App\Student');
    }
}
