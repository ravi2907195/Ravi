<?php

use App\Http\Controllers\ImageController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/products/index',[ProductController::class,'index'])->name('products.index');
Route::get('/products/create',[ProductController::class,'create'])->name('products.create');
Route::post('/products/store',[ProductController::class,'store'])->name('products.store');
Route::get('/products/{student}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/products/{student}', [ProductController::class, 'update'])->name('products.update');
Route::get('/products/{student}', [ProductController::class, 'destroy'])->name('products.destroy');

Route::get('/login',[ProductController::class,'login'])->name('login');
Route::get('/view',[ProductController::class,'view'])->name('view');
Route::get('/profile',[ProductController::class,'profile'])->name('profile');
Route::get('/logout',[ProductController::class,'logout'])->name('logout');

Route::get('/fileview',[ProductController::class,'fileview'])->name('fileview');
Route::post('/upload',[ProductController::class,'upload'])->name('upload');

Route::get('/search',[ProductController::class,'search'])->name('search');
Route::post('/deletemultiple',[ProductController::class,'deletemultiple'])->name('deletemultiple');

route::view('upload','upload');
route::view('display','display');
Route::post('/uploadimage',[ImageController::class,'uploadimage'])->name('uploadimage');
Route::get('/displayimage', [ImageController::class, 'displayimage']);


route::view('home','home');

route::view('services','services');

route::view('about','about');
route::view('mmainfile','mmainfile');