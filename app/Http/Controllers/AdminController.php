<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ContactMessage;
use App\Models\Chef;
use Carbon\Carbon;
use DB;

class AdminController extends Controller
{

    public function adminDashboard()
    {
        $totalUsers = Users::count();
        $totalMenuItems = Menu::count();
        $today = Carbon::today();
        $todaysOrders = Order::whereDate('created_at', $today)->count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $activeChefs = Users::where('role', 'chef')->count();
        $activecustomer = Users::where('role', 'customer')->count();
        $activeadmin = Users::where('role', 'admin')->count();
        $totalorders = order::count();
        $totalmessages = ContactMessage::count();
        $ourchef = Chef::count();
        $readyOrders = Order::where('status', 'ready')->count();
        $preparingOrders = Order::where('status', 'preparing')->count();

        return view('admin', compact('totalUsers','totalMenuItems','todaysOrders','pendingOrders','readyOrders','preparingOrders','activeChefs','totalorders','activecustomer','activeadmin','totalmessages','ourchef'));
    }


    public function regUsers()
    {
        $users = Users::all();
        return view('reguser', compact('users'));
    }

    public function deleteUser($id)
    {
        Users::findOrFail($id)->delete();
        return back()->with('success', 'User deleted successfully');
    }

    public function messages()
{
    $messages = ContactMessage::latest()->get();
    return view('message', compact('messages'));
}

   public function delete($id)
{
    $message = ContactMessage::findOrFail($id);
    $message->delete();

    return redirect()->route('messages')->with('success', 'Message deleted successfully!');
}

    public function chart()
{


     $order = Order::select(
                DB::raw("COUNT(*) as count"),
                DB::raw("DATE(created_at) as day")
            )
            ->whereMonth("created_at", date("m"))
            ->groupBy(DB::raw("DATE(created_at)"))
            ->orderBy("day")
            ->pluck("count", "day")
            ->toArray();

    return view('chart',compact('order'));
}



  public function admintemplate()
{
    $user = users::all();
    return view('admintemplate', compact('user'));
}



}
