<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\menu;

class MenuController extends Controller
{

    public function menu() {
    $menus = menu::all();
    return view('menu', compact('menus'));
}



    public function searchh(Request $request)
{
    $query = $request->input('query');
    $menus = Menu::where('name', 'like', "%{$query}%")->get();
    return view('menu', compact('menus'));
}


    public function search(Request $request)
{
    $query = $request->input('query');

    if ($query) {
        $menus = Menu::where('name', 'like', "%{$query}%")->get();
    } else {
        $menus = Menu::all();
    }

    return view('search', compact('menus'));
}
}


