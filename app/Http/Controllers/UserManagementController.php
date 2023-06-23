<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use DB;
use App\Models\User;
use App\Models\Employee;
use App\Models\Form;
use App\Models\ProfileInformation;
use App\Rules\MatchOldPassword;
use Carbon\Carbon;
use Session;
use Auth;
use Hash;

class UserManagementController extends Controller
{
    public function index()
    {
        if (Auth::user()->role_name=='Admin')
        {
            $result      = DB::table('users')->get();
            $role_name   = DB::table('role_type_users')->get();
            $position    = DB::table('position_types')->get();
            $department  = DB::table('departments')->get();
            $status_user = DB::table('user_types')->get();
            return view('usermanagement.user_control',compact('result','role_name','position','department','status_user'));
        }
        else
        {
            return redirect()->route('home');
        }
        
    }
    // search user
    public function searchUser(Request $request)
    {
        if (Auth::user()->role_name=='Admin')
        {
            $users      = DB::table('users')->get();
            $result     = DB::table('users')->get();
            $role_name  = DB::table('role_type_users')->get();
            $position   = DB::table('position_types')->get();
            $department = DB::table('departments')->get();
            $status_user = DB::table('user_types')->get();

            // search by name
            if($request->name)
            {
                $result = User::where('name','LIKE','%'.$request->name.'%')->get();
            }

            // search by role name
            if($request->role_name)
            {
                $result = User::where('role_name','LIKE','%'.$request->role_name.'%')->get();
            }

            // search by status
            if($request->status)
            {
                $result = User::where('status','LIKE','%'.$request->status.'%')->get();
            }

            // search by name and role name
            if($request->name && $request->role_name)
            {
                $result = User::where('name','LIKE','%'.$request->name.'%')
                                ->where('role_name','LIKE','%'.$request->role_name.'%')
                                ->get();
            }

            // search by role name and status
            if($request->role_name && $request->status)
            {
                $result = User::where('role_name','LIKE','%'.$request->role_name.'%')
                                ->where('status','LIKE','%'.$request->status.'%')
                                ->get();
            }

            // search by name and status
            if($request->name && $request->status)
            {
                $result = User::where('name','LIKE','%'.$request->name.'%')
                                ->where('status','LIKE','%'.$request->status.'%')
                                ->get();
            }

            // search by name and role name and status
            if($request->name && $request->role_name && $request->status)
            {
                $result = User::where('name','LIKE','%'.$request->name.'%')
                                ->where('role_name','LIKE','%'.$request->role_name.'%')
                                ->where('status','LIKE','%'.$request->status.'%')
                                ->get();
            }
           
            return view('usermanagement.user_control',compact('users','role_name','position','department','status_user','result'));
        }
        else
        {
            return redirect()->route('home');
        }
    
    }

    // use activity log
    public function activityLog()
    {
        $activityLog = DB::table('user_activity_logs')->get();
        return view('usermanagement.user_activity_log',compact('activityLog'));
    }
    // activity log
    public function activityLogInLogOut()
    {
        $activityLog = DB::table('activity_logs')->get();
        return view('usermanagement.activity_log',compact('activityLog'));
    }

    // profile user
    public function profile()
    {   
        $user = Auth::User();
        Session::put('user', $user);
        $user=Session::get('user');
        $profile = $user->rec_id;
       
        $user = DB::table('users')->get();
        $employees = DB::table('profile_information')->where('rec_id',$profile)->first();

        if(empty($employees))
        {
            $information = DB::table('profile_information')->where('rec_id',$profile)->first();
            return view('usermanagement.profile_user',compact('information','user'));

        }else{
            $rec_id = $employees->rec_id;
            if($rec_id == $profile)
            {
                $information = DB::table('profile_information')->where('rec_id',$profile)->first();
                return view('usermanagement.profile_user',compact('information','user'));
            }else{
                $information = ProfileInformation::all();
                return view('usermanagement.profile_user',compact('information','user'));
            } 
        }
       
    }

