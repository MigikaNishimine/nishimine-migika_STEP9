<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
Route::get('/', function () {
    return view('welcome');
});
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/create',[ProductController::class,'create'])->name('products.create');
Route::post('/products',[ProductController::class,'store'])->name('products.store');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
Route::get('/products/{id}/edit',[ProductController::class,'edit'])->name('products.edit');
Route::put('/products/{id}',[ProductController::class,'update'])->name('products.update');
Route::delete('/products/{id}',[ProductController::class,'destroy'])->name('products.destroy');

Auth::routes();

Route::get('/home',function(){
    return redirect()->route('products.index');
})->middleware('auth');
Route::get('/mypage', [App\Http\Controllers\MypageController::class, 'index'])
    ->middleware('auth')
    ->name('mypage.index');
Route::get('/account/edit',[App\Http\Controllers\AccountController::class,'edit'])
    ->middleware('auth')
    ->name('account.edit');
Route::post('/account/update',[App\Http\Controllers\AccountController::class,'update'])
    ->middleware('auth')
    ->name('account.update');
Route::get('/purchase/{id}', [App\Http\Controllers\PurchaseController::class, 'show'])
    ->middleware('auth')
    ->name('purchase.show');
Route::post('/purchase', [App\Http\Controllers\PurchaseController::class, 'store'])
    ->middleware('auth')
    ->name('purchase.store');
Route::get('/purchase/complete', function () {
    return view('purchase.complete');
})->middleware('auth')->name('purchase.complete');
Route::post('/products/{id}/like', [App\Http\Controllers\LikeController::class, 'toggle'])
    ->middleware('auth')
    ->name('products.like');
Route::get('/contact', [App\Http\Controllers\ContactController::class, 'form'])
    ->middleware('auth')
    ->name('contact.form');
Route::post('/contact', [App\Http\Controllers\ContactController::class, 'send'])
    ->middleware('auth')
    ->name('contact.send');

