<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SessionController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [SessionController::class, 'login']);
Route::get('/register', [SessionController::class, 'register']);
Route::post('/register/user', [SessionController::class, 'registeruser']);
Route::get('/login', [SessionController::class, 'login']);
Route::post('/login/user', [SessionController::class, 'loginuser']);
Route::get('/logout', [SessionController::class, 'logout']);
Route::delete('/delete', [SessionController::class, 'delete']);
Route::get('/update', [SessionController::class, 'update']);
Route::post('/updateform', [SessionController::class, 'updateForm']);


