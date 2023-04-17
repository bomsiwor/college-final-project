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
    abort(503);
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
    Route::get('/agenda', 'agenda')->name('agenda');
    Route::get('/blank', 'blank')->name('blank');

    Route::post('/send-message', 'storeMessage')->name('message.store');
});

Route::middleware('auth')->prefix('activity')->controller(ActivityController::class)->name('activity.')->group(function () {
    Route::get('/all-attendance', 'allAttendance')->name('allAttendance');
    Route::get('/presensi', 'presensi')->name('presensi');

    Route::get('/radiation-log', 'radiationLog')->name('radiationLog');

    Route::get('/borrow', 'indexOfBorrow')->name('borrow.all');
    Route::get('/borrow/{borrow}', 'showBorrow')->name('borrow.detail');

    Route::get('/admin/borrow', 'adminBorrow')->name('admin.borrow')->middleware('role:admin');
    Route::get('/admin/return/{borrow}', 'returnBorrow')->name('admin.returning.store')->middleware('role:admin');

    Route::post('/verify-borrow', 'verifyBorrow')->name('borrow.verify');
});

Route::middleware('auth')->prefix('radioactive')->controller(RadioactiveController::class)->name('radioactive.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/detail/{isotopes}', 'detail')->name('detail');
});

Route::middleware('auth')->prefix('tool')->controller(ToolController::class)->name('tool.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/detail/{tool:inventory_unique}', 'show')->name('detail');
    Route::get('/create', 'create')->name('create');
    Route::delete('/delete/{tool:inventory_unique}', 'destroy')->name('delete');

    Route::post('/logs', 'logs')->name('logs');

    Route::get('/maintenance', 'maintenance')->name('maintenance.index');
    Route::get('/report-problem', 'report')->name('report');

    Route::post('/bulk-upload', 'storeExcel')->name('create.bulk');
});

Route::middleware(['auth'])->prefix('admin')->controller(AdminController::class)->name('admin.')->group(function () {
    Route::get('/manage-user', 'manageUser')->name('manageUser');
});
