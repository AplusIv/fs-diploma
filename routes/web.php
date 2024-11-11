<?php

use App\Http\Controllers\HallController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::group(['middleware' => 'admin'], function() {
        Route::get('halls/{id}/price', [HallController::class, 'editPrice'])->name('halls.editPrice');
        Route::patch('halls/{id}', [HallController::class, 'updatePriceForPlace'])->name('halls.updatePrice');
        Route::resource('halls', HallController::class);
        Route::resource('sessions', SessionController::class);
        Route::resource('movies', MovieController::class);
        Route::get('places/{id}/type', [PlaceController::class, 'editType'])->name('halls.editType');
        Route::patch('places/{id}', [PlaceController::class, 'updateActiveTypeForPlace'])->name('halls.updateType');
        Route::resource('places', PlaceController::class);
        Route::resource('tickets', TicketController::class);
        Route::resource('orders', OrderController::class);

    });
});
// Route::resource('halls', HallController::class);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
