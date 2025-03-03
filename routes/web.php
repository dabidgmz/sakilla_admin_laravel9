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

Route::get('/Footer', function () {
    return view('Footer');
})->name('Footer');


Route::get('/ControlSidebar', function () {
    return view('ControlSidebar');
})->name('ControlSidebar');

Route::get('/Navbar', function () {
    return view('Navbar');
})->name('Navbar');


Route::get('/Sidebar', function () {
    return view('Sidebar');
})->name('Sidebar');