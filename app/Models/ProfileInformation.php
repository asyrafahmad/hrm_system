<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;

class ProfileInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'rec_id',
        'email',
        'birth_date',
        'gender',
        'address',
        'state',
        'country',
        'pin_code',
        'phone_number',
        'department',
        'designation',
        'reports_to',

        'emergency_contact_name_1',
        'emergency_contact_relationship_1',
        'emergency_contact_phone_1',
        'emergency_contact_mobile_1',
        'emergency_contact_name_2',
        'emergency_contact_relationship_2',
        'emergency_contact_phone_1',
        'emergency_contact_mobile_1',
        // 'user_id',
    ];
    
    // public function User()
    // {
    //     return $this->belongsTo(User::class);
    // }
}
