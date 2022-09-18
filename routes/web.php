<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'show_options'])->name('home');

Route::any('home/info',[HomeController::class, 'get_selected'])->name('home.selected');

Route::get('test',[HomeController::class,'test']);

Route::view('operations','operations');





Route::any('home/operations/unit/delete/{id}',[HomeController::class, 'unit_delete']);

Route::post('home/operations/unit/add',[HomeController::class,'unit_add'])->name('add.unit');

Route::post('home/operations/unit/edit',[HomeController::class,'unit_edit'])->name('edit.unit');





Route::any('home/operations/lesson/delete/{id}',[HomeController::class, 'lesson_delete']);

Route::post('home/operations/lesson/add',[HomeController::class,'lesson_add'])->name('add.lesson');

Route::post('home/operations/lesson/edit',[HomeController::class,'lesson_edit'])->name('edit.lesson');



Route::any('home/operations/test/delete/{id}',[HomeController::class, 'test_delete']);

Route::post('home/operations/test/add',[HomeController::class,'test_add'])->name('add.test');

Route::post('home/operations/test/edit',[HomeController::class,'test_edit'])->name('edit.test');

