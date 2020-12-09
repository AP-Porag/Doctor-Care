<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use SoftDeletes;
    protected $fillable = ['user_id', 'address', 'created_at', 'updated_at'];
    public function getUserFromAddress()
    {
        return $this->hasOne(App\User::class);
    }
}
