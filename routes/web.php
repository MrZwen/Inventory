<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
route::get('/login', [AuthController::class, 'login'])->name('login');
route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin-dashboard', [ItemsController::class, 'index']);
    Route::get('/admin/settings', [SettingController::class, 'edit'])->name('settings.edit.admin');
    Route::post('/admin/settings/update', [SettingController::class, 'update'])->name('settings.update.admin');
    Route::get('/users', [UserController::class, 'users'])->name('users.index');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/delete/{id}', [UserController::class, 'delete'])->name('users.destroy');
    Route::get('/items', [ItemsController::class, 'items'])->name('items.index');
    Route::post('/items', [ItemsController::class, 'store'])->name('items.store');
    Route::get('/items/{id}', [ItemsController::class, 'show']);
    Route::delete('/items-admin/{id}', [ItemsController::class, 'delete'])->name('items.destroy.admins');
    Route::put('/items-admin/{id}', [ItemsController::class, 'update'])->name('items.update.admin');
    Route::get('/categories', [CategoryController::class, 'categories'])->name('category.index'); 
    Route::post('/categories-admin', [CategoryController::class, 'store'])->name('categories.store.admin');
    Route::get('/categories/{id}', [CategoryController::class, 'show']);
    Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{id}', [CategoryController::class, 'delete'])->name('categories.destroy');
});

Route::middleware(['auth', 'staff'])->group(function () {
    Route::get('/staff-dashboard', [ItemsController::class, 'index']);
    Route::get('/staff/settings', [SettingController::class, 'edit'])->name('settings.edit.staff');
    Route::post('/staff/settings/update', [SettingController::class, 'update'])->name('settings.update.staff');
    Route::get('/items-staff', [ItemsController::class, 'items'])->name('items.index.staff');
    Route::post('/items-staff', [ItemsController::class, 'store'])->name('items.store.staff');
    Route::put('/items/{id}', [ItemsController::class, 'update'])->name('items.update.staff');
    Route::get('/categories-staff', [CategoryController::class, 'categories'])->name('category.index.staff');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store.staff');
    Route::get('/categories-staff/{id}', [CategoryController::class, 'show']);
    Route::put('/categories-staff/{id}', [CategoryController::class, 'update'])->name('categories.update.staff');
});