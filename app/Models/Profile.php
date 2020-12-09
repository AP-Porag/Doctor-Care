<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use SoftDeletes;
    protected $fillable = ['user_id', 'profile_picture', 'created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
