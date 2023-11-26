<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

route::get('/',[HomeController::class,'index']);

route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/redirect', [HomeController::class, 'redirect'])->name('redirect');

route::get('/view_category',[AdminController::class,'view_category'])->name('view_category');

route::post('/add_category',[AdminController::class,'add_category'])->name('add_category');

route::get('/delete_category/{id}',[AdminController::class,'delete_category']);

route::get('/view_product',[AdminController::class,'view_product'])->name('view_product');

route::post('/add_product',[AdminController::class,'add_product'])->name('add_product');

route::get('/show_product',[AdminController::class,'show_product'])->name('show_product');

route::get('/delete_product/{id}',[AdminController::class,'delete_product']);

route::get('/update_product/{id}',[AdminController::class,'update_product']);

route::post('/update_product_confirm/{id}',[AdminController::class,'update_product_confirm']);

route::get('/order',[AdminController::class,'order'])->name('order');

Route::get('/cart', [AdminController::class, 'cart'])->name('cart');

Route::get('/cart/accept/{orderId}', [AdminController::class, 'acceptOrder'])->name('cart.accept');

route::get('/delivered/{created_at}/{user_id}', [AdminController::class, 'delivered']);

route::get('/print_pdf/{id}',[AdminController::class,'print_pdf']);

route::get('/search',[AdminController::class,'searchdata']);



route::get('/product_details/{id}',[HomeController::class,'product_details']);

route::post('/add_cart/{id}',[HomeController::class,'add_cart']);

route::get('/show_cart',[HomeController::class,'show_cart']);

route::get('/remove_cart/{id}',[HomeController::class,'remove_cart']);

route::post('/update_cart/{id}', [HomeController::class, 'update_cart'])->name('update_cart');

route::get('/cash_order', [HomeController::class, 'cash_order']);

route::get('/cash_order/{totalproduct}',[HomeController::class,'cash_order']);

route::get('/show_order', [HomeController::class, 'show_order']);

route::get('/cancel_order/{id}',[HomeController::class,'cancel_order']);

route::get('/product_search', [HomeController::class, 'product_search']);

route::get('/products', [HomeController::class, 'product']);

route::get('/products1', [HomeController::class, 'product1']);

route::get('/category_bahankue', [HomeController::class, 'category_bahankue']);

route::get('/category_bahankue1', [HomeController::class, 'category_bahankue1']);

route::get('/category_bumbudapur', [HomeController::class, 'category_bumbudapur']);

route::get('/category_bumbudapur1', [HomeController::class, 'category_bumbudapur1']);

route::get('/category_peralatandapur', [HomeController::class, 'category_peralatandapur']);

route::get('/category_peralatandapur1', [HomeController::class, 'category_peralatandapur1']);

route::get('/category_plastik', [HomeController::class, 'category_plastik']);

route::get('/category_plastik1', [HomeController::class, 'category_plastik1']);

route::get('/category_aksesoris', [HomeController::class, 'category_aksesoris']);

route::get('/category_aksesoris1', [HomeController::class, 'category_aksesoris1']);

route::get('/category_search', [HomeController::class, 'category_search']);


