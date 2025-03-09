<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\FlimActorController;
use App\Http\Controllers\FlimCategoryController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\StoreController;
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
    return view('index');
})->name('index');

Route::get('/Actors', function () {
    return view('Actors');
})->name('Actors');

Route::get('/Address', function () {
    return view('Address');
})->name('Address');

// Route::get('/Categories', function () {
//     return view('Categories');
// })->name('Categories');

Route::get('/Categories',[CategoryController::class,'index'])->name('Categories');
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');

// Route::get('/Citys', function () {
//     return view('Citys');
// })->name('Citys');

Route::get('/Citys',[CityController::class,'index'])->name('Citys');
Route::get('/citys', [CityController::class, 'index'])->name('citys.index');

Route::get('/Customers', function () {
    return view('Customers');
})->name('Customers');

Route::get('/Flims', function () {
    return view('Flims');
})->name('Flims');

// Route::get('Flim_Actor', function () {
//     return view('Flim_Actor');
// })->name('Flim_Actor');

Route::get('/Flim_Actor',[FlimActorController::class,'index'])->name('Flim_Actor');
Route::get('/flim_actor', [FlimActorController::class, 'index'])->name('flim_actor.index');

// Route::get('/Flim_Category', function () {
//     return view('Flim_Category');
// })->name('Flim_Category');

Route::get('/Flim_Category',[FlimCategoryController::class,'index'])->name('Flim_Category');
Route::get('/flim_category', [FlimCategoryController::class, 'index'])->name('flim_category.index');

Route::get('/Flim_text', function () {
    return view('Flim_text');
})->name('Flim_text');

Route::get('/Inventory', function () {
    return view('Inventory');
})->name('Inventory');

// Route::get('/Languages', function () {
//     return view('Languages');
// })->name('Languages');
Route::get('/Languages',[LanguageController::class,'index'])->name('Languages');
Route::get('/languages', [LanguageController::class, 'index'])->name('languages.index');

Route::get('/Payments', function () {
    return view('Payments');
})->name('Payments');

Route::get('/Rentals', function () {
    return view('Rentals');
})->name('Rentals');

Route::get('/Staff', function () {
    return view('Staff');
})->name('Staff');

// Route::get('/Stores', function () {
//     return view('Stores');
// })->name('Stores');

Route::get('/Stores',[StoreController::class,'index'])->name('Stores');
Route::get('/stores', [StoreController::class, 'index'])->name('stores.index');