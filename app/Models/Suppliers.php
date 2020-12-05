<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Suppliers extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name', 'slug', 'sr_name', 'phone', 'logo'
    ];
}
