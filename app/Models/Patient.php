<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'user_id','pt_id','alter_contact','gender','birth_date','blood_group',
    ];

    //relations between patient and others models start




}
