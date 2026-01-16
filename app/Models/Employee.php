<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\ProfileInformation;
use App\Models\Department;
use App\Models\Positions;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'fullname',
        'email',
        'birth_date',
        'gender',
        'employee_code',
        'company',
        'department_id',
        'position_id',
        'holidays',
        'leaves',
        'clients',
        'projects',
        'tasks',
        'assets',
        'timing_sheets',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function profileInformation()
    {
        return $this->hasOne(ProfileInformation::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function positions()
    {
        return $this->belongsTo(Positions::class);
    }
}
