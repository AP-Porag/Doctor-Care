<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseRequest extends Model
{
    protected $guarded = [];

    public function medicine()
    {
        return $this->belongsTo(Medicine::class,'medicine_id');
    }
}
