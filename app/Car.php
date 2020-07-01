<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Car extends Model
{
    protected $fillable = [
        'number', 'driver', 'created_by'
    ];

    public function autoparks()
    {
        return $this->belongsToMany('App\Autopark');
    }

    public function createdBy()
    {
        return $this->belongsTo('App\User');
    }
}
