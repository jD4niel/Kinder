<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Colony extends Model
{
    protected $fillable = [
        'post_code',
        'colony',
        'municipality'
    ];

    public function address(){
        return $this->hasOne('App\Address');
    }
}
