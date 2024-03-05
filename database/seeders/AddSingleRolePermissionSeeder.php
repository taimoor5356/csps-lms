<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class AddSingleRolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //
        $permissions = [
            'lecture_schedule' => [
                [
                    'name' => 'lecture_schedule_view',
                    'guard_name' => 'web'
                ],
                [
                    'name' => 'lecture_schedule_create',
                    'guard_name' => 'web'
                ],
                [
                    'name' => 'lecture_schedule_update',
                    'guard_name' => 'web'
                ],
                [
                    'name' => 'lecture_schedule_delete',
                    'guard_name' => 'web'
                ]
            ]
        ];
        foreach ($permissions as $key => $module) {
            foreach ($module as $pkey => $permission) {
                if (!Permission::where('name', $permission['name'])->exists()) {
                    $createPermission = Permission::create([
                        'name' => $permission['name'],
                        'module' => $key,
                        'guard_name' => 'web'
                    ]);
                }
            }
        }
    }
}
