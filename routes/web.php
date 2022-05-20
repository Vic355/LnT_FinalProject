<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('admin', function () { return view('admin'); })->middleware('checkRole:admin');
Route::get('employee', function () { return view('employee'); })->middleware(['checkRole:employee,admin']);
Route::get('buyer', function () { return view('buyer'); })->middleware(['checkRole:buyer,admin']);

Route::get('kategori', function () { return view('kategori.index'); })->middleware(['checkRole:admin']);
Route::get('createCat', function () { return view('kategori.create'); })->middleware(['checkRole:admin']);
Route::get('kategori', 'App\Http\Controllers\kategoriController@index')->middleware(['checkRole:admin']);
Route::post('/kategori/create', 'App\Http\Controllers\KategoriController@store')->middleware(['checkRole:employee,admin']);
Route::delete('/kategori/erase/{id}', 'App\Http\Controllers\KategoriController@destroy')->middleware(['checkRole:employee,admin']);
Route::get('/kategori/{id}', 'App\Http\Controllers\KategoriController@edit')->middleware(['checkRole:employee,admin']);
Route::patch('kategori/update/{id}', 'App\Http\Controllers\KategoriController@update')->name('update')->middleware(['checkRole:employee,admin']);

Route::get('product', 'App\Http\Controllers\ProdukController@index')->name('produk.index')->middleware(['checkRole:employee,admin']);
Route::get('product/create', 'App\Http\Controllers\ProdukController@viewcreate')->middleware(['checkRole:employee,admin']);
Route::get('product/update/{id}', 'App\Http\Controllers\ProdukController@viewupdate')->middleware(['checkRole:employee,admin']);
Route::patch('product/updateprocess/{id}', 'App\Http\Controllers\ProdukController@update')->name('update')->middleware(['checkRole:employee,admin']);
Route::post('product/proses', 'App\Http\Controllers\ProdukController@create')->middleware(['checkRole:employee,admin']);
Route::delete('/product/destroy/{id}', 'App\Http\Controllers\ProdukController@destroy')->middleware(['checkRole:employee,admin']);
Route::get('/product/find','App\Http\Controllers\ProdukController@find')->middleware(['checkRole:employee,admin']);

Route::get('/cart','App\Http\Controllers\CartController@index')->name('cart.index')->middleware(['checkRole:buyer,admin']);
Route::post('cart/store', 'App\Http\Controllers\CartDetailController@store')->name('cartdetail.store')->middleware(['checkRole:buyer,admin']);
Route::get('/shop','App\Http\Controllers\CartDetailController@index')->middleware(['checkRole:buyer,admin']);
Route::patch('/cart/update/{id}','App\Http\Controllers\CartDetailController@update')->name('cartdetail.update')->middleware(['checkRole:buyer,admin']);
Route::patch('/cart/{id}','App\Http\Controllers\CartController@update')->name('cart.confirm')->middleware(['checkRole:buyer,admin']);
Route::delete('/cart/erase/{id}','App\Http\Controllers\CartDetailController@destroy')->name('cartdetail.destroy')->middleware(['checkRole:buyer,admin']);
Route::patch('/emptycart/{id}','App\Http\Controllers\CartController@emptycart')->middleware(['checkRole:buyer,admin']);

Route::get('/order','App\Http\Controllers\OrderController@index');
Route::post('order/store', 'App\Http\Controllers\OrderController@store')->name('order.store');
Route::get('/shop/find','App\Http\Controllers\ProdukController@find2');