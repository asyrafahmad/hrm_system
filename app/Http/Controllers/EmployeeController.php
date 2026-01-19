<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Employee;
use App\Models\User;
use App\Models\Department;
use App\Models\PermissionList;
use App\Models\module_permission;

use App\Services\HR\EmployeeIdService;

class EmployeeController extends Controller
{
    // all employee card view
    public function cardAllEmployee(Request $request)
    {
        // $users = DB::table('users')
        //             ->join('employees', 'users.id', '=', 'employees.user_id')
        //             ->select('users.*', 'employees.gender', 'employees.company', 'employees.department_id', 'employees.position_id', 'employees.phone_number', 'employees.join_date')
        //             ->get();
        // $userList = DB::table('users')->get();
        // $departmentList = DB::table('departments')->get();
        // $permission_lists = DB::table('permission_lists')->get();

        // return view('form.allemployeecard', compact('users','userList','departmentList','permission_lists'));


        $employees = Employee::with('department', 'position')->get();
        $all_department = Department::get();
        $permission_lists = PermissionList::get();

        return view('form.allemployeecard', compact('employees', 'all_department', 'permission_lists'));
    }

    // all employee list
    public function listAllEmployee()
    {
        $users = DB::table('users')
                    ->join('employees', 'users.employee_id', '=', 'employees.id')
                    ->join('roles', 'users.role_id', '=', 'roles.id')
                    ->select('users.*', 'employees.gender', 'employees.company', 'employees.department_id', 'employees.position_id', 'employees.phone_number', 'employees.join_date','roles.name as role_name')
                    ->get();
        $userList = DB::table('users')->get();
        $permission_lists = DB::table('permission_lists')->get();
        return view('form.employeelist',compact('users','userList','permission_lists'));
    }

