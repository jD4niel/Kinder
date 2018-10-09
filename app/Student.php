<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable =[
        'name',
        'last_name',
        'second_last_name',
        'credential_id',
        'group_id',
        'expedient_id'
    ];

    public function registry()
    {
        return $this->belongsTo('App\Registry');
    }
    public function group()
    {
        return $this->hasMany('App\Group');
    }
    public function expedient()
    {
        return $this->hasOne('App\Expedient');
    }
    public function credentials()
    {
        return $this->hasOne('App\Credentials');
    }
}