    // save profile 
    public function profileInformation(Request $request)
    {
        try{
            if(!empty($request->images))
            {
                $image_name = $request->hidden_image;
                $image = $request->file('images');
                if($image_name =='photo_defaults.jpg')
                {
                    if($image != '')
                    {
                        $image_name = rand() . '.' . $image->getClientOriginalExtension();
                        $image->move(public_path('/assets/images/'), $image_name);
                    }
                }
                else{
                    if($image != '')
                    {
                        $image_name = rand() . '.' . $image->getClientOriginalExtension();
                        $image->move(public_path('/assets/images/'), $image_name);
                    }
                }
                $update = [
                    'rec_id' => $request->rec_id,
                    'name'   => $request->name,
                    'avatar' => $image_name,
                ];
                User::where('rec_id',$request->rec_id)->update($update);
            } 

            $information = ProfileInformation::updateOrCreate(['rec_id' => $request->rec_id]);
            $information->name         = $request->name;
            $information->rec_id       = $request->rec_id;
            $information->email        = $request->email;
            $information->birth_date   = $request->birthDate;
            $information->gender       = $request->gender;
            $information->address      = $request->address;
            $information->state        = $request->state;
            $information->country      = $request->country;
            $information->pin_code     = $request->pin_code;
            $information->phone_number = $request->phone_number;
            $information->department   = $request->department;
            $information->designation  = $request->designation;
            $information->reports_to   = $request->reports_to;
            $information->save();
            
            DB::commit();
            Toastr::success('Profile Information successfully :)','Success');
            return redirect()->back();
        }catch(\Exception $e){
            DB::rollback();
            Toastr::error('Add Profile Information fail :)','Error');
            return redirect()->back();
        }
    }

    // save profile information
    public function profilePersonalInformationContact(Request $request)
    {
        try{
            $information = ProfileInformation::updateOrCreate(['rec_id' => $request->rec_id]);
            $information->passport_no               = $request->passport_no;
            $information->passport_expired_date     = $request->passport_expired_date;
            $information->nationality               = $request->nationality;
            $information->religion                  = $request->religion;
            $information->marital_status            = $request->marital_status;
            $information->employment_of_spouse      = $request->employment_of_spouse;
            $information->no_of_children            = $request->no_of_children;
            $information->save();
            
            DB::commit();
            Toastr::success('Store Profile Personal Information successfully :)','Success');
            return redirect()->back();
        }catch(\Exception $e){
            DB::rollback();
            Toastr::error('Store Profile Personal Information fail :)','Error');
            return redirect()->back();
        }
    }

    // save profile emergency contact
    public function profileEmergencyContact(Request $request)
    {
        try{
            $information = ProfileInformation::updateOrCreate(['rec_id' => $request->rec_id]);
            $information->emergency_contact_name_1          = $request->emergency_contact_name_1;
            $information->emergency_contact_relationship_1  = $request->emergency_contact_relationship_1;
            $information->emergency_contact_phone_1         = $request->emergency_contact_phone_1;
            $information->emergency_contact_mobile_1        = $request->emergency_contact_mobile_1;
            $information->emergency_contact_name_2          = $request->emergency_contact_name_2;
            $information->emergency_contact_relationship_2  = $request->emergency_contact_relationship_2;
            $information->emergency_contact_phone_2         = $request->emergency_contact_phone_2;
            $information->emergency_contact_mobile_2        = $request->emergency_contact_mobile_2;
            $information->save();
            
            DB::commit();
            Toastr::success('Add Profile Emergency Contact successfully :)','Success');
            return redirect()->back();
        }catch(\Exception $e){
            DB::rollback();
            Toastr::error('Add Profile Emergency Contact fail :)','Error');
            return redirect()->back();
        }
    }

