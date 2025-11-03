<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\menu;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\File;

class MenuListController extends Controller
{
    public function menulist()
    {
        $menus = menu::all();
        return view('menulist', compact('menus'));
    }



    public function addmenu()
    {
        return view('addmenu');
    }


    public function menustore(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255|',
            'price' => 'required|numeric|min:1',
            'image' => 'required|nullable|image|mimes:jpg,jpeg,png|max:10240',
        ]);

        $filePath = null;

        if ($request->hasFile('image')) {
            $fileName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/menus'), $fileName);
            $filePath = 'uploads/menus/' . $fileName;
        }

         $exist = menu::where('name', $request->name)->first();
         if ($exist) {
               return redirect()->back()->with('error', 'This menu item already exists');
        }


        Menu::create([
            'name'  => $request->name,
            'price' => $request->price,
            'image' => $filePath,
        ]);

        return redirect()->route('menulist')->with('success', 'Menu added successfully!');
    }



    public function menuedit($id)
    {
        $menu = menu::find($id);
        return view('editmenu', compact('menu'));
    }



    public function menuupdate(Request $request, $id)
    {
        $menu = menu::find($id);

       $request->validate([
            'name'  => 'required|string|max:255|',
            'price' => 'required|numeric|min:1',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
        ]);

        $existingMenu = menu::where('name', $request->name)->where('id', '!=', $menu->id)->first();

        if ($existingMenu) {
        return redirect()->back()->with('error', 'This Item already exists');
    }

        $filePath = $menu->image;

        if ($request->hasFile('image')) {

            if ($menu->image && File::exists(public_path($menu->image))) {
                File::delete(public_path($menu->image));
            }

            $fileName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/menus'), $fileName);
            $filePath = 'uploads/menus/' . $fileName;
        }

        $menu->update([
            'name'  => $request->name,
            'price' => $request->price,
            'image' => $filePath,
        ]);

        return redirect()->route('menulist')->with('success', 'Menu updated successfully!');
    }



    public function delete($id)
    {
        $menu = Menu::find($id);

        if ($menu->image && File::exists(public_path($menu->image))) {
            File::delete(public_path($menu->image));
        }

        $menu->delete();

        return redirect()->route('menulist')->with('success', 'Menu deleted successfully!');
    }
}
