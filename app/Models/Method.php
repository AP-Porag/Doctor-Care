<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Method extends Model
{
    protected $guarded = [];

    public function sale()
    {
        return $this->hasMany(Sale::class);
    }
}
