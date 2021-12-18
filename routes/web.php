<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ExpanceController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SubController;
use App\Http\Controllers\SystemController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [SystemController::class, 'index'])->name('index');
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// todo list
Route::resource('/todo', ScheduleController::class);
Route::get('todo/status/{id}', [ScheduleController::class, 'status'])->name('todo.status');
Route::post('todo/mark_all_done', [ScheduleController::class, 'markAllDone'])->name('todo.markAllDone');
Route::post('todo/mark_all_pending', [ScheduleController::class, 'markAllUndone'])->name('todo.markAllUndone');
Route::post('todo/clear_all', [ScheduleController::class, 'clear'])->name('todo.clear');
// Route::post('todo/clear_selected', [ScheduleController::class, 'clear_selected'])->name('todo.clear_selected');
// category route
Route::resource('/category', CategoryController::class);
Route::post('category.status/{id}', [CategoryController::class, 'statusUpdate'])->name('category.status');
//
// Expance Route
Route::resource('expance', ExpanceController::class);
// Route::resource('subcategory', SubcategoryController::class);
Route::get('/s-delete', 'SubController@Sub');
