<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MenuListController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChefController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ChatbotController;
use App\Http\Middleware\CheckLogin;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminMailController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\CustomerMiddleware;
use App\Http\Middleware\ChefMiddleware;

Route::get('/template', function () {
    return view('template');
});

Route::get('/test', function () {
    return view('test');
});

Route::get('/', [LoginController::class, 'login'])->name('login');
Route::post('/logstore', [LoginController::class, 'logstore'])->name('logstore');
Route::get('/register', [LoginController::class, 'register'])->name('register');
Route::post('/regstore', [LoginController::class, 'regstore'])->name('regstore');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/forgot', [LoginController::class, 'forgotPassword'])->name('forgot');
Route::post('/forgot', [LoginController::class, 'sendResetLink'])->name('forgot.sendLink');
Route::get('/reset/{token}', [LoginController::class, 'showResetForm'])->name('forgot.showForm');
Route::post('/reset', [LoginController::class, 'updatePassword'])->name('forgot.updatePassword');

// Fixed middleware structure
Route::middleware([CheckLogin::class, CustomerMiddleware::class])->group(function () {
    Route::get('/home', [LoginController::class, 'home'])->name('home');
    Route::get('/about', [LoginController::class, 'about'])->name('about');
    Route::get('/contact', [ContactController::class, 'contact'])->name('contact');
    Route::post('/contact', [ContactController::class, 'sendMessage'])->name('contact.send');
    Route::post('/chatbot/message', [ChatbotController::class, 'message'])->name('message');
    Route::get('/cart', [CartController::class, 'cart'])->name('cart');
    Route::post('/add/{id}', [CartController::class, 'cartadd'])->name('cartadd');
    Route::post('/update', [CartController::class, 'cartupdate'])->name('cartupdate');
    Route::get('/remove/{id}', [CartController::class, 'cartremove'])->name('cartremove');
    Route::post('/cart/live-update', [CartController::class, 'liveUpdate'])->name('cart.liveUpdate');
    Route::get('/menu', [MenuController::class, 'menu'])->name('menu');
    Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
    Route::post('complete', [CheckoutController::class, 'complete'])->name('checkoutcomplete');
    Route::get('/track-orders', [OrderController::class, 'track'])->name('track.orders');
    Route::get('/track-orders/{id}', [OrderController::class, 'trackDetails'])->name('track.details');
    Route::get('/ourchefs', [ChefController::class, 'showChefs'])->name('user.chefs');
    Route::get('/menu/search', [MenuController::class, 'searchh'])->name('menu.search');
    Route::get('/customer/orders/fetch', [OrderController::class, 'fetchCustomerOrders'])->name('customer.fetchOrders');
    Route::get('/random-game', function () {
        return view('game');
    })->name('randomgame');
});

Route::middleware([CheckLogin::class, AdminMiddleware::class])->group(function () {
    Route::get('/menulist', [MenuListController::class, 'menulist'])->name('menulist');
    Route::get('/add', [MenuListController::class, 'addmenu'])->name('addmenu');
    Route::post('/store', [MenuListController::class, 'menustore'])->name('menustore');
    Route::get('/edit/{id}', [MenuListController::class, 'menuedit'])->name('menuedit');
    Route::post('/update/{id}', [MenuListController::class, 'menuupdate'])->name('menuupdate');
    Route::get('/delete/{id}', [MenuListController::class, 'delete'])->name('menudelete');
    Route::get('/admin', [AdminController::class, 'adminDashboard'])->name('admin');
    Route::get('/admin/regusers', [AdminController::class, 'regUsers'])->name('regusers');
    Route::delete('/admin/regusers/{id}', [AdminController::class, 'deleteUser'])->name('deleteUser');
    Route::get('/admin/messages', [AdminController::class, 'messages'])->name('messages');
    Route::delete('/admin/messages/{id}', [AdminController::class, 'delete'])->name('messages.delete');
    Route::get('/chart', [AdminController::class, 'chart'])->name('chart');
    Route::get('/admintemplate', [AdminController::class, 'admintemplate'])->name('admintemplate');
    Route::get('/admin/send-mail', [AdminMailController::class, 'showForm'])->name('admin.mail.form');
    Route::post('/admin/send-mail', [AdminMailController::class, 'sendMail'])->name('admin.mail.send');
    Route::get('/search', [MenuController::class, 'search'])->name('search');
    Route::get('/admin/orders', [OrderController::class, 'index'])->name('orders');
    Route::delete('deleteorder/{id}', [OrderController::class, 'deleteorder'])->name('deleteorder');
    Route::get('/cchefs', [ChefController::class, 'index'])->name('chefs');
    Route::get('/chefs/create', [ChefController::class, 'create'])->name('admin.chefs.create');
    Route::post('/chefs/store', [ChefController::class, 'store'])->name('admin.chefs.store');
    Route::get('/chefs/edit/{id}', [ChefController::class, 'edit'])->name('admin.chefs.edit');
    Route::post('/chefs/update/{id}', [ChefController::class, 'update'])->name('admin.chefs.update');
    Route::delete('/chefs/delete/{id}', [ChefController::class, 'destroy'])->name('admin.chefs.delete');
    Route::get('/chefs', [ChefController::class, 'adminIndex'])->name('admin.chefs.index');
});

Route::middleware([CheckLogin::class, ChefMiddleware::class])->group(function () {
    Route::get('/chef', [ChefController::class, 'chef'])->name('chef');
    Route::post('/chef/order/{id}/status', [ChefController::class, 'updateStatus']);
    Route::get('/chef/orders/json', [ChefController::class, 'fetchOrders'])->name('chef.fetchOrders');
    Route::get('chefmenu', [ChefController::class, 'chefmenu'])->name('chefmenu');
    Route::post('/admin/orders/{id}/update', [OrderController::class, 'updateStatus'])->name('orders.update');
    Route::get('/chef/todays-orders', [ChefController::class, 'fetchTodaysOrders'])->name('chef.fetchTodaysOrders');


});
