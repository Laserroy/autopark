<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    public function autoparks()
    {
        return $this->belongsToMany('App\Autopark');
    }
}
