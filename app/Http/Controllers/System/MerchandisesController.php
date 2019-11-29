<?php

namespace App\Http\Controllers\System;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Merchandise;
use App\Models\Category;
use App\Models\User;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;

class MerchandisesController extends Controller
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
                "title"  => "Merchandises",
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
        $pageCurrent = "Merchandises";

        $merchandises = Merchandise::all();

        return view('merchandises.index')
                ->with('merchandises', $merchandises)
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
        $pageCurrent = "Input_Merchandise";

        $this->breadcrumb[] = [
            "title"  => "Input_Merchandise",
            "url"    => '',
            "active" => "active"
        ];

        $users = User::where('id', '<>', 1)->get();
        $categories = Category::all();
        $clients = Client::all();

        return view('merchandises.add')
                 ->with('listBreadcrumb', $this->breadcrumb)
                 ->with('users', $users)
                 ->with('clients', $clients)
                 ->with('categories', $categories)
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
        $post = $request->all();

        unset($post['insertMechandise_idComponent']['X']);
    
        $save = array();

        foreach ($post['insertMechandise_idComponent'] as $key => $value) {

            $save = $this->getColumDatabase($post, $key);

            $merchandise = Merchandise::create($save);

            if(!$merchandise) {
                $saveError = array();
                $saveError += $post['insertMechandise_service_order'][$key];
            }
        }

        return redirect()
                    ->route('merchandise.index')
                    ->with('success', 'Merchandise(s) successfully registered.'); 

    }

    public function getColumDatabase(array $post,int $key = null): array
    {
        $save = array();

        if(is_null($key)) {
            $save = [
                'service_order'   => $post['insertMechandise_service_order'],
                'client_id'       => $post['insertMechandise_client'],
                'category_id'     => $post['insertMechandise_category'],
                'input'           => $post['insertMechandise_input'],
                'output'          => $post['insertMechandise_output'],
                'withdrawn_by'    => $post['insertMechandise_withdrawn'],
                'note'            => $post['insertMechandise_note'],
                'amount'          => $post['insertMechandise_amount'],
                'created_by'      => Auth::id()
            ];
        } else {

            $save = [
                'service_order'   => $post['insertMechandise_service_order'][$key],
                'client_id'       => $post['insertMechandise_client'][$key],
                'category_id'     => $post['insertMechandise_category'][$key],
                'input'           => $post['insertMechandise_input'][$key],
                'output'          => $post['insertMechandise_output'][$key],
                'withdrawn_by'    => $post['insertMechandise_withdrawn'][$key],
                'note'            => $post['insertMechandise_note'][$key],
                'amount'          => $post['insertMechandise_amount'][$key],
                'created_by'      => Auth::id()
            ];
        }

        return $save;
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
    public function edit(int $id)
    {
        $this->breadcrumb[] = [
            "title"  => "Output_Merchandise",
            "url"    => '',
            "active" => "active"
        ];

        $pageCurrent = "Output_Merchandise";

        $clients = Client::all();
        $merchandise = Merchandise::find($id);
        $users = User::where('id', '<>', 1)->get();
        $categories = Category::all();

        return view('merchandises.edit')
                ->with('clients', $clients)
                ->with('merchandise', $merchandise)
                ->with('users', $users)
                ->with('categories', $categories)
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
    public function update(Request $request,int $id)
    {
        $post = $request->all();

        $update = $this->getColumDatabase($post);

        $merchandise = Merchandise::find($id);
        $updateMerchandise = $merchandise->update($update);

        if($updateMerchandise) {
            return redirect()
                    ->route('merchandise.index')
                    ->with('success', 'Merchandise Updated Successfully.');
        }else{
           return redirect()
                    ->route('merchandise.edit')
                    ->with('error', 'Error registering Merchandise. Please try again.')
                    ->withInput(); 
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $merchandise = Merchandise::find($id);
        $merchandise->deleted_by = Auth::id();
        $merchandise->update();
        $merchandise->delete();

        if($merchandise->trashed()) {
            return 0;
        }else{
            return 1;
        }
    }
}
