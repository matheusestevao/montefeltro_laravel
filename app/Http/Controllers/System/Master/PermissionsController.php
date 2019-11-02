<?php

namespace App\Http\Controllers\System\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\PermissionRole;
use App\Models\User;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\Module;

class PermissionsController extends Controller
{
    protected $breadcrumb = array();

    public function __construct()
    {
        $this->breadcrumb = [
            [
                "title"  => "Dashboard",
                "url"    => route('home'),
                "active" => ""
            ],
            [
                "title"  => "Permissions",
                "url"    => '',
                "active" => "active"
            ]
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageCurrent = "Permissions";

        $roles = Role::all();

        return view('master.permissions.index')
                ->with('roles', $roles)
                ->with('listBreadcrumb', $this->breadcrumb)
                ->with('pageCurrent', $pageCurrent);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $forms   = $request->all();
        $roleId  = $forms['role_id'];
        $roleSon = isset($forms['role_son']) ? $forms['role_son'] : '';

        PermissionRole::where('role_id', $roleId)->delete();

        unset($forms['_token']);
        unset($forms['role_id']);
        unset($forms['role_son']);

        $countPermission = Permission::count();

        foreach ($forms as $key => $value) {

            $permission = explode('permission_', $key)[1];
            $permission = substr($permission, 0, strlen($countPermission));
            $permission = str_replace('_', '', $permission);
            $permission = trim($permission);

            $newPermissionRole                = new PermissionRole();
            $newPermissionRole->role_id       = $roleId;
            $newPermissionRole->permission_id = $permission;
            $newPermissionRole->save();

        }

        return redirect()
                    ->route('permission.index')
                    ->with('success', 'Permissions Successfully saved.'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {

        $this->breadcrumb[] = [
            "title"  => "Edit_Permissions",
            "url"    => '',
            "active" => 'active'
        ];

        $role            = Role::find($id);
        $permissions     = Permission::all();
        $permissionRoles = PermissionRole::where('role_id', $id)->get();
        $modules         = Module::all();
        $master          = Role::where('master_role', $id)->count();

        $pageCurrent = "Edit_Permissions";
        $nameCurrent = " - ".$role->label;

        return view('master.permissions.edit')
                 ->with('role', $role)
                 ->with('permissions', $permissions)
                 ->with('permissionRoles', $permissionRoles)
                 ->with('modules', $modules)
                 ->with('master', $master)
                 ->with('pageCurrent', $pageCurrent)
                 ->with('nameCurrent', $nameCurrent)
                 ->with('listBreadcrumb', $this->breadcrumb);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,int $id)
    {
        $isMasterAdmin = $id == 1;

        if (!$isMasterAdmin) {
            PermissionRole::where('role_id', $id)->delete();

            $role = Role::find($id);

            if ($role->master_role != '') {
                $role->master_role = null;
                $role->update();
            }

            return 0;
        } else {
            return 1;
        }

    }

}
