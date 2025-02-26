<?php

use App\Http\Controllers\ApiTokenController;
use App\Http\Controllers\HallController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TicketController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Route::middleware('auth:sanctum')->get('/halls', 'App\Http\Controllers\HallController@index');

// api resourse with middleware
Route::apiResource('halls', HallController::class)->middleware('auth:sanctum');
Route::apiResource('movies', MovieController::class)->middleware('auth:sanctum');
Route::apiResource('sessions', SessionController::class)->middleware('auth:sanctum');
Route::apiResource('places', PlaceController::class)->middleware('auth:sanctum');
Route::apiResource('tickets', TicketController::class)->middleware('auth:sanctum');
Route::apiResource('orders', OrderController::class)->middleware('auth:sanctum');

// // api resourse without authorization
// Route::apiResource('halls', HallController::class);
// Route::apiResource('movies', MovieController::class);
// Route::apiResource('sessions', SessionController::class);
// Route::apiResource('places', PlaceController::class);
// Route::apiResource('tickets', TicketController::class);
// Route::apiResource('orders', OrderController::class);

// отдельные пути
Route::middleware('auth:sanctum')->get('/halls/{hall}/places', [HallController::class, 'getPlacesByHall']);

// создание и заполнение новых мест в зале
Route::middleware('auth:sanctum')->post('/halls/{hall}/places', [HallController::class, 'storePlaces']);

// удаление всех мест в зале
Route::middleware('auth:sanctum')->delete('/halls/{hall}/places', [HallController::class, 'deletePlaces']);


// обновление типа мест для зала
Route::middleware('auth:sanctum')->put('/halls/{hall}/places', [HallController::class, 'updateHallPlaces']);


// получение сеансов на конкретную дату
Route::middleware('auth:sanctum')->get('/sessions/date/{date}', [SessionController::class, 'getSessionsByDate']);

// // получение сеансов на конкретную дату (без авторизации)
// Route::get('/sessions/date/{date}', [SessionController::class, 'getSessionsByDate']);


// получение билетов по ID конкретного заказа
Route::middleware('auth:sanctum')->get('/tickets/order/{id}', [TicketController::class, 'getTicketsByOrderId']);

// // получение билетов по ID конкретного заказа (без авторизации)
// Route::get('/tickets/order/{id}', [TicketController::class, 'getTicketsByOrderId']);


// тест Book
// Route::middleware('auth:sanctum')->get('/book', 'App\Http\Controllers\BookController@index');
// Route::get('/book', 'App\Http\Controllers\BookController@index');

// or
// Route::get('/book', [BookController::class, 'index']);


// Route::resource('halls', HallController::class);

// Route::post('/tokens/create', [ApiTokenController::class, 'createToken']);


// Route::group(['middleware' => 'auth:sanctum'], function() {
//     Route::group(['middleware' => 'admin'], function() {
//         Route::resource('halls', HallController::class);
//     });
// });
