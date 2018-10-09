<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Credentials extends Model
{
    protected $fillable = [
        'expiration_date',
        'QR_code'
    ];
    public function student()
    {
        return $this->belongsTo('App\Student');
    }
}
