<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConvStageController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\LoginController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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

// Route::resource('products',ConvStageController::class);

//public Route
Route::post('/login', [AuthController::class, 'login']);
Route::get('/stages',[ConvStageController::class,'index']);
Route::get('/stages/{id}',[ConvStageController::class,'show']);
Route::get('/stages/search/{name}',[ConvStageController::class,'search']);
// Route::put('/stage/{id}/accept',[ConvStageController::class,'accept']);

//mimou Route
Route::post('/addStage',[ConvStageController::class,'addStage']);


Route::post('/register',[AuthController::class,'register']);
// Route::post('/login',[AuthController::class,'login']);


    //protected route

    Route::group(['middleware'=>['auth:sanctum']], function () {
 Route::post('/stage',[ConvStageController::class,'store']);
 Route::put('/stage/{id}',[ConvStageController::class,'update']);
 Route::put('/stage/{id}/accept',[ConvStageController::class,'accept']);
 Route::put('/stage/{id}/reject',[ConvStageController::class,'reject']);
 Route::delete('/stage/{id}',[ConvStageController::class,'destroy']); 
});

Route::post('/logout',[AuthController::class,'logout']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// student routes

Route::post('/addEtudiant',[EtudiantController::class,'addEtudiant']);
 Route::put('/Etudiant/completer-mon-profile/{id}',[EtudiantController::class,'completeEtudiant']);
 Route::put('/Etudiant/{id}',[EtudiantController::class,'update']);
 Route::get('/Etudiant/{id}',[EtudiantController::class,'show']);
 Route::get('/Etudiant/{name}',[EtudiantController::class,'search']);
 Route::delete('/Etudiant/{id}',[EtudiantController::class,'destroy']); 


 