<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Permissions
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

        // Roles
        $admin = Role::firstOrCreate(['name' => 'Admin']);
        $hr = Role::firstOrCreate(['name' => 'HR']);
        $employee = Role::firstOrCreate(['name' => 'Employee']);

        // Assign permissions
        $admin->givePermissionTo(Permission::all());
        $hr->givePermissionTo([
            'employee.view',
            'employee.create',
            'employee.update',
            'attendance.manage',
            'leave.approve',
        ]);
    }
}
