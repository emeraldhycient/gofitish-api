<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AuthController;

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

//using middleware
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/logout', [AuthController::class, 'signOut']);
});




Route::get('/', function () {
    return response()->json([
        'message' => 'Welcome to the Gofitish API.',
    ]);
});


Route::post('/create-account', [AuthController::class, 'createaccount']);

Route::post('/login', [AuthController::class, 'login']);

Route::get('/login',function (){
    return response()->json([
        'message' => 'Welcome to the Gofitish API. please login',
    ]);
});