    // save family information contact
    public function profileFamilyInformationContact(Request $request)
    {
        try{
            $information = ProfileInformation::updateOrCreate(['rec_id' => $request->rec_id]);
            $information->family_member_name_1              = $request->family_member_name_1;
            $information->family_member_relationship_1      = $request->family_member_relationship_1;
            $information->family_member_DOB_1               = $request->family_member_DOB_1;
            $information->family_member_phone_1             = $request->family_member_phone_1;
            $information->save();
            
            DB::commit();
            Toastr::success('Store Family Information successfully :)','Success');
            return redirect()->back();
        }catch(\Exception $e){
            DB::rollback();
            Toastr::error('Store Family Information fail :)','Error');
            return redirect()->back();
        }
    }

    // save bank information contact
    public function profileBankInformation(Request $request)
    {
        try{
            $information = ProfileInformation::updateOrCreate(['rec_id' => $request->rec_id]);
            $information->bank_name             = $request->bank_name;
            $information->bank_account_no       = $request->bank_account_no;
            $information->save();
            
            DB::commit();
            Toastr::success('Store Bank Information successfully :)','Success');
            return redirect()->back();
        }catch(\Exception $e){
            DB::rollback();
            Toastr::error('Store Bank Information fail :)','Error');
            return redirect()->back();
        }
    }

    // Save Education Information
    public function profileEducationInformation(Request $request)
    {
        try{
            $information = ProfileInformation::updateOrCreate(['rec_id' => $request->rec_id]);
            $information->academic_institution_1            = $request->academic_institution_1;
            $information->academic_qualification_1          = $request->academic_qualification_1;
            $information->academic_type_qualification_1     = $request->academic_type_qualification_1;
            $information->academic_grade_1                  = $request->academic_grade_1;
            $information->academic_starting_date_1          = $request->academic_starting_date_1;
            $information->academic_complete_date_1          = $request->academic_complete_date_1;
            $information->academic_institution_2            = $request->academic_institution_2;
            $information->academic_qualification_2          = $request->academic_qualification_2;
            $information->academic_type_qualification_2     = $request->academic_type_qualification_2;
            $information->academic_grade_2                  = $request->academic_grade_2;
            $information->academic_starting_date_2          = $request->academic_starting_date_2;
            $information->academic_complete_date_2          = $request->academic_complete_date_2;
            $information->save();
            
            DB::commit();
            Toastr::success('Store Academic Information successfully :)','Success');
            return redirect()->back();
        }catch(\Exception $e){
            DB::rollback();
            Toastr::error('Store Academic Information fail :)','Error');
            return redirect()->back();
        }
    }
    
    // Save Eexperience Information
    public function profileExperienceInformation(Request $request)
    {
        try{
            $information = ProfileInformation::updateOrCreate(['rec_id' => $request->rec_id]);
            $information->exp_company_name_1            = $request->exp_company_name_1;
            $information->exp_location_1                = $request->exp_location_1;
            $information->exp_position_1                = $request->exp_position_1;
            $information->exp_period_from_1             = $request->exp_period_from_1;
            $information->exp_period_to_1               = $request->exp_period_to_1;
            $information->exp_company_name_2            = $request->exp_company_name_2;
            $information->exp_location_2                = $request->exp_location_2;
            $information->exp_position_2                = $request->exp_position_2;
            $information->exp_period_from_2             = $request->exp_period_from_2;
            $information->exp_period_to_2               = $request->exp_period_to_2;
            $information->save();
            
            DB::commit();
            Toastr::success('Store Experience Information successfully :)','Success');
            return redirect()->back();
        }catch(\Exception $e){
            DB::rollback();
            Toastr::error('Store Experience Information fail :)','Error');
            return redirect()->back();
        }
    }

    
   
