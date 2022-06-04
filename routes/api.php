<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VideosController;
use App\Http\Controllers\PodcastController;

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
    // upload video
    Route::post('/videos/upload', [VideosController::class, 'uploadVideo']);
    //upload podcast
    Route::post('/podcasts/upload', [PodcastController::class, 'uploadPodcast']);
    //delete podcast
    Route::delete('/podcasts/{id}', [PodcastController::class, 'deletePodcast']);
});




Route::get('/', function () {
    return response()->json([
        'message' => 'Welcome to the Gofitish API.',
    ]);
});


Route::post('/createaccount', [AuthController::class, 'createaccount']);

Route::post('/login', [AuthController::class, 'login']);

Route::get('/login',function (){
    return response()->json([
        'message' => 'Welcome to the Gofitish API. please login',
    ]);
});

//get videos all videos or by category
Route::get('/videos/{cat}', [VideosController::class, 'getVideos']);
//get video by category and subcategory
Route::get('/videos/cat/{cat}/{subcat}', [VideosController::class, 'getVideosBySubCategory']);
//get 1 video by id
Route::get('/videos/single/{id}', [VideosController::class, 'getVideo']);
//get videos by user
Route::get('/videos/user/{id}', [VideosController::class, 'getVideosByUser']);

//search for a video
Route::get('/videos/search/{query}', [VideosController::class, 'searchVideo']);

//get all podcast by a user
Route::get('/podcasts/user/{id}', [PodcastController::class, 'getPodcastsByUploader']);