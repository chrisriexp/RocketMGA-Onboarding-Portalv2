<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\agentAppointments;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FileController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/**Sub Agent Users */
Route::get('/users', [UsersController::class, 'index']);
Route::prefix('/user')->group( function() {
    Route::get('{id}', [UsersController::class, 'show']);
    Route::post('/add', [UsersController::class, 'store']);
    Route::put('/update/{id}', [UsersController::class, 'update']);
});

/**FIle Upload */
Route::get('/files', [FileController::class, 'index']);
Route::get('/file/{id}', [FileController::class, 'getUser']);
Route::post('/upload', [FileController::class, 'upload'])->name('upload');

/**Admin Users */
Route::post('/admin/login', [AdminController::class, 'login']);
Route::get('/admin/logout/{id}', [AdminController::class, 'logout']);
Route::get('/admin/status/{id}', [AdminController::class, 'status']);

/**Notifications */
Route::get('/notifications', [NotificationController::class, 'index']);
Route::post('/notification/add', [NotificationController::class, 'add']);
Route::get('/notification/read/{id}', [NotificationController::class, 'read']);

/**Appointed Agents */
Route::get('/appointed', [agentAppointments::class, 'index']);
Route::get('/appointed/{rocketMGA_id}', [agentAppointments::class, 'getUser']);
Route::post('/appointed/add', [agentAppointments::class, 'addUser']);
Route::put('/appointed/update/{rocketMGA_id}', [agentAppointments::class, 'updateUser']);