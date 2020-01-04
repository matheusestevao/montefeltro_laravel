<?php

namespace App\Http\Controllers\System;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class MenuController extends Controller
{

    public function systemMenu(int $idUser)
    {
        $isMasterAdmin = $idUser == 1;

        if ($isMasterAdmin) {
            $menu = DB::table('modules')
                        ->join('permissions', 'modules.id', 'permissions.module_id')
                        ->select('modules.*', 'permissions.name')
                        ->where('permissions.name', 'like', '%_menu')
                        ->where('modules.menu_left', '1')
                        ->orderBy('modules.group', 'asc')
                        ->orderBy('modules.name', 'asc')
                        ->get();
        } else {
            $menu = DB::table('modules')
                        ->join('permissions', 'modules.id', 'permissions.module_id')
                        ->select('modules.*', 'permissions.name')
                        ->where('permissions.name', 'like', '%_menu')
                        ->where('modules.menu_left', '1')
                        ->where('modules.menu_master', '<>', '1')
                        ->orderBy('modules.group', 'asc')
                        ->orderBy('modules.name', 'asc')
                        ->get();
        }
        
        return $menu;
    }

}
