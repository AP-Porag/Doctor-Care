<?php

namespace App;

use App\Models\Appointment;
use App\Models\Dew;
use App\Models\Doctor;
use App\Models\Group;
use App\Models\Phone;
use App\Models\Profile;
use App\Models\Address;
use App\Models\Speciality;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{
    use SoftDeletes,HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //Role management methods start

    public static function getPermissionGroups()
    {
        return $permissionGroups = DB::table('permissions')->select('group_id')->groupBy('group_id')->get();
        //return $permissionGroups = DB::table('permissions')->select('group_name')->groupBy('group_name')->get();
    }

    public static function roleHasPermissions($role,$permissions)
    {
        $hasPermission =  true;
        foreach ($permissions as $permission){
            if (!$role->hasPermissionTo($permission->name)){
                $hasPermission = false;
                return $hasPermission;
            }
        }
        return $hasPermission;
    }
    //Role management methods end

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function phones()
    {
        return $this->hasMany(Phone::class);
    }

    public function profile()
    {
        return $this->hasOne(Profile::class)->withTrashed();
    }

    public function address()
    {
        return $this->hasOne(Address::class)->withTrashed();
    }

    public function userAppointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function dews()
    {
        return $this->hasMany(Dew::class,'patient_id');
    }
    public function specialities()
    {
        return $this->hasMany(Speciality::class);
    }

    public function doctor()
    {
        return $this->hasMany(Doctor::class);
    }
}
