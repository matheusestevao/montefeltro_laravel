<?php

use Illuminate\Database\Seeder;
use App\Models\Module;

class ModulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Module::create([
        	'name'  => 'modules',
            'label' => 'Modules',
            'group' => 'System_Settings',
            'menu_icon' => 'fas fa-cogs',
            'page_index' => 'module.index',
            'menu_left' => '1',
            'menu_master' => '1'
        ]);

        Module::create([
        	'name'  => 'permission',
        	'label' => 'Permissions',
            'group' => 'System_Settings',
            'menu_icon' => 'fas fa-user-lock',
            'page_index' => 'permission.index',
            'menu_left' => '1',
            'menu_master' => '1'
        ]);

        Module::create([
        	'name'  => 'roles',
        	'label' => 'Profiles',
            'group' => 'System_Settings',
            'menu_icon' => 'fas fa-users',
            'page_index' => 'role.index',
            'menu_left' => '1',
            'menu_master' => '1'
        ]);

        Module::create([
            'name'  => 'my_profile',
            'label' => 'My Profile',
            'menu_icon' => 'fa fa-user',
            'page_index' => 'profile.myProfile',
            'menu_left' => '0',
            'menu_master' => '0'
        ]);

        Module::create([
            'name'  => 'users',
            'label' => 'Users',
            'group' => 'General',
            'menu_icon' => 'fas fa-users',
            'page_index' => 'user.index',
            'menu_left' => '1',
            'menu_master' => '0'
        ]);

    }
}
