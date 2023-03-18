<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
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

Route::get('/', function () {
    return view('Dashboard.index');
})->middleware('auth');

Route::controller(AuthController::class)->group(function () {
    Route::get('/auth/login', 'login')->middleware('guest')->name('login');
    Route::get('/register', 'register')->middleware('guest')->name('register');
    Route::post('/auth', 'authenticate');

    Route::get('/logout', 'logout')->name('logout');
});

Route::middleware('auth')->prefix('dashboard')->controller(DashboardController::class)->name('dashboard.')->group(function () {
    Route::get('/profile', 'profile')->name('profile');
    Route::get('/help', 'help')->name('help');
    Route::get('/contact-us', 'contact')->name('contact');
});

Route::middleware('auth')->prefix('activity')->controller(ActivityController::class)->name('activity.')->group(function () {
    Route::get('/presensi', 'presensi')->name('presensi');
});
