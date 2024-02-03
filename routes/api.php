<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Register\RegisterController;
use App\Http\Controllers\User\UserController;
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

Route::get('/', function() {
    return response()->json([
        'success' => false,
        'message' => 'Access Invalid',
    ], 401);
})->name('login');

Route::post('login/', [AuthController::class, 'login'])->name('auth.login');
Route::middleware('auth:sanctum')->group(function() {
    Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout');

    Route::resource('user', UserController::class)->except('show', 'edit', 'create');
    Route::post('register/', [RegisterController::class, 'register'])->name('register');
});
