<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    protected $fillable = ['user_id', 'contact', 'created_at', 'updated_at'];
    public function user()
    {
        $this->belongsTo(User::class);
    }
}
