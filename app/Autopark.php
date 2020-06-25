<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Autopark extends Model
{
    public function cars()
    {
        return $this->belongsToMany('App\Car');
    }
}
