<?php

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        /*MODULE*/
        	Permission::create([
        		'name'      => 'module_menu',
                'label'     => 'Menu Module',
                'module_id' => 1
        	]);

        	Permission::create([
        		'name'      => 'module_list',
        		'label'     => 'List Module',
                'module_id' => 1
        	]);

        	Permission::create([
        		'name'      => 'module_add',
        		'label'     => 'Add Module',
                'module_id' => 1
        	]);

        	Permission::create([
        		'name'      => 'module_edit',
        		'label'     => 'Edit Module',
                'module_id' => 1
        	]);

        	Permission::create([
        		'name'      => 'module_view',
        		'label'     => 'View Module',
                'module_id' => 1
        	]);

        	Permission::create([
        		'name'      => 'module_delete',
        		'label'     => 'Delete Module',
                'module_id' => 1
        	]);
        /*END MODULE*/

        /*PERMISSION*/
            Permission::create([
                'name'      => 'permission_menu',
                'label'     => 'Menu Permission',
                'module_id' => 2
            ]);

            Permission::create([
                'name'      => 'permission_list',
                'label'     => 'List Permission',
                'module_id' => 2
            ]);

            Permission::create([
                'name'      => 'permission_add',
                'label'     => 'Add Permission',
                'module_id' => 2
            ]);

            Permission::create([
                'name'      => 'permission_edit',
                'label'     => 'Edit Permission',
                'module_id' => 2
            ]);

            Permission::create([
                'name'      => 'permission_view',
                'label'     => 'View Permission',
                'module_id' => 2
            ]);

            Permission::create([
                'name'      => 'permission_delete',
                'label'     => 'Delete Permission',
                'module_id' => 2
            ]);
        /*END - PERMISSION*/

        /*ROLES*/
            Permission::create([
                'name'      => 'role_menu',
                'label'     => 'Menu Role',
                'module_id' => 3
            ]);

            Permission::create([
                'name'      => 'role_list',
                'label'     => 'List Role',
                'module_id' => 3
            ]);

            Permission::create([
                'name'      => 'role_add',
                'label'     => 'Add Role',
                'module_id' => 3
            ]);

            Permission::create([
                'name'      => 'role_edit',
                'label'     => 'Edit Role',
                'module_id' => 3
            ]);

            Permission::create([
                'name'      => 'role_view',
                'label'     => 'View Role',
                'module_id' => 3
            ]);

            Permission::create([
                'name'      => 'role_delete',
                'label'     => 'Delete Role',
                'module_id' => 3
            ]);
        /*END - ROLES*/

        /*MY PROFILE*/
            Permission::create([
                'name'      => 'myprofile_menu',
                'label'     => 'Menu My Profile',
                'module_id' => 4
            ]);

            Permission::create([
                'name'      => 'myprofile_list',
                'label'     => 'List My Profile',
                'module_id' => 4
            ]);

            Permission::create([
                'name'      => 'myprofile_add',
                'label'     => 'Add My Profile',
                'module_id' => 4
            ]);

            Permission::create([
                'name'      => 'myprofile_edit',
                'label'     => 'Edit My Profile',
                'module_id' => 4
            ]);

            Permission::create([
                'name'      => 'myprofile_view',
                'label'     => 'View My Profile',
                'module_id' => 4
            ]);

            Permission::create([
                'name'      => 'myprofile_delete',
                'label'     => 'Delete My Profile',
                'module_id' => 4
            ]);
        /*END - MY PROFILE*/

        /*USERS*/
            Permission::create([
                'name'      => 'users_menu',
                'label'     => 'Menu Users',
                'module_id' => 5
            ]);

            Permission::create([
                'name'      => 'users_list',
                'label'     => 'List Users',
                'module_id' => 5
            ]);

            Permission::create([
                'name'      => 'users_add',
                'label'     => 'Add Users',
                'module_id' => 5
            ]);

            Permission::create([
                'name'      => 'users_edit',
                'label'     => 'Edit Users',
                'module_id' => 5
            ]);

            Permission::create([
                'name'      => 'users_view',
                'label'     => 'View Users',
                'module_id' => 5
            ]);

            Permission::create([
                'name'      => 'users_delete',
                'label'     => 'Delete Users',
                'module_id' => 5
            ]);
        /*END - USERS*/
    }
}
