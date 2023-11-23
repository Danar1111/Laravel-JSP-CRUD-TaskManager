<?php

use App\Http\Controllers\AddController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\SessionController;
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

Route::middleware(['guest'])->group(function(){
    Route::get('/', [SessionController::class, 'index'])->name('login');
    Route::post('/', [SessionController::class, 'login']);
    Route::get('/register',[SessionController::class, 'register']);
    Route::post('/create', [SessionController::class, 'create'])->withoutMiddleware(['web' , 'verifyCsrfToken']);
});

Route::middleware(['auth'])->group(function(){
    Route::get('/home',[DashboardController::class, 'index']);
    Route::get('/logout',[SessionController::class, 'logout']);
    Route::get('/add',[AddController::class, 'index']);
    Route::post('/add',[AddController::class, 'store']);
    Route::get('/home/{title}/edit',[AddController::class, 'edit']);
    Route::put('/home/{title}',[AddController::class, 'update']);
    Route::delete('/home/{title}',[AddController::class, 'destroy']);
    Route::put('/home/{id}/done', [DashboardController::class, 'done']);
    Route::get('/history',[HistoryController::class, 'index']);
    Route::delete('/history/{title}',[HistoryController::class, 'destroy']);
    Route::post('/recap',[DashboardController::class, 'recap']);
});
