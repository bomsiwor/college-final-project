<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RadioactiveController;
use App\Http\Controllers\ToolController;
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
    abort(404);
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/auth/login', 'login')->middleware('guest')->name('login');
    Route::get('/register', 'register')->middleware('guest')->name('register');
    Route::post('/auth', 'authenticate');

    Route::get('/logout', 'logout')->name('logout');
});

Route::middleware('auth')->prefix('dashboard')->controller(DashboardController::class)->name('dashboard.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/profile', 'profile')->name('profile');
    Route::get('/help', 'help')->name('help');
    Route::get('/contact-us', 'contact')->name('contact');
});

Route::middleware('auth')->prefix('activity')->controller(ActivityController::class)->name('activity.')->group(function () {
    Route::get('/all-attendance', 'allAttendance')->name('allAttendance');
    Route::get('/presensi', 'presensi')->name('presensi');
});

Route::middleware('auth')->prefix('radioactive')->controller(RadioactiveController::class)->name('radioactive.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/detail/{isotopes}', 'detail')->name('detail');
});

Route::middleware('auth')->prefix('tool')->controller(ToolController::class)->name('tool.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/detail/{tool:inventory_number}', 'show')->name('detail');
    Route::get('/create', 'create')->name('create');
});

Route::middleware(['auth'])->prefix('admin')->controller(AdminController::class)->name('admin.')->group(function () {
    Route::get('/manage-user', 'manageUser')->name('manageUser');
});
