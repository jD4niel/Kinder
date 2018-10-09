<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vigilant extends Model
{
    protected $fillable =[
        'name',
        'last_name',
        'second_last_name'
    ];
    public function registry()
    {
        return $this->belongsTo('App\Registry');
    }
}
