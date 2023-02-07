<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\BarcodeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransactionController;

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

Route::resource('product', ProductController::class);
Route::resource('category', CategoryController::class)->only(['index', 'create', 'store']);
Route::resource('barcode', BarcodeController::class);
Route::resource('order', OrderController::class);
Route::resource('transactions', TransactionController::class);

Route::get('/adminRole/{id}', [UserController::class, "adminRole"])->name('role.admin');
Route::get('/managerRole/{id}', [UserController::class, "managerRole"])->name('role.manager');
Route::get('/cashierRole/{id}', [UserController::class, "cashierRole"])->name('role.cashier');
Route::get('/orderReceipt/{id}', [TransactionController::class, "createReceipt"])->name('order.receipt');
Route::get('/', function () {
    return view('welcome');


});

Route::delete('/delete/{id}', [ProductController::class, "delete"]);

Route::get('/home', [HomeController::class, "index"])->name('home');

Route::get('/dummydata', function(){
    return view('orders.receipt');
} );


  Route::get('/products', [ProductController::class, "all"]);



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
      Route::get('/dashboard', function () {
         return view('dashboard');
      })->name('dashboard');
 Route::get('/users', [UserController::class, "index"])->name('users.index');



});
