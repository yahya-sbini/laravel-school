<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\ClassRoomController;
use App\Http\Controllers\ChapterController;
use App\Models\Chapter;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TestController;
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


Route::group(['prefix' => 'v1'], function () {
    Route::get('lesson', [\App\Http\Controllers\TestController::class, 'index']);
    Route::get('meta', [\App\Http\Controllers\MetaController::class, 'index']);
    Route::get('import', [\App\Http\Controllers\TestController::class, 'import']);
});

/*-------------------------------------------------------------------------------------------------*/

Route::post('class/add',[ClassRoomController::class,'store']);
Route::get('class/show',[ClassRoomController::class,'show']);

Route::post('chapter/add',[ChapterController::class,'store']);
Route::get('chapter/show/{id}',[ChapterController::class,'show']);

Route::post('subject/add',[SubjectController::class,'store']);
Route::get('subject/show/{id}',[SubjectController::class,'show']);


/*-------------------------------------------------------------------------------------------------*/
Route::post('units/add',[UnitController::class,'store']);
Route::get('units/show/{id}',[UnitController::class,'show']);
Route::delete('units/delete/{id}',[UnitController::class,'delete']);
Route::put('units/edit/name/{id}',[UnitController::class,'edit_name']);
/*-------------------------------------------------------------------------------------------------*/


/*-------------------------------------------------------------------------------------------------*/
Route::post('lessons/add',[LessonController::class,'store']);
Route::get('lessons/show/{id}',[LessonController::class,'show']);
Route::delete('lessons/delete/{id}',[LessonController::class,'delete']);
Route::put('lessons/edit/name/{id}',[LessonController::class,'edit_name']);
Route::put('lessons/edit/link/{id}',[LessonController::class,'edit_link']);
/*-------------------------------------------------------------------------------------------------*/

/*-------------------------------------------------------------------------------------------------*/
Route::post('tests/add',[TestController::class,'store']);
Route::get('tests/show/{id}',[TestController::class,'show']);
Route::delete('tests/delete/{id}',[TestController::class,'delete']);
/*-------------------------------------------------------------------------------------------------*/

//add on delete
//logic add delete show
//show depending on previous
