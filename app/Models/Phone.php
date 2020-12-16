<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    protected $guarded = [];
    public function user()
    {
        $this->belongsTo(User::class);
    }
}
