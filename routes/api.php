<?php

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

//using middleware
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function(Request $request) {
        return auth()->user();
    });
    Route::post('/sign-out', [AuthenticationController::class, 'logout']);
});


/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::get('/', function () {
    return response()->json([
        'message' => 'Welcome to the Gofitish API.',
    ]);
});

Route::post('/tokens/create', function (Request $request) {
   // $token = $request->user()->createToken($request->token_name);
    return  ["request" => $request->user()];
   // return ['token' => $token->plainTextToken];
});

Route::post('/create-account', function () {
    return response()->json([
        'message' => 'details received successfully.',
    ]);
});

Route::post('/login', function () {
    return response()->json([
        'message' => 'details received successfully.',
    ]);
});