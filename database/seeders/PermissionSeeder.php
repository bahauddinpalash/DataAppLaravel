<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'client-list',
            'client-create',
            'client-edit',
            'client-delete',
            'bdm-lead-list',
            'bdm-lead-create',
            'bdm-lead-edit',
            'bdm-lead-delete',
            'candidate-list',
            'candidate-create',
            'candidate-edit',
            'candidate-delete',
            'recruit-lead-list',
            'recruit-lead-create',
            'recruit-lead-edit',
            'recruit-lead-delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission,
                'guard_name' => 'admin' // This will set the guard name to 'admin'
            ]);
        }
    }
}
