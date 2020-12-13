<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = ['user_id', 'city', 'created_at', 'updated_at'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
