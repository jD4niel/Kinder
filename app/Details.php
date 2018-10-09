<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Details extends Model
{
    protected $fillable = [
        'details'
    ];
    public function details()
    {
        return $this->belongsTo('App\Details');
    }
}
