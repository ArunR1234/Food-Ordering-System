<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Chef;
use Carbon\Carbon;

class ChefController extends Controller
{
    public function chef()
    {

        $orders = Order::with(['user', 'items.menu'])->latest()->get();
        $readyOrders = Order::where('status', 'ready')->count();
        $totalorders = order::count();
        $today = Carbon::today();
        $todaysOrders = Order::whereDate('created_at', $today)->count();

        return view('chef', compact('orders','readyOrders', 'totalorders', 'todaysOrders'));
    }

   public function updateStatus(Request $request, $id)
{
    $order = Order::find($id);
    $order->status = $request->status;
    $order->save();

    return response()->json(['success' => true]);
}


   public function orderupdate()
{
    return back()->with('success', 'Orders updated successfully');
}

public function fetchOrders()
{
    $orders = Order::with(['user', 'items.menu'])->orderBy('created_at', 'desc')->get();

    return response()->json($orders);
}


public function index()
    {
        $chefs = Chef::all();
        return view('chefs', compact('chefs'));
    }


public function adminIndex()
{
    $chefs = Chef::all();
    return view('chefs', compact('chefs'));

}

public function create()
{
    return view('create');
}

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'role' => 'required',
            'image' => 'required|nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

         $exist = chef::where('name', $request->name)->first();
         if ($exist) {
               return redirect()->back()->with('error', 'The chef already exists');
        }

        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/chefs'), $imageName);
        }

        Chef::create([
            'name' => $request->name,
            'role' => $request->role,
            'image' => $imageName,
        ]);

        return redirect()->route('admin.chefs.index')->with('success', 'Chef added successfully!');
    }

public function edit($id)
{
    $chef = Chef::find($id);
    return view('edit', compact('chef'));
}

    public function update(Request $request, $id)
    {
        $chef = Chef::find($id);

        $request->validate([
            'name' => 'required',
            'role' => 'required',
            'image' => 'required|nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

         $existingMenu = chef::where('name', $request->name)->where('id', '!=', $chef->id)->first();

        if ($existingMenu) {
        return redirect()->back()->with('error', 'The chef already exists');
    }

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/chefs'), $imageName);
            $chef->image = $imageName;
        }

        $chef->update([
            'name' => $request->name,
            'role' => $request->role,
            'image' => $chef->image,
        ]);

        return redirect()->route('admin.chefs.index')->with('success', 'Chef updated successfully!');
    }

    public function destroy($id)
    {
        $chef = Chef::find($id);
        if ($chef->image && file_exists(public_path('images/chefs/' . $chef->image))) {
            unlink(public_path('images/chefs/' . $chef->image));
        }
        $chef->delete();
        return redirect()->route('admin.chefs.index')->with('success', 'Chef deleted successfully!');
    }


    public function showChefs()
    {
        $chefs = Chef::all();
        return view('ourchef', compact('chefs'));
}

public function chefmenu(Request $request)
{
    $query = $request->input('query');

    $menus = \App\Models\Menu::when($query, function ($q) use ($query) {
        $q->where('name', 'like', "%{$query}%");
    })->get();

    return view('chefmenu', compact('menus'));
}

public function fetchTodaysOrders()
{
    $today = Carbon::today();
    $todaysOrders = Order::whereDate('created_at', $today)->count();

    return response()->json(['success' => true, 'todaysOrders' => $todaysOrders]);
}




}
