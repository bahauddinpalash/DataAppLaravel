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
            'client-list',
            'client-create',
            'client-edit',
            'client-delete',
            'bdm-data-list',
            'bdm-data-create',
            'bdm-data-edit',
            'bdm-data-delete',
            'candidate-list',
            'candidate-create',
            'candidate-edit',
            'candidate-delete',
            'recruiter-data-list',
            'recruiter-data-create',
            'recruiter-data-edit',
            'recruiter-data-delete',
            'admin-list',
            'admin-create',
            'admin-edit',
            'admin-delete',
            'bdm-list',
            'bdm-create',
            'bdm-edit',
            'bdm-delete',
            'recruiter-list',
            'recruiter-create',
            'recruiter-edit',
            'recruiter-delete',
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission,
                'guard_name' => 'admin' // This will set the guard name to 'admin'
            ]);
        }
    }
}
