<?php

namespace App\Http\Controllers\System;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Client;
use App\Models\User;
use App\Http\Requests\ClientRequest;
use Illuminate\Support\Facades\Auth;

class ClientsController extends Controller
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
                "title"  => "Clients",
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
        $pageCurrent = "Clients";

        $clients = Client::all();

        return view('clients.index')
                ->with('clients', $clients)
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
        $pageCurrent = "New_Client";

        $this->breadcrumb[] = [
            "title"  => "New_Client",
            "url"    => '',
            "active" => "active"
        ];

        $externalSellers = $this->getSellers('external_seller');
        $internalSellers = $this->getSellers('internal_seller');

        return view('clients.form')
                 ->with('externalSellers', $externalSellers)
                 ->with('internalSellers', $internalSellers)
                 ->with('listBreadcrumb', $this->breadcrumb)
                 ->with('pageCurrent', $pageCurrent);

    }

    public function getSellers(string $typeSeller): object
    {
        $seller = DB::table('users')
                    ->join('role_user', 'users.id', 'role_user.user_id')
                    ->join('roles', 'role_user.role_id', 'roles.id')
                    ->select('users.name as name', 'users.id', 'roles.name as role')
                    ->where('roles.name', $typeSeller)
                    ->orderBy('users.name', 'asc')
                    ->get();

        return $seller;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientRequest $request)
    {
        $post = $request->all();

        $post['created_by']  = Auth::id();
        $post['external_id'] = $post['external_seller'] ?? $post['external_seller'];
        $post['internal_id'] = $post['internal_seller'] ?? $post['internal_seller'];

        $client = Client::create($post);

        if($client) {
            return redirect()
                    ->route('client.index')
                    ->with('success', 'Customer Successful Registration.');
        } else {
            return redirect()
                    ->route('client.index')
                    ->with('error', 'Error registering customer. Please try again.')
                    ->withInput();
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
            "title"  => "Edit_Client",
            "url"    => '',
            "active" => "active"
        ];

        $externalSellers = $this->getSellers('external_seller');
        $internalSellers = $this->getSellers('internal_seller');

        $pageCurrent = "Edit_Client";

        $client = Client::find($id);

        return view('clients.form')
                ->with('client', $client)
                ->with('externalSellers', $externalSellers)
                ->with('internalSellers', $internalSellers)
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
    public function update(ClientRequest $request,int $id)
    {
        $post = $request->all();

        $post['updated_by']  = Auth::id();
        $post['external_id'] = $post['external_seller'] ?? $post['external_seller'];
        $post['internal_id'] = $post['internal_seller'] ?? $post['internal_seller'];

        $client = Client::find(1);
        $updateClient = $client->update($post);

        if($updateClient) {
            return redirect()
                    ->route('client.index')
                    ->with('success', 'Client Updated Successfully.');
        }else{
           return redirect()
                    ->route('client.index')
                    ->with('error', 'Error registering customer. Please try again.')
                    ->withInput(); 
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id): int
    {
        $client = Client::find($id);
        $client->deleted_by = Auth::id();
        $client->update();
        $client->delete();

        if($client->trashed()) {
            return 0;
        }else{
            return 1;
        }
    }
}
