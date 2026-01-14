<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ProfileInformation;
use Brian2694\Toastr\Facades\Toastr;
use Hash;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

use Spatie\Permission\Models\Role;

class RegisterController extends Controller
{
    public function register()
    {
        $roles = DB::table('roles')->get();
        return view('auth.register',compact('roles'));
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|string|email|max:255|unique:users',
            'role_name' => 'required|string',
            'password'  => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required',
        ]);

        // $dt       = Carbon::now();
        // $todayDate = $dt->toDayDateTimeString();

        $user = User::create([
            'name'      => $request->name,
            'avatar'    => $request->image,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
        ]);

        // Make sure the role exists
        if (Role::where('name', $request->role_name)->exists()) {
            $user->assignRole($request->role_name);
        } else {
            // Optional: handle invalid role input
            Toastr::error('Role does not exist!', 'Error');
            return redirect()->back();
        }

        // ProfileInformation::create([
        //     'name'      => $request->name,
        //     'email'     => $request->email,
        //     'designation' => $request->role_name,
        // ]);

        Toastr::success('Create new account successfully :)','Success');
        return redirect('login');
    }
}
