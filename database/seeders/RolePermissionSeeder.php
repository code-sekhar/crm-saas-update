<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = Role::findByName('Super Admin');

        $superAdmin->givePermissionTo([
            'view dashboard',
            'create lead',
            'view lead',
            'edit lead',
            'delete lead',
            'create task',
            'view task',
            'edit task',
            'delete task',
            'manage users',
            'manage roles',
            'manage settings'
        ]);

        $owner = Role::findByName('Owner');

        $owner->givePermissionTo([
            'view dashboard',
            'create lead',
            'view lead',
            'edit lead',
            'delete lead',
            'create task',
            'view task',
            'edit task',
            'delete task',
            'manage users'
        ]);

        $manager = Role::findByName('Manager');

        $manager->givePermissionTo([
            'view dashboard',
            'create lead',
            'view lead',
            'edit lead',
            'create task',
            'view task',
            'edit task'
        ]);

        $salesAgent = Role::findByName('Sales Agent');

        $salesAgent->givePermissionTo([
            'view dashboard',
            'view lead',
            'create task',
            'view task'
        ]);
    }
}
