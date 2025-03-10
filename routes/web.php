<?php

use App\Http\Controllers\ActorsController;
use App\Http\Controllers\AddressesController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CitiesController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\FilmsController;
use App\Http\Controllers\FilmsActorsController;
use App\Http\Controllers\FilmsCategoriesController;
use App\Http\Controllers\FilmsTextsController;
use App\Http\Controllers\LanguagesController;
use App\Http\Controllers\InventoriesController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\RentalsController;
use App\Http\Controllers\StoresController;
use App\Http\Controllers\StaffController;
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

# Actors views
Route::get('/Actors', function () {
    return view('Actors');
})->name('Actors');

Route::get('/Actors', [ActorsController::class, 'index'])->name('Actors');

Route::post('/Actors', [ActorsController::class, 'store'])->name('Actors');

Route::put('/actors/{id}', [ActorsController::class, 'update'])->name('actor.update');

Route::delete('/actors/{id}', [ActorsController::class, 'destroy'])->name('actors.destroy');


# Addresses views
Route::get('/Address', function () {
    return view('Address');
})->name('Address');

Route::get('/Address', [AddressesController::class, 'index'])->name('Address');

Route::post('/Address', [AddressesController::class, 'store'])->name('Address');

Route::put('/address/{id}', [AddressesController::class, 'update'])->name('address.update');

Route::delete('/address/{id}', [AddressesController::class, 'destroy'])->name('address.destroy');

#Categories views
Route::get('/Categories',[CategoriesController::class,'index'])->name('Categories');
Route::get('/categories', [CategoriesController::class, 'index'])->name('categories.index');

#Cities views
Route::get('/Citys',[CitiesController::class,'index'])->name('Citys');
Route::get('/citys', [CitiesController::class, 'index'])->name('citys.index');

#Customers views
Route::get('/Customers', function () {
    return view('Customers');
})->name('Customers');

Route::get('/Customers', [CustomersController::class, 'index'])->name('Customers');
Route::post('/Customers', [CustomersController::class, 'store'])->name('Customers');
Route::put('/customers/{id}', [CustomersController::class, 'update'])->name('customers.update');
Route::delete('/customers/{id}', [CustomersController::class, 'destroy'])->name('customers.destroy');

#Films views
Route::get('/Films', function () {
    return view('Films');
})->name('Films');

Route::get('/Films', [FilmsController::class, 'index'])->name('Films');
Route::post('/Films', [FilmsController::class, 'store'])->name('Films');
Route::put('/films/{id}', [FilmsController::class, 'update'])->name('films.update');
Route::delete('/films/{id}', [FilmsController::class, 'destroy'])->name('films.destroy');

// Route::get('Flim_Actor', function () {
//     return view('Flim_Actor');
// })->name('Flim_Actor');

#FilmsActors views
Route::get('/Flim_Actor',[FilmsActorsController::class,'index'])->name('Flim_Actor');
Route::get('/flim_actor', [FilmsActorsController::class, 'index'])->name('flim_actor.index');

// Route::get('/Flim_Category', function () {
//     return view('Flim_Category');
// })->name('Flim_Category');

#FilmsCategories views
Route::get('/Flim_Category',[FilmsCategoriesController::class,'index'])->name('Flim_Category');
Route::get('/flim_category', [FilmsCategoriesController::class, 'index'])->name('flim_category.index');

#FilmsText views
Route::get('/Film_text', function () {
    return view('Film_text');
})->name('Film_text');

Route::get('/Film_text', [FilmsTextsController::class, 'index'])->name('Film_text');
Route::post('/Film_text', [FilmsTextsController::class, 'store'])->name('Film_text');
Route::put('/film_text/{id}', [FilmsTextsController::class, 'update'])->name('film_text.update');
Route::delete('/film_text/{id}', [FilmsTextsController::class, 'destroy'])->name('film_text.destroy');


Route::get('/Inventories', function () {
    return view('/Inventories');
})->name('/Inventories');

Route::get('/Inventories', [InventoriesController::class, 'index'])->name('Inventories');
Route::post('/Inventories', [InventoriesController::class, 'store'])->name('Inventories');
Route::put('/inventories/{id}', [InventoriesController::class, 'update'])->name('inventories.update');
Route::delete('/inventories/{id}', [InventoriesController::class, 'destroy'])->name('inventories.destroy');

// Route::get('/Languages', function () {
//     return view('Languages');
// })->name('Languages');
Route::get('/Languages',[LanguagesController::class,'index'])->name('Languages');
Route::get('/languages', [LanguagesController::class, 'index'])->name('languages.index');

Route::get('/Payments', function () {
    return view('Payments');
})->name('Payments');

Route::get('/Payments', [PaymentsController::class, 'index'])->name('Payments');
Route::post('/Payments', [PaymentsController::class, 'store'])->name('Payments');
Route::put('/payments/{id}', [PaymentsController::class, 'update'])->name('payments.update');
Route::delete('/payments/{id}', [PaymentsController::class, 'destroy'])->name('payments.destroy');


Route::get('/Rentals', function () {
    return view('Rentals');
})->name('Rentals');

Route::get('/Rentals', [RentalsController::class, 'index'])->name('Rentals');
Route::post('/Rentals', [RentalsController::class, 'store'])->name('Rentals');
Route::put('/rentals/{id}', [RentalsController::class, 'update'])->name('rentals.update');
Route::delete('/rentals/{id}', [RentalsController::class, 'destroy'])->name('rentals.destroy');

Route::get('/Staff', function () {
    return view('Staff');
})->name('Staff');

Route::get('/Staff', [StaffController::class, 'index'])->name('Staff');
Route::post('/Staff', [StaffController::class, 'store'])->name('Staff');
Route::put('/staff/{id}', [StaffController::class, 'update'])->whereNumber('id')->name('staff.update');
Route::delete('/staff/{id}', [StaffController::class, 'destroy'])->name('staff.destroy');

// Route::get('/Stores', function () {
//     return view('Stores');
// })->name('Stores');

Route::get('/Stores',[StoresController::class,'index'])->name('Stores');
Route::get('/stores', [StoresController::class, 'index'])->name('stores.index');