    // save data employee
    public function saveRecord(Request $request, EmployeeIdService $employeeIdService)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'required|string|email',
            'gender'      => 'required|string|max:255',
            'company'     => 'required|string|max:255',
        ]);

        try {
            DB::transaction(function () use ($request, $employeeIdService) {

                // Check duplicate email
                $exists = Employee::where('email', $request->email)->exists();
                if ($exists) {
                    throw new \Exception('Employee already exists');
                }

                // Generate running employee ID
                $employeeCode = $employeeIdService->generate();

                // Create employee
                $employee = Employee::create([
                    'name'        => $request->name,
                    'email'       => $request->email,
                    'gender'      => $request->gender,
                    'employee_id' => $employeeCode,
                    'company'     => $request->company,
                ]);

                // Insert module permissions
                for ($i = 0; $i < count($request->id_count); $i++) {
                    DB::table('module_permissions')->insert([
                        'employee_id'       => $employeeCode,
                        'module_permission' => $request->permission[$i],
                        'id_count'          => $request->id_count[$i],
                        'read'              => $request->read[$i] ?? 0,
                        'write'             => $request->write[$i] ?? 0,
                        'create'            => $request->create[$i] ?? 0,
                        'delete'            => $request->delete[$i] ?? 0,
                        'import'            => $request->import[$i] ?? 0,
                        'export'            => $request->export[$i] ?? 0,
                    ]);
                }
            });

            Toastr::success('Add new employee successfully :)', 'Success');
            return redirect()->route('all/employee/card');

        } catch (\Exception $e) {
            Toastr::error('Add new employee exists or failed :)', 'Error');
            return redirect()->back();
        }
    }
    // view edit record
    public function viewRecord($employee_id)
    {
        $permission = DB::table('employees')
            ->join('module_permissions', 'employees.employee_id', '=', 'module_permissions.employee_id')
            ->select('employees.*', 'module_permissions.*')
            ->where('employees.employee_id','=',$employee_id)
            ->get();
        $employees = DB::table('employees')->where('employee_id',$employee_id)->get();
        return view('form.edit.editemployee',compact('employees','permission'));
    }
    // update record employee
    public function updateRecord( Request $request)
    {
        DB::beginTransaction();
        try{
            // update table Employee
            $updateEmployee = [
                'id'=>$request->id,
                'name'=>$request->name,
                'email'=>$request->email,
                'birth_date'=>$request->birth_date,
                'gender'=>$request->gender,
                'employee_id'=>$request->employee_id,
                'company'=>$request->company,
            ];
            // update table user
            $updateUser = [
                'id'=>$request->id,
                'name'=>$request->name,
                'email'=>$request->email,
            ];

            // update table module_permissions
            for($i=0;$i<count($request->id_permission);$i++)
            {
                $UpdateModule_permissions = [
                    'employee_id' => $request->employee_id,
                    'module_permission' => $request->permission[$i],
                    'id'                => $request->id_permission[$i],
                    'read'              => $request->read[$i],
                    'write'             => $request->write[$i],
                    'create'            => $request->create[$i],
                    'delete'            => $request->delete[$i],
                    'import'            => $request->import[$i],
                    'export'            => $request->export[$i],
                ];
                module_permission::where('id',$request->id_permission[$i])->update($UpdateModule_permissions);
            }

            User::where('id',$request->id)->update($updateUser);
            Employee::where('id',$request->id)->update($updateEmployee);

            DB::commit();
            Toastr::success('updated record successfully :)','Success');
            return redirect()->route('all/employee/card');
        }catch(\Exception $e){
            DB::rollback();
            Toastr::error('updated record fail :)','Error');
            return redirect()->back();
        }
    }
    // delete record
    public function deleteRecord($employee_id)
    {
        DB::beginTransaction();
        try{

            Employee::where('employee_id',$employee_id)->delete();
            module_permission::where('employee_id',$employee_id)->delete();

            DB::commit();
            Toastr::success('Delete record successfully :)','Success');
            return redirect()->route('all/employee/card');

        }catch(\Exception $e){
            DB::rollback();
            Toastr::error('Delete record fail :)','Error');
            return redirect()->back();
        }
    }
    // employee search
    public function employeeSearch(Request $request)
    {
        $users = DB::table('users')
                    ->join('employees', 'users.employee_id', '=', 'employees.id')
                    ->join('roles', 'users.role_id', '=', 'roles.id')
                    ->select('users.*', 'employees.gender', 'employees.company', 'employees.department_id', 'employees.position_id', 'employees.phone_number', 'employees.join_date','roles.name as role_name')
                    ->get();
        $departmentList = DB::table('departments')->get();
        $permission_lists = DB::table('permission_lists')->get();
        $userList = DB::table('users')->get();

        // search by id
        if($request->employee_id)
        {
            $users = DB::table('users')
                        ->join('employees', 'users.employee_id', '=', 'employees.id')
                        ->join('roles', 'users.role_id', '=', 'roles.id')
                        ->select('users.*', 'employees.gender', 'employees.company', 'employees.department_id', 'employees.position_id', 'employees.phone_number', 'employees.join_date','roles.name as role_name')
                        ->where('employee_id','LIKE','%'.$request->employee_id.'%')
                        ->get();
        }
        // search by name
        if($request->name)
        {
            $users = DB::table('users')
                        ->join('employees', 'users.employee_id', '=', 'employees.id')
                        ->join('roles', 'users.role_id', '=', 'roles.id')
                        ->select('users.*', 'employees.gender', 'employees.company', 'employees.department_id', 'employees.position_id', 'employees.phone_number', 'employees.join_date','roles.name as role_name')
                        ->where('users.name','LIKE','%'.$request->name.'%')
                        ->get();
        }
        // search by name
        if($request->position)
        {
            $users = DB::table('users')
                        ->join('employees', 'users.employee_id', '=', 'employees.id')
                        ->join('roles', 'users.role_id', '=', 'roles.id')
                        ->where('users.position_id','LIKE','%'.$request->position.'%')
                        ->get();
        }

        // search by name and id
        if($request->employee_id && $request->name)
        {
            $users = DB::table('users')
                        ->join('employees', 'users.employee_id', '=', 'employees.id')
                        ->join('roles', 'users.role_id', '=', 'roles.id')
                        ->select('users.*', 'employees.gender', 'employees.company', 'employees.department_id', 'employees.position_id', 'employees.phone_number', 'employees.join_date','roles.name as role_name')
                        ->where('employee_id','LIKE','%'.$request->employee_id.'%')
                        ->where('users.name','LIKE','%'.$request->name.'%')
                        ->get();
        }
        // search by position and id
        if($request->employee_id && $request->position)
        {
            $users = DB::table('users')
                        ->join('employees', 'users.employee_id', '=', 'employees.id')
                        ->join('roles', 'users.role_id', '=', 'roles.id')
                        ->select('users.*', 'employees.gender', 'employees.company', 'employees.department_id', 'employees.position_id', 'employees.phone_number', 'employees.join_date','roles.name as role_name')
                        ->where('employee_id','LIKE','%'.$request->employee_id.'%')
                        ->where('users.position_id','LIKE','%'.$request->position.'%')
                        ->get();
        }
        // search by name and position
        if($request->name && $request->position)
        {
            $users = DB::table('users')
                        ->join('employees', 'users.employee_id', '=', 'employees.id')
                        ->join('roles', 'users.role_id', '=', 'roles.id')
                        ->select('users.*', 'employees.gender', 'employees.company', 'employees.department_id', 'employees.position_id', 'employees.phone_number', 'employees.join_date','roles.name as role_name')
                        ->where('users.name','LIKE','%'.$request->name.'%')
                        ->where('users.position_id','LIKE','%'.$request->position.'%')
                        ->get();
        }
        // search by name and position and id
        if($request->employee_id && $request->name && $request->position)
        {
            $users = DB::table('users')
                        ->join('employees', 'users.employee_id', '=', 'employees.id')
                        ->join('roles', 'users.role_id', '=', 'roles.id')
                        ->select('users.*', 'employees.gender', 'employees.company', 'employees.department_id', 'employees.position_id', 'employees.phone_number', 'employees.join_date')
                        ->where('employee_id','LIKE','%'.$request->employee_id.'%')
                        ->where('users.name','LIKE','%'.$request->name.'%')
                        ->where('users.position_id','LIKE','%'.$request->position.'%')
                        ->get();
        }
        return view('form.allemployeecard',compact('users','userList','departmentList','permission_lists'));
    }
    public function employeeListSearch(Request $request)
    {
        $users = DB::table('users')
                    ->join('employees', 'users.employee_id', '=', 'employees.id')
                    ->join('roles', 'users.role_id', '=', 'roles.id')
                    ->select('users.*', 'employees.gender', 'employees.company', 'employees.department_id', 'employees.position_id', 'employees.phone_number', 'employees.join_date','roles.name as role_name')
                    ->get();
        $permission_lists = DB::table('permission_lists')->get();
        $userList = DB::table('users')->get();

        // search by id
        if($request->employee_id)
        {
            $users = DB::table('users')
                        ->join('employees', 'users.employee_id', '=', 'employees.id')
                        ->join('roles', 'users.role_id', '=', 'roles.id')
                        ->select('users.*', 'employees.gender', 'employees.company', 'employees.department_id', 'employees.position_id', 'employees.phone_number', 'employees.join_date','roles.name as role_name')
                        ->where('employee_id','LIKE','%'.$request->employee_id.'%')
                        ->get();
        }
        // search by name
        if($request->name)
        {
            $users = DB::table('users')
                        ->join('employees', 'users.employee_id', '=', 'employees.id')
                        ->join('roles', 'users.role_id', '=', 'roles.id')
                        ->select('users.*', 'employees.gender', 'employees.company', 'employees.department_id', 'employees.position_id', 'employees.phone_number', 'employees.join_date')
                        ->where('users.name','LIKE','%'.$request->name.'%')
                        ->get();
        }
        // search by name
        if($request->position)
        {
            $users = DB::table('users')
                        ->join('employees', 'users.employee_id', '=', 'employees.id')
                        ->select('users.*', 'employees.gender', 'employees.company', 'employees.department_id', 'employees.position_id', 'employees.phone_number', 'employees.join_date')
                        ->where('users.position_id','LIKE','%'.$request->position.'%')
                        ->get();
        }

        // search by name and id
        if($request->employee_id && $request->name)
        {
            $users = DB::table('users')
                        ->join('employees', 'users.employee_id', '=', 'employees.id')
                        ->select('users.*', 'employees.gender', 'employees.company', 'employees.department_id', 'employees.position_id', 'employees.phone_number', 'employees.join_date')
                        ->where('employee_id','LIKE','%'.$request->employee_id.'%')
                        ->where('users.name','LIKE','%'.$request->name.'%')
                        ->get();
        }
        // search by position and id
        if($request->employee_id && $request->position)
        {
            $users = DB::table('users')
                        ->join('employees', 'users.employee_id', '=', 'employees.id')
                        ->select('users.*', 'employees.gender', 'employees.company', 'employees.department_id', 'employees.position_id', 'employees.phone_number', 'employees.join_date')
                        ->where('employee_id','LIKE','%'.$request->employee_id.'%')
                        ->where('users.position_id','LIKE','%'.$request->position.'%')
                        ->get();
        }
        // search by name and position
        if($request->name && $request->position)
        {
            $users = DB::table('users')
                        ->join('employees', 'users.employee_id', '=', 'employees.id')
                        ->select('users.*', 'employees.gender', 'employees.company', 'employees.department_id', 'employees.position_id', 'employees.phone_number', 'employees.join_date')
                        ->where('users.name','LIKE','%'.$request->name.'%')
                        ->where('users.position_id','LIKE','%'.$request->position.'%')
                        ->get();
        }
        // search by name and position and id
        if($request->employee_id && $request->name && $request->position)
        {
            $users = DB::table('users')
                        ->join('employees', 'users.employee_id', '=', 'employees.id')
                        ->select('users.*', 'employees.gender', 'employees.company', 'employees.department_id', 'employees.position_id', 'employees.phone_number', 'employees.join_date')
                        ->where('employee_id','LIKE','%'.$request->employee_id.'%')
                        ->where('users.name','LIKE','%'.$request->name.'%')
                        ->where('users.position_id','LIKE','%'.$request->position.'%')
                        ->get();
        }
        return view('form.employeelist',compact('users','userList','permission_lists'));
    }

    // employee profile
    public function profileEmployee($employee_id)
    {
        $users = DB::table('profile_information')
                ->join('users', 'users.employee_id', '=', 'profile_information.employee_id')
                ->select('profile_information.*', 'users.*')
                ->where('profile_information.employee_id','=',$employee_id)
                ->first();

        $user = DB::table('users')->where('employee_id',$employee_id)->get();
        return view('form.employeeprofile',compact('user','users'));
    }
}
