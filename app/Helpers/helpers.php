<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Models\Permission;
use App\Models\PermissionRole;
use App\Models\User;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\Module;

function trackables($table)
{

	$table->unsignedBigInteger('created_by')->nullable();
	$table->foreign('created_by')->references('id')->on('users');

	$table->unsignedBigInteger('updated_by')->nullable();
	$table->foreign('updated_by')->references('id')->on('users');

	$table->unsignedBigInteger('deleted_by')->nullable();
	$table->foreign('deleted_by')->references('id')->on('users');

}

function modulePermissions ($idModule)
{

	$modulePermissions = DB::table('permissions')
							->join('modules', 'permissions.module_id', '=', 'modules.id')
							->select('modules.*', 'permissions.*')
							->where('permissions.module_id', $idModule)
							->get();

	return $modulePermissions;

}

function permissionModuleRole($idRole, $idPermission)
{

	$permissionRole = PermissionRole::where('role_id', $idRole)
										->where('permission_id', $idPermission)
										->get();

	if (count($permissionRole) > 0) {

		return 1;

	} else {

		return 0;

	}

}

function replaceString($string)
{

	$newString = preg_replace( '/[`^~\'"]/', null, iconv( 'UTF-8', 'ASCII//TRANSLIT', $string ) );

	return $newString;

}
