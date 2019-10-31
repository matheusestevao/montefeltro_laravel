<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
    	Role::create([
        	'name'  => 'master_admin',
        	'label' => 'Master Admin'
        ]);

        Role::create([
            'name'  => 'admin',
            'label' => 'Admin'
        ]);

        Role::create([
        	'name'  => 'user',
        	'label' => 'User'
        ]);

    }
}
