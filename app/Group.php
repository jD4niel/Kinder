<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable =[
        'group',
        'degree'
        ];
    public function student()
    {
        return $this->belongsTo('App\Student');
    }
}
