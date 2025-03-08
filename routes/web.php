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
    return view('index');
})->name('index');

Route::get('/Actors', function () {
    return view('Actors');
})->name('Actors');

Route::get('/Address', function () {
    return view('Address');
})->name('Address');

Route::get('/Categories', function () {
    return view('Categories');
})->name('Categories');

Route::get('/Citys', function () {
    return view('Citys');
})->name('Citys');

Route::get('/Customers', function () {
    return view('Customers');
})->name('Customers');

Route::get('/Flims', function () {
    return view('Flims');
})->name('Flims');

Route::get('Flim_Actor', function () {
    return view('Flim_Actor');
})->name('Flim_Actor');

Route::get('/Flim_Category', function () {
    return view('Flim_Category');
})->name('Flim_Category');

Route::get('/Flim_text', function () {
    return view('Flim_text');
})->name('Flim_text');

Route::get('/Inventory', function () {
    return view('Inventory');
})->name('Inventory');

Route::get('/Languages', function () {
    return view('Languages');
})->name('Languages');

Route::get('/Payments', function () {
    return view('Payments');
})->name('Payments');

Route::get('/Rentals', function () {
    return view('Rentals');
})->name('Rentals');

Route::get('/Staff', function () {
    return view('Staff');
})->name('Staff');

Route::get('/Stores', function () {
    return view('Stores');
})->name('Stores');
