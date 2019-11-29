<?php

namespace App\Http\Controllers\System;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;

class CategoriesController extends Controller
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
                "title"  => "Categories",
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
        $pageCurrent = "Categories";

        $categories = Category::all();

        return view('categories.index')
                ->with('categories', $categories)
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
         $pageCurrent = "New_Category";

        $this->breadcrumb[] = [
            "title"  => "New_Category",
            "url"    => '',
            "active" => "active"
        ];

        return view('categories.form')
                 ->with('listBreadcrumb', $this->breadcrumb)
                 ->with('pageCurrent', $pageCurrent);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $post = $request->all();

        $category = Category::create($post);

        if($category) {
            return redirect()
                    ->route('category.index')
                    ->with('success', 'Category Successful Registration.');
        } else {
            return redirect()
                    ->route('category.index')
                    ->with('error', 'Error registering Category. Please try again.')
                    ->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->breadcrumb[] = [
            "title"  => "Edit_Category",
            "url"    => '',
            "active" => "active"
        ];

        $pageCurrent = "Edit_Category";

        $category = Category::find($id);

        return view('categories.form')
                ->with('category', $category)
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

        $category = Category::find($id);
        $updateCategory = $category->update($post);

        if($updateCategory) {
            return redirect()
                    ->route('category.index')
                    ->with('success', 'Category Updated Successfully.');
        }else{
           return redirect()
                    ->route('category.index')
                    ->with('error', 'Error registering Category. Please try again.')
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
        $category = Category::find($id);
        $category->delete();

        if($category->trashed()) {
            return 0;
        }else{
            return 1;
        }
    }
}
