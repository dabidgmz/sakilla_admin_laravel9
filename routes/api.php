<?php

use App\Http\Controllers\ActorsController;
use App\Http\Controllers\AddressesController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CitiesController;
use App\Http\Controllers\CountriesController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\FilmsController;
use App\Http\Controllers\FilmsActorsController;
use App\Http\Controllers\FilmsCategoriesController;
use App\Http\Controllers\FilmsTextsController;
use App\Http\Controllers\InventoriesController;
use App\Http\Controllers\LanguagesController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\RentalsController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StoresController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => '/v1'], function() {
    // Actors routes
    Route::group(['prefix' => '/actors', 'controller' => ActorsController::class], function() {
        Route::get('/', 'index')->name('actors.index');
        Route::get('/{id}', 'show')->whereNumber('id')->name('actors.show');
        Route::post('/', 'store')->name('actors.store');
        Route::put('/{id}', 'update')->whereNumber('id')->name('actors.update');
        Route::delete('/{id}', 'destroy')->whereNumber('id')->name('actors.destroy');
    });

    // Addresses routes
    Route::group(['prefix' => '/addresses', 'controller' => AddressesController::class], function() {
        Route::get('/', 'index')->name('addresses.index');
        Route::get('/{id}', 'show')->whereNumber('id')->name('addresses.show');
        Route::post('/', 'store')->name('addresses.store');
        Route::put('/{id}', 'update')->whereNumber('id')->name('addresses.update');
        Route::delete('/{id}', 'destroy')->whereNumber('id')->name('addresses.destroy');
    });

    // Categories routes
    Route::group(['prefix' => '/categories', 'controller' => CategoriesController::class], function() {
        Route::get('/', 'index')->name('categories.index');
        Route::get('/{id}', 'show')->whereNumber('id')->name('categories.show');
    });

    // Cities routes
    Route::group(['prefix' => '/cities', 'controller' => CitiesController::class], function() {
        Route::get('/', 'index')->name('cities.index');
        Route::get('/{id}', 'show')->whereNumber('id')->name('cities.show');
    });

    // Countries routes
    Route::group(['prefix' => '/countries', 'controller' => CountriesController::class], function() {
        Route::get('/', 'index')->name('countries.index');
        Route::get('/{id}', 'show')->whereNumber('id')->name('countries.show');
    });

    // Customers routes
    Route::group(['prefix' => '/customers', 'controller' => CustomersController::class], function() {
        Route::get('/', 'index')->name('customers.index');
        Route::get('/{id}', 'show')->whereNumber('id')->name('customers.show');
        Route::post('/', 'store')->name('customers.store');
        Route::put('/{id}', 'update')->whereNumber('id')->name('customers.update');
        Route::delete('/{id}', 'destroy')->whereNumber('id')->name('customers.destroy');
    });

    // Films routes
    Route::group(['prefix' => '/films', 'controller' => FilmsController::class], function() {
        Route::get('/', 'index')->name('films.index');
        Route::get('/{id}', 'show')->whereNumber('id')->name('films.show');
        Route::post('/', 'store')->name('films.store');
        Route::put('/{id}', 'update')->whereNumber('id')->name('films.update');
        Route::delete('/{id}', 'destroy')->whereNumber('id')->name('films.destroy');
    });

    // Film-Actors routes
    Route::group(['prefix' => '/film-actors', 'controller' => FilmsActorsController::class], function() {
        Route::get('/', 'index')->name('film-actors.index');
        Route::get('/{actor_id}/{film_id}', 'show')->name('film-actors.show');
        Route::post('/', 'store')->name('film-actors.store');
        Route::put('/{actor_id}/{film_id}', 'update')->name('film-actors.update');
        Route::delete('/{actor_id}/{film_id}', 'destroy')->name('film-actors.destroy');
    });

    // Film-Categories routes
    Route::group(['prefix' => '/film-categories', 'controller' => FilmsCategoriesController::class], function() {
        Route::get('/', 'index')->name('film-categories.index');
        Route::get('/{film_id}/{category_id}', 'show')->name('film-categories.show');
        Route::post('/', 'store')->name('film-categories.store');
        Route::put('/{film_id}/{category_id}', 'update')->name('film-categories.update');
        Route::delete('/{film_id}/{category_id}', 'destroy')->name('film-categories.destroy');
    });

    // Film-Texts routes
    Route::group(['prefix' => '/film-texts', 'controller' => FilmsTextsController::class], function() {
        Route::get('/', 'index')->name('film-texts.index');
        Route::get('/{id}', 'show')->whereNumber('id')->name('film-texts.show');
        Route::post('/', 'store')->name('film-texts.store');
        Route::put('/{id}', 'update')->whereNumber('id')->name('film-texts.update');
        Route::delete('/{id}', 'destroy')->whereNumber('id')->name('film-texts.destroy');
    });

    // Inventories routes
    Route::group(['prefix' => '/inventories', 'controller' => InventoriesController::class], function() {
        Route::get('/', 'index')->name('inventories.index');
        Route::get('/{id}', 'show')->whereNumber('id')->name('inventories.show');
        Route::post('/', 'store')->name('inventories.store');
        Route::put('/{id}', 'update')->whereNumber('id')->name('inventories.update');
        Route::delete('/{id}', 'destroy')->whereNumber('id')->name('inventories.destroy');
    });

    // Languages routes
    Route::group(['prefix' => '/languages', 'controller' => LanguagesController::class], function() {
        Route::get('/', 'index')->name('languages.index');
        Route::get('/{id}', 'show')->whereNumber('id')->name('languages.show');
    });

    // Payments routes
    Route::group(['prefix' => '/payments', 'controller' => PaymentsController::class], function() {
        Route::get('/', 'index')->name('payments.index');
        Route::get('/{id}', 'show')->whereNumber('id')->name('payments.show');
        Route::post('/', 'store')->name('payments.store');
        Route::put('/{id}', 'update')->whereNumber('id')->name('payments.update');
        Route::delete('/{id}', 'destroy')->whereNumber('id')->name('payments.destroy');
    });

    // Rentals routes
    Route::group(['prefix' => '/rentals', 'controller' => RentalsController::class], function() {
        Route::get('/', 'index')->name('rentals.index');
        Route::get('/{id}', 'show')->whereNumber('id')->name('rentals.show');
        Route::post('/', 'store')->name('rentals.store');
        Route::put('/{id}', 'update')->whereNumber('id')->name('rentals.update');
        Route::delete('/{id}', 'destroy')->whereNumber('id')->name('rentals.destroy');
    });

    // Staff routes
    Route::group(['prefix' => '/staff', 'controller' => StaffController::class], function() {
        Route::get('/', 'index')->name('staff.index');
        Route::get('/{id}', 'show')->whereNumber('id')->name('staff.show');
        Route::post('/', 'store')->name('staff.store');
        Route::put('/{id}', 'update')->whereNumber('id')->name('staff.update');
        Route::delete('/{id}', 'destroy')->whereNumber('id')->name('staff.destroy');
    });

    // Stores routes
    Route::group(['prefix' => '/stores', 'controller' => StoresController::class], function() {
        Route::get('/', 'index')->name('stores.index');
        Route::get('/{id}', 'show')->whereNumber('id')->name('stores.show');
        Route::post('/', 'store')->name('stores.store');
        Route::put('/{id}', 'update')->whereNumber('id')->name('stores.update');
        Route::delete('/{id}', 'destroy')->whereNumber('id')->name('stores.destroy');
    });
});
