<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menus;

class HomeController extends Controller
{
    //
    public function index()
    {
        $menus = Menus::whereNull('parent_id')->orderBy('oder', 'DESC')->get();
        $allMenus = Menus::pluck('title', 'id')->orderBy('oder', 'DESC')->all();
        dd($menus,$allMenus);
        //return view('menu.menuTreeview', compact('menus', 'allMenus'));
    }

    public function show()
    {
        //$menus = Menus::whereNull('parent_id')->get();
        return view('admin.master');
    }
}
