<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'manage users',
            'manage products',
            'manage services',
            'manage appointments',
            'view reports',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        $admin = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $vet = Role::firstOrCreate(['name' => 'vet', 'guard_name' => 'web']);
        $customer = Role::firstOrCreate(['name' => 'customer', 'guard_name' => 'web']);

        $admin->syncPermissions(Permission::all());

        $vet->syncPermissions([
            'manage appointments',
        ]);

        $customer->syncPermissions([
            'manage appointments',
        ]);
    }
}
