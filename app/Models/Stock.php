<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $guarded = [];

    public function medicine()
    {
        return $this->belongsTo(Medicine::class);
    }
}
