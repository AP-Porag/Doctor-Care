<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = ['user_id', 'address', 'created_at', 'updated_at'];
    public function getUserFromAddress()
    {
        return $this->hasOne(App\User::class);
    }
}
