<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $listBreadcrumb = [
            [
             "title"  => "Dashboard",
             "url"    => "",
             "active" => "active"],
        ];

        $pageCurrent = "Dashboard";

        return view('home')
                ->with('listBreadcrumb', $listBreadcrumb)
                ->with('pageCurrent', $pageCurrent);
    }

}
