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
        'employee_id',
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
        
        // Emergency Contact
        'emergency_contact_name_1',
        'emergency_contact_relationship_1',
        'emergency_contact_phone_1',
        'emergency_contact_mobile_1',
        'emergency_contact_name_2',
        'emergency_contact_relationship_2',
        'emergency_contact_phone_1',
        'emergency_contact_mobile_1',

        // Personal Informations
        'passport_no',
        'passport_expired_date',
        'nationality',
        'religion',
        'marital_status',
        'employment_of_spouse',
        'no_of_children',

        // Family Member
        'family_member_name_1',
        'family_member_relationship_1',
        'family_member_DOB_1',
        'family_member_phone_1',

        // Family Member
        'family_member_name_1',
        'family_member_relationship_1',
        'family_member_DOB_1',
        'family_member_phone_1',

        // Bank Information Member
        'bank_name',
        'bank_account_no',

        // Education Informations
        'academic_institution_1',
        'academic_qualification_1',
        'academic_type_qualification_1',
        'academic_grade_1',
        'academic_starting_date_1',
        'academic_complete_date_1',
        'academic_institution_2',
        'academic_qualification_2',
        'academic_type_qualification_2',
        'academic_grade_2',
        'academic_starting_date_2',
        'academic_complete_date_2',

        // Experience Information
        'exp_company_name_1',
        'exp_location_1',
        'exp_position_1',
        'exp_period_from_1',
        'exp_period_to_1',
        'exp_company_name_2',
        'exp_location_2',
        'exp_position_2',
        'exp_period_from_2',
        'exp_period_to_2',
        
        // 'user_id',
    ];
    
    // public function User()
    // {
    //     return $this->belongsTo(User::class);
    // }
}
