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


// Home page
// api resourse with 'auth:sanctum' and 'admin' (class CheckIsAdmin)  middleware
Route::apiResource('halls', HallController::class)->middleware(['auth:sanctum', 'admin']);
Route::apiResource('movies', MovieController::class)->middleware(['auth:sanctum', 'admin']);
Route::apiResource('sessions', SessionController::class)->middleware(['auth:sanctum', 'admin']);
Route::apiResource('places', PlaceController::class)->middleware(['auth:sanctum', 'admin']);

// отдельные пути
Route::middleware('auth:sanctum')->get('/halls/{hall}/places', [HallController::class, 'getPlacesByHall']);

// создание и заполнение новых мест в зале
Route::middleware('auth:sanctum')->post('/halls/{hall}/places', [HallController::class, 'storePlaces']);

// удаление всех мест в зале
Route::middleware('auth:sanctum')->delete('/halls/{hall}/places', [HallController::class, 'deletePlaces']);


// обновление типа мест для зала
Route::middleware('auth:sanctum')->put('/halls/{hall}/places', [HallController::class, 'updateHallPlaces']);


// Client page
Route::prefix('guest')->group(function () {
    Route::apiResource('tickets', TicketController::class);
    Route::apiResource('orders', OrderController::class);

    // получение всех залов/фильмов/сеансов/зрительских мест
    Route::get('/halls', [HallController::class, 'index']);
    Route::get('/movies', [MovieController::class, 'index']);
    Route::get('/sessions', [SessionController::class, 'index']);
    Route::get('/places', [PlaceController::class, 'index']);

    // получение сеансов на конкретную дату
    Route::get('/sessions/date/{date}', [SessionController::class, 'getSessionsByDate']);
    // получение билетов по ID конкретного заказа
    Route::get('/tickets/order/{id}', [TicketController::class, 'getTicketsByOrderId']);
});


// api resourse without authorization
// Route::apiResource('halls', HallController::class);
// Route::apiResource('movies', MovieController::class);
// Route::apiResource('sessions', SessionController::class);
// Route::apiResource('places', PlaceController::class);

// Route::apiResource('tickets', TicketController::class);
// Route::apiResource('orders', OrderController::class);

/* // client requests (not protected)
Route::get('/halls', [HallController::class, 'index']);
Route::get('/movies', [MovieController::class, 'index']);
Route::get('/sessions', [SessionController::class, 'index']);
Route::get('/places', [PlaceController::class, 'index']); */

// client requests (not protected)
// Route::get('/halls', [HallController::class, 'index']);
// Route::get('/movies', [MovieController::class, 'index']);
// Route::get('/sessions', [SessionController::class, 'index']);
// Route::get('/places', [PlaceController::class, 'index']);




// Резервные пути (до гостевых путей):
// 
// получение сеансов на конкретную дату
// Route::middleware('auth:sanctum')->get('/sessions/date/{date}', [SessionController::class, 'getSessionsByDate']);

// получение сеансов на конкретную дату (без авторизации)
// Route::get('/sessions/date/{date}', [SessionController::class, 'getSessionsByDate']);


// получение билетов по ID конкретного заказа
// Route::middleware('auth:sanctum')->get('/tickets/order/{id}', [TicketController::class, 'getTicketsByOrderId']);

// получение билетов по ID конкретного заказа (без авторизации)
// Route::get('/tickets/order/{id}', [TicketController::class, 'getTicketsByOrderId']);
