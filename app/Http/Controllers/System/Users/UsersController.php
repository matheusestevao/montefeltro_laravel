<?php

namespace App\Http\Controllers\System\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\RoleUser;
use App\Http\Requests\MyProfileRequest;
use App\Http\Requests\UserRequest;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $listBreadcrumb = [
            [
             "title"  => "Dashboard", 
             "url"    => route('home'),
             "active" => ""
            ],
            [
             "title"  => "Users", 
             "url"    => '',
             "active" => "active"
            ],
        ];      

        $users = User::where('id', '<>', 1)->get();        

        $pageCurrent = "Users";


        return view('users.index')
                ->with('users', $users)
                ->with('listBreadcrumb', $listBreadcrumb)
                ->with('pageCurrent', $pageCurrent);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $listBreadcrumb = [
            [
             "title"  => "Dashboard", 
             "url"    => route('home'),
             "active" => ""
            ],
            [
             "title"  => "Users", 
             "url"    => route('user.index'),
             "active" => ""  
            ],
            [
             "title"  => "New_User", 
             "url"    => '',
             "active" => "active"
            ],
        ];      

        $roles = Role::where('id', '<>', 1)->get();    

        $pageCurrent = "New_User";

        return view('users.add')
                ->with('roles', $roles)
                ->with('listBreadcrumb', $listBreadcrumb)
                ->with('pageCurrent', $pageCurrent);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        
        $post = $request->all();
        $post['password'] = bcrypt($post['password']);

        $user = new User();
        $user->name     = $post['name'];
        $user->password = $post['password'];
        $user->email    = $post['email'];
        $user->save();

        if ($user) {

            $roleUser = new RoleUser();
            $roleUser->role_id = $post['role'];
            $roleUser->user_id = $user->id;
            $roleUser->save();

            if ($roleUser) {

                return redirect()
                            ->route('user.index')
                            ->with('success', 'Usuário cadastrado com Sucesso.');

            } else {

                return redirect()
                            ->route('user.index')
                            ->with('error', 'Erro ao vincular o perfil ao usuário. Favor contate o desenvolvedor.');

            }

        } else {

            return redirect()
                        ->route('user.index')
                        ->with('error', 'Erro ao salvar o usuário. Favor, tente novamente.')
                        ->withInput();

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $listBreadcrumb = [
            [
             "title"  => "Dashboard", 
             "url"    => route('home'),
             "active" => ""
            ],
            [
             "title"  => "Users", 
             "url"    => route('user.index'),
             "active" => ""  
            ],
            [
             "title"  => "Edit_User", 
             "url"    => '',
             "active" => "active"
            ],
        ];      

        $user  = User::find($id);
        $roles = Role::where('id', '<>', 1)->get();    

        $pageCurrent = "Edit_User";
        $nameCurrent = " - ".$user->name;

        return view('users.edit')
                ->with('user', $user)
                ->with('roles', $roles)
                ->with('listBreadcrumb', $listBreadcrumb)
                ->with('nameCurrent', $nameCurrent)
                ->with('pageCurrent', $pageCurrent);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $validatedData = $request->validate([
            'name'         => 'required',
            'email'        => 'required|email|unique:users,email,'.$id,
            'role'         => 'required',
            'password'     => 'confirmed'
        ]);

        $post = $request->all();
        $user = User::find($id);

        if ($post['password'] != '') {

            $post['password'] = bcrypt($post['password']);

        } else {

            $post['password'] = $user->password;

        }

        $user->name     = $post['name'];
        $user->password = $post['password'];
        $user->email    = $post['email'];
        $user->update();

        $roleUser = RoleUser::where('user_id', $id)->get()[0];

        if ($roleUser->role_id != $post['role']) {

            $delRoleUser = RoleUser::where('user_id', $id)->delete();
            
            $roleUser          = new RoleUser();
            $roleUser->role_id = $post['role'];
            $roleUser->user_id = $id;
            $roleUser->save();

            if ($roleUser) {

                return redirect()
                            ->route('user.index')
                            ->with('success', 'Usuário atualizado com Sucesso.');

            } else {

                return redirect()
                            ->route('user.index')
                            ->with('error', 'Erro ao vincular o perfil ao usuário. Favor contate o desenvolvedor.');

            }

        } else {

            return redirect()
                        ->route('user.index')
                        ->with('success', 'Usuário atualizado com Sucesso.');

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        
        $user     = User::find($id)->delete();
        $roleUser = RoleUser::where('user_id', $id)->delete();

        return redirect()
                    ->route('user.index')
                    ->with('success', 'Usuário deletado com Sucesso.'); 

    }

    public function myProfile($id)
    {

        $listBreadcrumb = [
            [
             "title"  => "Dashboard", 
             "url"    => route('home'),
             "active" => ""
            ],
            [
             "title"  => "My_Profile", 
             "url"    => '',
             "active" => "active"
            ],
        ];      

        $user = User::find($id);        

        $pageCurrent = "My_Profile";

        return view('users.myProfile')
                ->with('user', $user)
                ->with('listBreadcrumb', $listBreadcrumb)
                ->with('pageCurrent', $pageCurrent);

    }

    public function myProfileUpdate(MyProfileRequest $request, $id)
    {

        $nameFile = null;
        $post     = $request->all();
        $user     = User::find($id);

        if ($post['password'] != '') {

            $post['password'] = bcrypt($post['password']);

        } else {

            $post['password'] = $user->password;

        }

        if ($request->hasFile('image_perfil') && $request->file('image_perfil')->isValid()) {

            $name      = 'image_profile_'.$user->id;
            $extension = $request->image_perfil->extension(); 

            $nameFile = "{$name}.{$extension}";

            $upload = $request->image_perfil->storeAs('MyProfile', $nameFile);

            if (!$upload) {

                return redirect()
                        ->back()
                        ->with('error', 'Falha ao fazer upload da imagem.')
                        ->withInput();

            }

        }

        $user->name           = $post['name']; 
        $user->password       = $post['password'];
        $user->image_profile  = $nameFile;
        $user->email          = $post['email'];
        $user->update();

        return redirect()
                    ->route('profile.myProfile', $id)
                    ->with('success', 'Perfil Atualizado com Sucesso.');

    }

}
