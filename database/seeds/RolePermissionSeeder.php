<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Create Role

        $roleSupperAdmin = Role::create(['name' => 'supper-admin']);
        $roleAdmin = Role::create(['name' => 'admin']);
        $roleEditor = Role::create(['name' => 'editor']);
        $roleUser = Role::create(['name' => 'user']);
        $rolePatient = Role::create(['name' => 'patient']);
        $roleDoctor = Role::create(['name' => 'doctor']);
        //Permission list as array
        $permissions = [
            //Admin permission
            [
                'group_id'=>'1',
                'permissions'=>[
                    'admin.view',
                    'admin.create',
                    'admin.edit',
                    'admin.delete',
                    'admin.approve',
                ]
            ],
            //Role permission
            [
                'group_id'=>'2',
                'permissions'=>[
                    'role-view',
                    'role-create',
                    'role-edit',
                    'role-delete',
                    'role-approve',
                ]
            ],
            //dashboard
            [
                'group_id'=>'3',
                'permissions'=>[
                    'dashboard.view',
                ]
            ],
            //Profile permission
            [
                'group_id'=>'4',
                'permissions'=>[
                    'profile.view',
                    'profile.edit',
                ]
            ],
            //blog permission
            [
                'group_id'=>'5',
                'permissions'=>[
                    'blog.view',
                    'blog.create',
                    'blog.edit',
                    'blog.delete',
                    'blog.approve',
                ]
            ],


        ];
        //Create and Assign Permissions

        for ($i=0; $i<count($permissions); $i++){

            $permissionGroup = $permissions[$i]['group_id'];

            for ($j=0; $j<count($permissions[$i]['permissions']); $j++){
                //create permission for supper-admin
                $permission = Permission::create(['name' => $permissions[$i]['permissions'][$j],'group_id'=>$permissionGroup]);
                $roleSupperAdmin->givePermissionTo($permission);
                $permission->assignRole($roleSupperAdmin);

                //creating permission for admin
                $roleAdmin->givePermissionTo($permission);
                $permission->assignRole($roleAdmin);
            }

        }
    }
}
