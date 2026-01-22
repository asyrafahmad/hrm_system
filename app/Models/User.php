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

    protected $guard_name = 'web';

    protected $fillable = [
        'username',
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

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function employee()
    {
        return $this->hasOne(Employee::class);
    }

    public function userStatus()
    {
        return $this->belongsTo(UserStatus::class);
    }

}
