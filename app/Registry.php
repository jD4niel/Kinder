<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registry extends Model
{
    protected $fillable =[
        'QR_code',
        'student_id',
        'vigilante',
        'tutor'
    ];

    public function tutor()
    {
        return $this->hasMany('App\User');
    }
    public function vigilant()
    {
        return $this->hasMany('App\Vigilant');
    }
    public function student()
    {
        return $this->hasMany('App\Student');
    }
}
