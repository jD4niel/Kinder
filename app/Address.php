<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'postal_code',
        'street',
        'colony',
        'municipality',
        'state'
    ];
    public function tutor()
    {
        return $this->hasOne('App\Tutor');
    }
}
