<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\Employee;

class ProfileInformationSeeder extends Seeder
{
    public function run()
    {
        $superadmin = Employee::where('email', 'superadmin@gmail.com')->first();
        $hr = Employee::where('email', 'hr@gmail.com')->first();
        $employee = Employee::where('email', 'employee@gmail.com')->first();

        DB::table('profile_information')->insert([

            /*
            |--------------------------------------------------------------------------
            | Employee 1 – Super Admin
            |--------------------------------------------------------------------------
            */
            [
                'name' => 'Super Admin',
                'employee_id' => $superadmin->id,
                'email' => 'superadmin@gmail.com',
                'birth_date' => '1990-01-01',
                'gender' => 'Male',
                'address' => 'No 1, Jalan Utama',
                'city' => 'Seremban',
                'state' => 'Negeri Sembilan',
                'country' => 'Malaysia',
                'postcode' => '70000',
                'phone_number' => '0192675696',
                'department' => 'Human Resource Department',
                'designation' => 'Super Administrator',
                'reports_to' => 3,

                'emergency_contact_name_1' => 'Ali Hassan',
                'emergency_contact_relationship_1' => 'Brother',
                'emergency_contact_phone_1' => '0171111111',
                'emergency_contact_mobile_1' => '0171111111',
                'emergency_contact_name_2' => 'Aminah Hassan',
                'emergency_contact_relationship_2' => 'Mother',
                'emergency_contact_phone_2' => '0162222222',
                'emergency_contact_mobile_2' => '0162222222',

                'passport_no' => 'A12345678',
                'passport_expired_date' => '2030-12-31',
                'nationality' => 'Malaysian',
                'religion' => 'Islam',
                'marital_status' => 'Married',
                'employment_of_spouse' => 'Teacher',
                'no_of_children' => '2',

                'family_member_name_1' => 'Ahmad Admin',
                'family_member_relationship_1' => 'Son',
                'family_member_DOB_1' => '2015-05-05',
                'family_member_phone_1' => '0193333333',

                'bank_name' => 'Maybank',
                'bank_account_no' => '111122223333',

                'academic_institution_1' => 'Universiti Malaya',
                'academic_qualification_1' => 'Bachelor Degree',
                'academic_type_qualification_1' => 'Computer Science',
                'academic_grade_1' => 'First Class',
                'academic_starting_date_1' => '2008',
                'academic_complete_date_1' => '2012',
                'academic_institution_2' => 'Universiti Malaya',
                'academic_qualification_2' => 'Master Degree',
                'academic_type_qualification_2' => 'Information Systems',
                'academic_grade_2' => 'Distinction',
                'academic_starting_date_2' => '2013',
                'academic_complete_date_2' => '2015',

                'exp_company_name_1' => 'ABC Tech',
                'exp_location_1' => 'Kuala Lumpur',
                'exp_position_1' => 'System Engineer',
                'exp_period_from_1' => '2012',
                'exp_period_to_1' => '2016',
                'exp_company_name_2' => 'XYZ Solutions',
                'exp_location_2' => 'Cyberjaya',
                'exp_position_2' => 'IT Manager',
                'exp_period_from_2' => '2016',
                'exp_period_to_2' => '2020',

                'created_at' => now(),
                'updated_at' => now(),
            ],

            /*
            |--------------------------------------------------------------------------
            | Employee 2 – HR Admin
            |--------------------------------------------------------------------------
            */
            [
                'name' => 'HR Admin',
                'employee_id' => $hr->id,
                'email' => 'hr@gmail.com',
                'birth_date' => '1990-02-02',
                'gender' => 'Male',
                'address' => 'Seremban 2',
                'city' => 'Seremban',
                'state' => 'Negeri Sembilan',
                'country' => 'Malaysia',
                'postcode' => '70300',
                'phone_number' => '0192675697',
                'department' => 'Human Resource Department',
                'designation' => 'HR Manager',
                'reports_to' => 1,

                'emergency_contact_name_1' => 'Siti Aminah',
                'emergency_contact_relationship_1' => 'Wife',
                'emergency_contact_phone_1' => '0184444444',
                'emergency_contact_mobile_1' => '0184444444',
                'emergency_contact_name_2' => 'Rahman',
                'emergency_contact_relationship_2' => 'Father',
                'emergency_contact_phone_2' => '0175555555',
                'emergency_contact_mobile_2' => '0175555555',

                'passport_no' => 'B87654321',
                'passport_expired_date' => '2031-06-30',
                'nationality' => 'Malaysian',
                'religion' => 'Islam',
                'marital_status' => 'Married',
                'employment_of_spouse' => 'Nurse',
                'no_of_children' => '1',

                'family_member_name_1' => 'Aisyah',
                'family_member_relationship_1' => 'Daughter',
                'family_member_DOB_1' => '2018-08-08',
                'family_member_phone_1' => '0196666666',

                'bank_name' => 'CIMB',
                'bank_account_no' => '444455556666',

                'academic_institution_1' => 'UKM',
                'academic_qualification_1' => 'Bachelor Degree',
                'academic_type_qualification_1' => 'Human Resource',
                'academic_grade_1' => 'Second Upper',
                'academic_starting_date_1' => '2009',
                'academic_complete_date_1' => '2013',
                'academic_institution_2' => 'Open University Malaysia',
                'academic_qualification_2' => 'Diploma',
                'academic_type_qualification_2' => 'Management',
                'academic_grade_2' => 'Merit',
                'academic_starting_date_2' => '2007',
                'academic_complete_date_2' => '2009',

                'exp_company_name_1' => 'HR Solutions',
                'exp_location_1' => 'Seremban',
                'exp_position_1' => 'HR Executive',
                'exp_period_from_1' => '2013',
                'exp_period_to_1' => '2018',
                'exp_company_name_2' => 'ABC Corporation',
                'exp_location_2' => 'Kuala Lumpur',
                'exp_position_2' => 'HR Manager',
                'exp_period_from_2' => '2018',
                'exp_period_to_2' => '2022',

                'created_at' => now(),
                'updated_at' => now(),
            ],

            /*
            |--------------------------------------------------------------------------
            | Employee 3 – Employee
            |--------------------------------------------------------------------------
            */
            [
                'name' => 'User',
                'employee_id' => $employee->id,
                'email' => 'user@gmail.com',
                'birth_date' => '1990-03-03',
                'gender' => 'Male',
                'address' => 'Nilai',
                'city' => 'Seremban',
                'state' => 'Negeri Sembilan',
                'country' => 'Malaysia',
                'postcode' => '71800',
                'phone_number' => '0192675698',
                'department' => 'Information Technology',
                'designation' => 'Software Engineer',
                'reports_to' => 1,

                'emergency_contact_name_1' => 'Hassan',
                'emergency_contact_relationship_1' => 'Father',
                'emergency_contact_phone_1' => '0177777777',
                'emergency_contact_mobile_1' => '0177777777',
                'emergency_contact_name_2' => 'Zainab',
                'emergency_contact_relationship_2' => 'Mother',
                'emergency_contact_phone_2' => '0168888888',
                'emergency_contact_mobile_2' => '0168888888',

                'passport_no' => 'C99887766',
                'passport_expired_date' => '2029-11-30',
                'nationality' => 'Malaysian',
                'religion' => 'Islam',
                'marital_status' => 'Single',
                'employment_of_spouse' => "Doctor",
                'no_of_children' => '0',

                'family_member_name_1' => 'Zaki',
                'family_member_relationship_1' => 'Brother',
                'family_member_DOB_1' => '1995-01-01',
                'family_member_phone_1' => '0199999999',

                'bank_name' => 'RHB',
                'bank_account_no' => '777788889999',

                'academic_institution_1' => 'UTM',
                'academic_qualification_1' => 'Bachelor Degree',
                'academic_type_qualification_1' => 'Software Engineering',
                'academic_grade_1' => 'Second Upper',
                'academic_starting_date_1' => '2009',
                'academic_complete_date_1' => '2013',
                'academic_institution_2' => 'UMT',
                'academic_qualification_2' => "Diploma",
                'academic_type_qualification_2' => 'Computer Science',
                'academic_grade_2' => 'First Class',
                'academic_starting_date_2' => '2007',
                'academic_complete_date_2' => '2009',

                'exp_company_name_1' => 'TechSoft',
                'exp_location_1' => 'Cyberjaya',
                'exp_position_1' => 'Junior Developer',
                'exp_period_from_1' => '2014',
                'exp_period_to_1' => '2018',
                'exp_company_name_2' => 'InnoTech',
                'exp_location_2' => 'Kuala Lumpur',
                'exp_position_2' => 'Software Engineer',
                'exp_period_from_2' => '2018',
                'exp_period_to_2' => '2022',

                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
