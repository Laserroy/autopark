<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Autopark extends Model
{
    protected $fillable = ['name', 'address', 'work_hours'];

    public function cars()
    {
        return $this->belongsToMany('App\Car');
    }
}
