<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Traits\LockableTrait;
use Spatie\Permission\Traits\HasRoles;

use App\Models\ProfileInformation;
use App\Models\Employee;
use App\Models\UserRoleType;
use App\Models\UserStatus;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use LockableTrait;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'employee_id',
        'email',
        'join_date',
        'phone_number',
        // 'user_role_types_id',
        'user_status_id',
        'role_name',
        'avatar',
        'position',
        'department',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    // public function userRoleType()
    // {
    //     return $this->belongsTo(UserRoleType::class);
    // }

    public function userStatus()
    {
        return $this->belongsTo(UserStatus::class);
    }

    // public function ProfileInformation()
    // {
    //     return $this->hasOne(ProfileInformation::class);
    // }


}
