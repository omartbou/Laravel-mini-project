<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\UserManagementController;
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

Route::controller(LoginController::class)->group(function () {
    Route::get('/','index')->name('login.index');
    Route::post('/','auth')->name('login');
    Route::get('/logout','logout')->name('logout');
});

Route::controller(RegisterController::class)->group(function () {
    Route::get('/register','index')->name('register');
    Route::post('/register', 'register');
    Route::get('/verify_email/{hash}','verifyEmail')->name('verify_email');
});

Route::controller(ResetPasswordController::class)->group(function(){
    Route::get('password/reset','index')->name('reset.request');
    Route::post('password/reset-request','sendEmail')->name('reset.email');
    Route::get('password/reset/{token}','showResetForm')->name('reset.password');
    Route::post('password/reset/','reset')->name('password.update');
});
//Route::controller(UserManagementController::class)->group(function () {
//    Route::get('/users/', 'index')->name('users.index');
//    Route::get('/users/create', 'create')->name('users.create');
//    Route::post('/users/store/', 'store')->name('users.store');
//    Route::get('/users/edit/{id}/', 'edit')->name('users.edit');
//    Route::put('/users/edit/{id}', [UserManagementController::class, 'update'])->name('users.update');
//    Route::delete('/users/{user}', [UserManagementController::class, 'destroy'])->name('users.destroy');
      Route::resource('users',UserManagementController::class)->middleware('auth');
//});
