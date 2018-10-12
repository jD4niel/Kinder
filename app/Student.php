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
        'expedient_id',
        'degree',
        'group',
    ];

    public function registry()
    {
        return $this->belongsTo('App\Registry');
    }
    public function user()
    {
        return $this->hasMany('App\User');
    }
    public function expedient()
    {
        return $this->belongsTo('App\Expedient');
    }
    public function credentials()
    {
        return $this->belongsTo('App\Credentials');
    }

}
