<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [UserController::class, 'login']);
Route::get('/users/login', [UserController::class, 'login'])->name('login');
Route::get('/users/create', [UserController::class, 'create']);
Route::get('/users/edit/{id}', [UserController::class, 'edit'])->middleware('auth');
Route::post('/users/store', [UserController::class, 'store'])->name('user.store');
Route::put('/users/update', [UserController::class, 'update'])->name('user.update')->middleware('auth');
Route::post('/users/authenticate', [UserController::class, 'authenticate'])->name('user.authenticate');
Route::get('/users/settings', [UserController::class, 'settings'])->middleware('auth');
Route::put('/users/password', [UserController::class, 'password'])->name('user.password')->middleware('auth');
Route::post('/users/logout', [UserController::class, 'logout'])->name('users.logout')->middleware('auth');

Route::get('/projects/index', [ProjectController::class, 'index'])->middleware('auth');
Route::get('/projects/create', [ProjectController::class, 'create'])->middleware('auth');
Route::get('/projects/edit/{id}', [ProjectController::class, 'edit'])->middleware('auth');
Route::post('/projects/store', [ProjectController::class, 'store'])->name('project.store')->middleware('auth');
Route::put('/projects/update', [ProjectController::class, 'update'])->name('project.update')->middleware('auth');
Route::delete('/projects/delete', [ProjectController::class, 'destroy'])->name('project.delete')->middleware('auth');

Route::get('/dashboards/index', [DashboardController::class, 'index'])->middleware('auth');
Route::post('/dashboards/search', [DashboardController::class, 'search'])->middleware('auth')->name('dashboard.search');
