<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
    	User::create([
        	'name'     => 'Master Admin',
        	'email'    => 'masteradmin@masteradmin.com',
        	'password' => bcrypt('123456')
        ]);

        User::create([
            'name'     => 'Admin',
            'email'    => 'admin@admin.com',
            'password' => bcrypt('123456')
        ]);

        User::create([
            'name'     => 'User',
            'email'    => 'user@user.com',
            'password' => bcrypt('123456')
        ]);

    }
}
