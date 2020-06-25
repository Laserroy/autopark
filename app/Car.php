<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
        'number', 'driver'
    ];

    public function autoparks()
    {
        return $this->belongsToMany('App\Autopark');
    }
}
