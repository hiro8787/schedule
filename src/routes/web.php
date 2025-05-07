<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\LoginController;

Route::get('/', [ScheduleController::class,'index']);

Route::get('/login', [LoginController::class,'login'])->name('login');
Route::post('/login', [LoginController::class,'create'])->name('create');
Route::post('/logout', [LoginController::class,'logout'])->name('logout');
Route::post('/', [LoginController::class,'certification'])->name('certification');
Route::get('/register', [LoginController::class,'register'])->name('register');

Route::prefix('/plans')->group(function(){
    Route::post('/create', [PlanController::class,'create']);
    Route::post('/store', [PlanController::class,'store'])->name('plans.store');
    Route::post('/edit', [PlanController::class,'edit'])->name('plans.edit');
    Route::get('/list', [PlanController::class,'list'])->name('plans.list');
    Route::post('/list', [PlanController::class,'delete'])->name('plans.delete');
});