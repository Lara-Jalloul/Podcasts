<?php

use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\PodcastController;
use App\Http\Controllers\UserController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum', 'XSSSantize']], function () {
    Route::post('/logout', [UserController::class, 'logout']);

    Route::post('/podcast', [PodcastController::class, 'store']);
    Route::delete('/podcast/{podcast}', [PodcastController::class, 'delete']);
    Route::put('/podcast/{podcast}', [PodcastController::class, 'update']);
    Route::get('/podcast', [PodcastController::class, 'index']);
    Route::get('/podcast/{podcast}', [PodcastController::class, 'show']);

    Route::post('/episode', [EpisodeController::class, 'store']);
    Route::delete('/episode/{episode}', [EpisodeController::class, 'delete']);
    Route::put('/episode/{episode}', [EpisodeController::class, 'update']);
    Route::get('/episode', [EpisodeController::class, 'index']);
    Route::get('/episode/{episode}', [EpisodeController::class, 'show']);
});
