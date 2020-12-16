<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function getUserFromAddress()
    {
        return $this->belongsTo(User::class);
    }
}
