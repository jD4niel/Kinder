<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'type'
    ];
    public function tutor()
    {
        return $this->hasOne('App\Tutor');
    }
}
