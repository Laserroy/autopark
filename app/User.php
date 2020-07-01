<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    public const ROLE_MANAGER = 'manager';

    public const ROLE_DRIVER = 'driver';

    protected $fillable = [
        'name', 'email', 'password', 'role'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isManager()
    {
        return $this->role === self::ROLE_MANAGER;
    }

    public function isDriver()
    {
        return $this->role === self::ROLE_DRIVER;
    }

    public function createdCars()
    {
        return $this->hasMany('App\Car', 'created_by');
    }
}
