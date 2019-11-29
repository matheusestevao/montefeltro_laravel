<?php

namespace App\Http\Controllers\System\Master;

use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\PermissionRole;

class RolesController extends Controller
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
                "title"  => "Profiles",
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
        $pageCurrent = "Profiles";

        $roles = Role::all();

        return view('master.roles.index')
                ->with('roles', $roles)
                ->with('listBreadcrumb', $this->breadcrumb)
                ->with('pageCurrent', $pageCurrent);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->breadcrumb[] = [
            "title"  => "New_Profiles",
            "url"    => '',
            "active" => "active"
        ];

        $pageCurrent = "Add_Profiles";

        $rolesMaster = Role::all();

        return view('master.roles.add')
                    ->with('rolesMaster', $rolesMaster)
                    ->with('pageCurrent', $pageCurrent)
                    ->with('listBreadcrumb', $this->breadcrumb);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $post = $request->all();

        $nameRole = str_replace(' ', '_', $post['label']);
        $nameRole = str_replace('-', '_', $nameRole);

        $form['name']        = strtolower($nameRole);
        $form['label']       = ucfirst($post['label']);
        $form['master_role'] = $post['master_role'];

        $role = Role::create($form);

        if ($form['master_role'] != '' && $role) {
            $this->storePermissionRole($form['master_role'], $role->id);

            return redirect()->route('role.index')->with('success', 'Profile Successfully Saved.');
        } else if ($role) {
            return redirect()->route('role.index')->with('success', 'Profile Successfully Saved.');
        } else {
            return back()->withInputs()->with('error', 'Error registering the Profile. Please try again.');
        }
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
            "title"  => "Edit_Profiles",
            "url"    => '',
            "active" => "active"
        ];

        $pageCurrent = "Edit_Profiles";

        $role = Role::find($id);
        $roles = Role::all();

        return view('master.roles.edit')
                    ->with('role', $role)
                    ->with('roles', $roles)
                    ->with('pageCurrent', $pageCurrent)
                    ->with('listBreadcrumb', $this->breadcrumb);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request,int $id)
    {
        $post = $request->all();

        $form['name']        = strtolower($post['label']);
        $form['label']       = ucfirst($post['label']);
        $form['master_role'] = isset($post['master_role']) ? $post['master_role'] : null;

        $roleOld = Role::find($id);

        if (isset($post['master_role'])) {
            if ($roleOld->master_role != $post['master_role']) {
                $this->storePermissionRole($post['master_role'], $roleOld->id);
            }
        }

        $roleOld->update($form);

        return redirect()
                ->route('role.index')
                ->with('success', 'Profile Updated Successfully.');
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
            $role = Role::find($id)->delete();
            return 0;
        } else {
            return 1;
        }

    }

    public function storePermissionRole(int $masterRole,int $roleId): void
    {
        $masterPermission = PermissionRole::where('role_id', $masterRole)->get();

        foreach ($masterPermission as $copyPermission) {
            $permissionRole                = new PermissionRole();
            $permissionRole->permission_id = $copyPermission->permission_id;
            $permissionRole->role_id       = $roleId;
            $permissionRole->save();
        }

    }

}
