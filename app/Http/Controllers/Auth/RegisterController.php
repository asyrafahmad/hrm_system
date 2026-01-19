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
use App\Models\Employee;
use App\Services\HR\EmployeeIdService;

class RegisterController extends Controller
{
    public function register()
    {
        $roles = DB::table('roles')->get();
        return view('auth.register',compact('roles'));
    }

    public function storeUser(Request $request, EmployeeIdService $employeeIdService)
    {
        $request->validate([
            'username'              => 'required|string|max:255',
            'email'                 => 'required|string|email|max:255|unique:users,email',
            'role'                  => 'required|integer|exists:roles,id',
            'password'              => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required',
        ]);

        $dt       = Carbon::now();
        $todayDate = $dt->toDayDateTimeString();

        try {
            DB::transaction(function () use ($request, $employeeIdService) {

                // 1️⃣ Create user FIRST
                $user = User::create([
                    'username'          => $request->username,
                    'avatar'            => $request->image ?? null,
                    'email'             => $request->email,
                    'user_status_id'    => 1,
                    'password'          => Hash::make($request->password),
                ]);

                // 2️⃣ Assign role
                $user->assignRole($request->role);

                // 3️⃣ Generate employee code
                $employeeCode = $employeeIdService->generate();

                // 4️⃣ Create employee
                $employee = Employee::create([
                    'user_id'       => $user->id,
                    'employee_code' => $employeeCode,
                    'join_date'     => $todayDate,
                    'name'          => $request->name,
                    'email'         => $request->email,
                ]);

                ProfileInformation::create([
                    'name'          => $request->name,
                    'email'         => $request->email,
                    'employee_id'   => $employee->id,
                ]);
            });

            Toastr::success('Create new account successfully :)','Success');
            return redirect('login');

        } catch (\Exception $e) {
            Toastr::error('Fail to create new account :)','Error');
            return $e->getMessage();
        }
    }
}
