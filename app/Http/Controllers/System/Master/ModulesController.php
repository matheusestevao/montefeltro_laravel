<?php

namespace App\Http\Controllers\System\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ModuleRequest;
use App\Models\Module;
use App\Models\Permission;
use App\Models\PermissionRole;
use Illuminate\Support\Facades\Auth;

class ModulesController extends Controller
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
                "title"  => "Modules",
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
        $pageCurrent = "Modules";

        $modules = Module::all();

        return view('master.modules.index')
                ->with('modules', $modules)
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
            "title"  => "Add_Module",
            "url"    => '',
            "active" => "active"
        ];

        $pageCurrent = "Add_Module";

        return view('master.modules.add')
                ->with('listBreadcrumb', $this->breadcrumb)
                ->with('pageCurrent', $pageCurrent);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ModuleRequest $request)
    {

        $post = $request->all();

        $nameModule = replaceString($post['label']);

        $nameModule = str_replace(' ', '_', $nameModule);
        $nameModule = str_replace('-', '_', $nameModule);

        $form['label']       = ucfirst($post['label']);
        $form['name']        = strtolower($nameModule);
        $form['group']       = $post['group'];
        $form['menu_left']   = $post['menu_left'];
        $form['menu_master'] = $post['menu_master'];
        $form['page_index']  = $post['page_index'];
        $form['menu_icon']   = $post['menu_icon'];

        $module = Module::create($form);

        if ($module) {
            $permissionMenu = $this->savePermission($module, '_menu', 'Menu ');
            $this->savePermissionRole($permissionMenu, Auth::user()->id);

            $permissionList = $this->savePermission($module, '_list', 'List ');
            $this->savePermissionRole($permissionList, Auth::user()->id);

            $permissionAdd = $this->savePermission($module, '_add', 'Add ');
            $this->savePermissionRole($permissionAdd, Auth::user()->id);

            $permissionEdit = $this->savePermission($module, '_edit', 'Edit ');
            $this->savePermissionRole($permissionEdit, Auth::user()->id);

            $permissionView = $this->savePermission($module, '_view', 'View ');
            $this->savePermissionRole($permissionView, Auth::user()->id);

            $permissionDelete = $this->savePermission($module, '_delete', 'Delete ');
            $this->savePermissionRole($permissionDelete, Auth::user()->id);

            return redirect()
                    ->route('module.index')
                    ->with('success', trans('message.Module successfully registered.'));
        } else {
            return back()
                    ->withInputs()
                    ->with('error', trans('message.Error registering the Module. Please try again.'));
        }

    }

    public function savePermission(array $module,string $name,string $label)
    {
        $permission            = new Permission();
        $permission->name      = $module->name.$name;
        $permission->label     = $label.$module->label;
        $permission->module_id = $module->id;
        $permission->save();

        return $permission;
    }

    public function savePermissionRole(array $permission,int $user): void
    {
        $permissionRole                = new PermissionRole();
        $permissionRole->role_id       = $user;
        $permissionRole->permission_id = $permission->id;
        $permissionRole->save();
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
            "title"  => "Edit_Module",
            "url"    => '',
            "active" => "active"
        ];

        $pageCurrent = "Edit_Module";

        $module = Module::find($id);

        return view('master.modules.edit')
                ->with('module', $module)
                ->with('listBreadcrumb', $this->breadcrumb)
                ->with('pageCurrent', $pageCurrent);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ModuleRequest $request,int $id)
    {

        $post = $request->all();

        $nameModule = replaceString($post['label']);

        $nameModule = str_replace(' ', '_', $nameModule);
        $nameModule = str_replace('-', '_', $nameModule);

        $form['label'] = ucfirst($post['label']);
        $form['name']  = strtolower($nameModule);

        $module = Module::find($id);

        $this->updatePermission($module, $form, '_menu', 'Menu ');
        $this->updatePermission($module, $form, '_list', 'List ');
        $this->updatePermission($module, $form, '_add', 'Add ');
        $this->updatePermission($module, $form, '_edit', 'Edit ');
        $this->updatePermission($module, $form, '_view', 'View ');
        $this->updatePermission($module, $form, '_delete', 'Delete ');

        $module->name  = $form['name'];
        $module->label = $form['label'];
        $module->update();

        return redirect()
                ->route('module.index')
                ->with('success', trans('message.Module Updated Successfully.'));

    }

    public function updatePermission(array $module,array $form,string $name,string $label): void
    {
        $permission = Permission::where('name', $module->name.$name)->get()[0];
        $permission->name  = $form['name'].$name;
        $permission->label = $label.$form['label'];
        $permission->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,int $id): boolean
    {
        $isAdminMaster = $id == 1;

        if (!$isAdminMaster) {
            Permission::where('module_id', $id)->delete();

            $module = Module::where('id', $id);
            $module->delete();

            return 0;
        } else {
            return 1;
        }

    }
}
