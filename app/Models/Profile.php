<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['user_id', 'profile_picture', 'created_at', 'updated_at'];
    public function getUserFromProfileImage()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}
