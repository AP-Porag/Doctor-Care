<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $guarded = [];

    public function test()
    {
        return $this->belongsTo(Lab::class,'test_id');
    }
    public function patient()
    {
        return $this->belongsTo(User::class,'patient_id');
    }
    public function technician()
    {
        return $this->belongsTo(User::class,'prepared_by');
    }
    public function verifiedDoctor()
    {
        return $this->belongsTo(User::class,'verifier_doctor_id');
    }
}
