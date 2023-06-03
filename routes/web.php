<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\MyOrderController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

Route::get('/', function () {
    return redirect(route('login'));
});


Route::group(['middleware' => 'auth'], function() {

Route::get('/order/product', [OrderController::class, 'product'])->name('order_product');
Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
Route::post('/proses/cart', [OrderController::class, 'to_cart'])->name('to_cart');
Route::post('/proses/checkout', [OrderController::class, 'proses_checkout'])->name('proses_checkout');

Route::get('/dashboard', [HomeController::class, 'index'])->name('home');
Route::get('/profil', [UserController::class, 'profil'])->name('profil');

Route::get('/my_order', [MyOrderController::class, 'index'])->name('my_order.index');
Route::delete('/my_order/{id}', [MyOrderController::class, 'destroy'])->name('my_order.hapus');


Route::delete('/cart/{id}', [MyOrderController::class, 'destroy_cart'])->name('cart.hapus');

// Export
Route::get('/export-excel', [MyOrderController::class, 'export'])->name('export');

// DATA JSON
// Route::get('/user/datajson', [UserController::class, 'dataJson'])->name('user.json');
Route::get('/product/datajson', [ProductController::class, 'dataJson'])->name('product.json');
Route::get('/my_order/datajson', [MyOrderController::class, 'dataJson'])->name('my_order.json');

Route::patch('/ubah_pass', [UserController::class, 'ubah_pass'])->name('ubah_pass');
Route::resource('user', UserController::class);
Route::resource('product', ProductController::class);

// API PROJECT 2
Route::get('api/data', [ApiController::class, 'get_data']);

});