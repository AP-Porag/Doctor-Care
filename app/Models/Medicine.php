<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    protected $guarded = [];

    public function generic()
    {
        return $this->belongsTo(Generic::class);
    }
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function purchaseRequest()
    {
        return $this->hasMany(PurchaseRequest::class,'medicine_id');
    }
    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }
    public function sells()
    {
        return $this->hasMany(SoldMedicine::class);
    }

}
