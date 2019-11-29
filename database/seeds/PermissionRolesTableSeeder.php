<?php

use Illuminate\Database\Seeder;
use App\Models\PermissionRole;

class PermissionRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        /*MASTER PERFIL*/
            /*MODULE*/
            	PermissionRole::create([
                	'permission_id' => '1',
                	'role_id'		=> '1'
                ]);

                PermissionRole::create([
                	'permission_id' => '2',
                	'role_id'		=> '1'
                ]);

                PermissionRole::create([
                	'permission_id' => '3',
                	'role_id'		=> '1'
                ]);

                PermissionRole::create([
                	'permission_id' => '4',
                	'role_id'		=> '1'
                ]);

                PermissionRole::create([
                	'permission_id' => '5',
                	'role_id'		=> '1'
                ]);

                PermissionRole::create([
                	'permission_id' => '6',
                	'role_id'		=> '1'
                ]);
            /*END - MODULE*/

            /*PERMISSION*/
                PermissionRole::create([
                    'permission_id' => '7',
                    'role_id'       => '1'
                ]);

                PermissionRole::create([
                    'permission_id' => '8',
                    'role_id'       => '1'
                ]);

                PermissionRole::create([
                    'permission_id' => '9',
                    'role_id'       => '1'
                ]);

                PermissionRole::create([
                    'permission_id' => '10',
                    'role_id'       => '1'
                ]);

                PermissionRole::create([
                    'permission_id' => '11',
                    'role_id'       => '1'
                ]);

                PermissionRole::create([
                    'permission_id' => '12',
                    'role_id'       => '1'
                ]);
            /*END - PERMISSIONS*/

            /*ROLE*/
                PermissionRole::create([
                    'permission_id' => '13',
                    'role_id'       => '1'
                ]);

                PermissionRole::create([
                    'permission_id' => '14',
                    'role_id'       => '1'
                ]);

                PermissionRole::create([
                    'permission_id' => '15',
                    'role_id'       => '1'
                ]);

                PermissionRole::create([
                    'permission_id' => '16',
                    'role_id'       => '1'
                ]);

                PermissionRole::create([
                    'permission_id' => '17',
                    'role_id'       => '1'
                ]);

                PermissionRole::create([
                    'permission_id' => '18',
                    'role_id'       => '1'
                ]);
            /*END - ROLES*/

            /*MY PROFILE*/
                PermissionRole::create([
                    'permission_id' => '19',
                    'role_id'       => '1'
                ]);

                PermissionRole::create([
                    'permission_id' => '22',
                    'role_id'       => '1'
                ]);
            /*END - MY PROFILE*/

            /*USERS*/
                PermissionRole::create([
                    'permission_id' => '25',
                    'role_id'       => '1'
                ]);

                PermissionRole::create([
                    'permission_id' => '26',
                    'role_id'       => '1'
                ]);

                PermissionRole::create([
                    'permission_id' => '27',
                    'role_id'       => '1'
                ]);

                PermissionRole::create([
                    'permission_id' => '28',
                    'role_id'       => '1'
                ]);

                PermissionRole::create([
                    'permission_id' => '29',
                    'role_id'       => '1'
                ]);

                PermissionRole::create([
                    'permission_id' => '30',
                    'role_id'       => '1'
                ]);
            /*END - USERS*/
        /*END - MASTER ADMIN*/
        
        /*ADMIN*/
            /*USERS*/
                PermissionRole::create([
                    'permission_id' => '25',
                    'role_id'       => '2'
                ]);

                PermissionRole::create([
                    'permission_id' => '26',
                    'role_id'       => '2'
                ]);

                PermissionRole::create([
                    'permission_id' => '27',
                    'role_id'       => '2'
                ]);

                PermissionRole::create([
                    'permission_id' => '28',
                    'role_id'       => '2'
                ]);

                PermissionRole::create([
                    'permission_id' => '29',
                    'role_id'       => '2'
                ]);

                PermissionRole::create([
                    'permission_id' => '30',
                    'role_id'       => '2'
                ]);
            /*END - USERS*/

            /*MY PROFILE*/
                PermissionRole::create([
                    'permission_id' => '19',
                    'role_id'       => '2'
                ]);

                PermissionRole::create([
                    'permission_id' => '22',
                    'role_id'       => '2'
                ]);
            /*END - MY PROFILE*/
        /*END - ADMIN*/

        /*USERS*/
            /*MY PROFILE*/
                PermissionRole::create([
                    'permission_id' => '19',
                    'role_id'       => '3'
                ]);

                PermissionRole::create([
                    'permission_id' => '22',
                    'role_id'       => '3'
                ]);
            /*END - MY PROFILE*/
        /*END - USERS*/
    }
    
}
