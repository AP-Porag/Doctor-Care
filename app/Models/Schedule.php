<?php

namespace App\Models;

use App\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
    protected $fillable = ['doctor_id', 'weekday', 'start_time', 'end_time'];
    use SoftDeletes;
    public function doctor()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }
}
