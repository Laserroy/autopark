<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    public function autopark()
    {
        return $this->belongsTo('App\Autopark');
    }
}
