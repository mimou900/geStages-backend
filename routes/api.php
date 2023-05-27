<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConvStageController;
use App\Http\Controllers\EtudiantController;
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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
//public Route
Route::get('/stages',[ConvStageController::class,'index']);
Route::get('/stages/{id}',[ConvStageController::class,'show']);
Route::get('/stages/search/{name}',[ConvStageController::class,'search']);
// Route::put('/stage/{id}/accept',[ConvStageController::class,'accept']);

//mimou Route
Route::post('/addStage',[ConvStageController::class,'addStage']);


Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);


    //protected route

    Route::group(['middleware'=>['auth:sanctum']], function () {
 Route::post('/stage',[ConvStageController::class,'store']);
 Route::get('/Etudiant/stages/{id}',[ConvStageController::class,'convStageByEtudiant']);
 Route::put('/stage/{id}',[ConvStageController::class,'update']);
 Route::put('/stage/valider/{id}',[ConvStageController::class,'valider']);
 Route::put('/stage/{id}/accept',[ConvStageController::class,'accept']);
 Route::put('/stage/{id}/reject',[ConvStageController::class,'reject']);
 Route::delete('/stage/{id}',[ConvStageController::class,'destroy']); 
});

Route::post('/logout',[AuthController::class,'logout']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// student routes

    Route::get('/Etudiants',[EtudiantController::class,'index']);
Route::post('/addEtudiant',[EtudiantController::class,'addEtudiant']);
 Route::put('/Etudiant/completer-mon-profile/{id}',[EtudiantController::class,'completeEtudiant']);
 Route::put('/Etudiant/{id}',[EtudiantController::class,'update']);
 Route::get('/Etudiant/{id}',[EtudiantController::class,'show']);
 Route::get('/Etudiant/{name}',[EtudiantController::class,'search']);
 Route::delete('/Etudiant/{id}',[EtudiantController::class,'destroy']); 