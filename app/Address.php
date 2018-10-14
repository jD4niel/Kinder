<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'num_ext',
        'street'
    ];
    public function tutor()
    {
        return $this->hasOne('App\User');
    }
    public function colonies(){
        return $this->belongsTo('App\Colony');
    }
}
