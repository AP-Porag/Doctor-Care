<?php

namespace App;

use App\Models\Phone;
use App\Models\Profile;
use App\Models\Address;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function phones()
    {
        return $this->hasOne(Phone::class);
    }

    public function profiles()
    {
        return $this->hasOne(Profile::class);
    }

    public function addresses()
    {
        return $this->hasOne(Address::class);
    }
}
