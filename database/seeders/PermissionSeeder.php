<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $permissions = [
            'admin' => [
                [
                    'name' => 'admin_view',
                    'guard_name' => 'web'
                ],
                [
                    'name' => 'admin_create',
                    'guard_name' => 'web'
                ],
                [
                    'name' => 'admin_update',
                    'guard_name' => 'web'
                ],
                [
                    'name' => 'admin_delete',
                    'guard_name' => 'web'
                ]
            ],
            'student' => [
                [
                    'name' => 'student_view',
                    'guard_name' => 'web'
                ],
                [
                    'name' => 'student_create',
                    'guard_name' => 'web'
                ],
                [
                    'name' => 'student_update',
                    'guard_name' => 'web'
                ],
                [
                    'name' => 'student_delete',
                    'guard_name' => 'web'
                ]
            ],
            'teacher' => [
                [
                    'name' => 'teacher_view',
                    'guard_name' => 'web'
                ],
                [
                    'name' => 'teacher_create',
                    'guard_name' => 'web'
                ],
                [
                    'name' => 'teacher_update',
                    'guard_name' => 'web'
                ],
                [
                    'name' => 'teacher_delete',
                    'guard_name' => 'web'
                ]
            ],
            'courses' => [
                [
                    'name' => 'courses_view',
                    'guard_name' => 'web'
                ],
                [
                    'name' => 'courses_create',
                    'guard_name' => 'web'
                ],
                [
                    'name' => 'courses_update',
                    'guard_name' => 'web'
                ],
                [
                    'name' => 'courses_delete',
                    'guard_name' => 'web'
                ]
            ],
            'admission' => [
                [
                    'name' => 'admission_view',
                    'guard_name' => 'web'
                ],
                [
                    'name' => 'admission_create',
                    'guard_name' => 'web'
                ],
                [
                    'name' => 'admission_update',
                    'guard_name' => 'web'
                ],
                [
                    'name' => 'admission_delete',
                    'guard_name' => 'web'
                ]
            ],
            'enrollment' => [
                [
                    'name' => 'enrollment_view',
                    'guard_name' => 'web'
                ],
                [
                    'name' => 'enrollment_create',
                    'guard_name' => 'web'
                ],
                [
                    'name' => 'enrollment_update',
                    'guard_name' => 'web'
                ],
                [
                    'name' => 'enrollment_delete',
                    'guard_name' => 'web'
                ]
            ],
            'expenses' => [
                [
                    'name' => 'expenses_view',
                    'guard_name' => 'web'
                ],
                [
                    'name' => 'expenses_create',
                    'guard_name' => 'web'
                ],
                [
                    'name' => 'expenses_update',
                    'guard_name' => 'web'
                ],
                [
                    'name' => 'expenses_delete',
                    'guard_name' => 'web'
                ]
            ],
            'attendance' => [
                [
                    'name' => 'attendance_view',
                    'guard_name' => 'web'
                ],
                [
                    'name' => 'attendance_create',
                    'guard_name' => 'web'
                ],
                [
                    'name' => 'attendance_update',
                    'guard_name' => 'web'
                ],
                [
                    'name' => 'attendance_delete',
                    'guard_name' => 'web'
                ]
            ],
            'reports' => [
                [
                    'name' => 'reports_view',
                    'guard_name' => 'web'
                ],
                [
                    'name' => 'reports_create',
                    'guard_name' => 'web'
                ],
                [
                    'name' => 'reports_update',
                    'guard_name' => 'web'
                ],
                [
                    'name' => 'reports_delete',
                    'guard_name' => 'web'
                ]
            ],
            'inventory' => [
                [
                    'name' => 'inventory_view',
                    'guard_name' => 'web'
                ],
                [
                    'name' => 'inventory_create',
                    'guard_name' => 'web'
                ],
                [
                    'name' => 'inventory_update',
                    'guard_name' => 'web'
                ],
                [
                    'name' => 'inventory_delete',
                    'guard_name' => 'web'
                ]
            ],
            'users' => [
                [
                    'name' => 'users_view',
                    'guard_name' => 'web'
                ],
                [
                    'name' => 'users_create',
                    'guard_name' => 'web'
                ],
                [
                    'name' => 'users_update',
                    'guard_name' => 'web'
                ],
                [
                    'name' => 'users_delete',
                    'guard_name' => 'web'
                ]
            ],
            'roles' => [
                [
                    'name' => 'roles_view',
                    'guard_name' => 'web'
                ],
                [
                    'name' => 'roles_create',
                    'guard_name' => 'web'
                ],
                [
                    'name' => 'roles_update',
                    'guard_name' => 'web'
                ],
                [
                    'name' => 'roles_delete',
                    'guard_name' => 'web'
                ]
            ],
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
