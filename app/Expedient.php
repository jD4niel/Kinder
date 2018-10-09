<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expedient extends Model
{
    protected $fillable = [
        'description',
        'detail_id'
    ];
    public function student()
    {
        return $this->belongsTo('App\Student');
    }
    public function details()
    {
        return $this->hasOne('App\Details');
    }
}
