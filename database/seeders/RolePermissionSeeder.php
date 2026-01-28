<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolePermissionSeeder extends Seeder
{
    // public function run()
    // {
    //     // Permissions
    //     $permissions = [
    //         'employee.view',
    //         'employee.create',
    //         'employee.update',
    //         'employee.delete',
    //         'attendance.manage',
    //         'leave.approve',
    //         'payroll.manage',
    //     ];

    //     foreach ($permissions as $permission) {
    //         Permission::firstOrCreate(['name' => $permission]);
    //     }

    //     // Roles
    //     $superAdmin = Role::firstOrCreate(['name' => 'Super Admin']);
    //     $admin = Role::firstOrCreate(['name' => 'Admin']);
    //     $hr = Role::firstOrCreate(['name' => 'HR']);
    //     $employee = Role::firstOrCreate(['name' => 'Employee']);

    //     // Assign permissions
    //     $superAdmin->givePermissionTo(Permission::all());

    //     $admin->givePermissionTo([
    //         'employee.view',
    //         'employee.create',
    //         'employee.update',
    //         'attendance.manage',
    //         'leave.approve',
    //         'payroll.manage',
    //     ]);

    //     $hr->givePermissionTo([
    //         'employee.view',
    //         'employee.create',
    //         'employee.update',
    //         'attendance.manage',
    //         'leave.approve',
    //         'payroll.manage',
    //     ]);

    //     $employee->givePermissionTo([
    //         'employee.view',
    //     ]);
    // }

    public function run()
    {
        // 1️⃣ Define permissions
        $permissions = [
            'employee.view',
            'employee.create',
            'employee.update',
            'employee.delete',
            'attendance.manage',
            'leave.approve',
            'payroll.manage',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // 2️⃣ Define roles
        $roles = [
            'Super Admin' => Permission::all(),
            'Admin' => [
                'employee.view',
                'employee.create',
                'employee.update',
                'attendance.manage',
                'leave.approve',
                'payroll.manage',
            ],
            'HR' => [
                'employee.view',
                'employee.create',
                'employee.update',
                'attendance.manage',
                'leave.approve',
                'payroll.manage',
            ],
            'Employee' => ['employee.view'],
        ];

        // 3️⃣ Create roles and assign permissions
        foreach ($roles as $roleName => $rolePermissions) {
            $role = Role::firstOrCreate(['name' => $roleName]);

            // Assign permissions to role
            $role->syncPermissions($rolePermissions);
        }
    }
}