    // save new user
    public function addNewUserSave(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|string|email|max:255|unique:users',
            'phone'     => 'required|min:11|numeric',
            'role_name' => 'required|string|max:255',
            'position'  => 'required|string|max:255',
            'department'=> 'required|string|max:255',
            'status'    => 'required|string|max:255',
            'image'     => 'required|image',
            'password'  => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required',
        ]);
        DB::beginTransaction();
        try{
            $dt       = Carbon::now();
            $todayDate = $dt->toDayDateTimeString();

            $image = time().'.'.$request->image->extension();  
            $request->image->move(public_path('assets/images'), $image);

            $user = new User;
            $user->name         = $request->name;
            $user->email        = $request->email;
            $user->join_date    = $todayDate;
            $user->phone_number = $request->phone;
            $user->role_name    = $request->role_name;
            $user->position     = $request->position;
            $user->department   = $request->department;
            $user->status       = $request->status;
            $user->avatar       = $image;
            $user->password     = Hash::make($request->password);
            $user->save();

            DB::commit();
            Toastr::success('Create new account successfully :)','Success');
            return redirect()->route('userManagement');
        }catch(\Exception $e){
            DB::rollback();
            Toastr::error('User add new account fail :)','Error');
            return redirect()->back();
        }
    }
    
    // update
    public function update(Request $request)
    {
        DB::beginTransaction();
        try{
            $rec_id       = $request->rec_id;
            $name         = $request->name;
            $email        = $request->email;
            $role_name    = $request->role_name;
            $position     = $request->position;
            $phone        = $request->phone;
            $department   = $request->department;
            $status       = $request->status;

            $dt       = Carbon::now();
            $todayDate = $dt->toDayDateTimeString();
            $image_name = $request->hidden_image;
            $image = $request->file('images');
            if($image_name =='photo_defaults.jpg')
            {
                if($image != '')
                {
                    $image_name = rand() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('/assets/images/'), $image_name);
                }
            }
            else{
                
                if($image != '')
                {
                    $image_name = rand() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('/assets/images/'), $image_name);
                }
            }
            
            $update = [

                'rec_id'       => $rec_id,
                'name'         => $name,
                'role_name'    => $role_name,
                'email'        => $email,
                'position'     => $position,
                'phone_number' => $phone,
                'department'   => $department,
                'status'       => $status,
                'avatar'       => $image_name,
            ];

            $activityLog = [
                'user_name'    => $name,
                'email'        => $email,
                'phone_number' => $phone,
                'status'       => $status,
                'role_name'    => $role_name,
                'modify_user'  => 'Update',
                'date_time'    => $todayDate,
            ];

            DB::table('user_activity_logs')->insert($activityLog);
            User::where('rec_id',$request->rec_id)->update($update);
            DB::commit();
            Toastr::success('User updated successfully :)','Success');
            return redirect()->route('userManagement');

        }catch(\Exception $e){
            DB::rollback();
            Toastr::error('User update fail :)','Error');
            return redirect()->back();
        }
    }
    // delete
    public function delete(Request $request)
    {
        $user = Auth::User();
        Session::put('user', $user);
        $user=Session::get('user');
        DB::beginTransaction();
        try{
            $fullName     = $user->name;
            $email        = $user->email;
            $phone_number = $user->phone_number;
            $status       = $user->status;
            $role_name    = $user->role_name;

            $dt       = Carbon::now();
            $todayDate = $dt->toDayDateTimeString();

            $activityLog = [

                'user_name'    => $fullName,
                'email'        => $email,
                'phone_number' => $phone_number,
                'status'       => $status,
                'role_name'    => $role_name,
                'modify_user'  => 'Delete',
                'date_time'    => $todayDate,
            ];

            DB::table('user_activity_logs')->insert($activityLog);

            if($request->avatar =='photo_defaults.jpg'){
                User::destroy($request->id);
            }else{
                User::destroy($request->id);
                unlink('assets/images/'.$request->avatar);
            }
            DB::commit();
            Toastr::success('User deleted successfully :)','Success');
            return redirect()->route('userManagement');
            
        }catch(\Exception $e){
            DB::rollback();
            Toastr::error('User deleted fail :)','Error');
            return redirect()->back();
        }
    }

    // view change password
    public function changePasswordView()
    {
        return view('settings.changepassword');
    }
    
    // change password in db
    public function changePasswordDB(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
        DB::commit();
        Toastr::success('User change successfully :)','Success');
        return redirect()->intended('home');
    }
}









