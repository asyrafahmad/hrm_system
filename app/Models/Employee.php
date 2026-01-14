<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\ProfileInformation;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'birth_date',
        'gender',
        'employee_id',
        'company',
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
        return $this->hasOne(User::class);
    }

    public function profileInformation()
    {
        return $this->hasOne(ProfileInformation::class);
    }
}
