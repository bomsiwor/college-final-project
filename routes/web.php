<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\RadioactiveController;
use App\Http\Controllers\ToolController;
use App\Http\Controllers\UserController;
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
    return redirect()->to('/dashboard');
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
    Route::post('/blank', 'blank')->name('blank');

    Route::post('/send-message', 'storeMessage')->name('message.store');
});

Route::middleware('auth')->prefix('activity')->controller(ActivityController::class)->name('activity.')->group(function () {
    Route::get('/presensi', 'presensi')->name('presensi');

    Route::get('/radiation-log', 'radiationLog')->name('radiationLog');

    // Route::get('/borrow', 'indexOfBorrow')->name('borrow.all');
    // Route::get('/borrow/{borrow}', 'showBorrow')->name('borrow.detail');

    Route::get('/admin/borrow', 'adminBorrow')->name('admin.borrow')->middleware('role:admin');
    Route::get('/admin/return/{borrow}', 'returnBorrow')->name('admin.returning.store')->middleware('role:admin');

    // Route::post('/verify-borrow', 'verifyBorrow')->name('borrow.verify');
});

Route::middleware('auth')->prefix('attendance')->controller(AttendanceController::class)->name('attendance.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('show-all', 'total')->name('total');
    Route::get('show-me', 'me')->name('me');
});

Route::middleware('auth')->prefix('borrow')->controller(BorrowController::class)->name('borrow.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/{borrow}', 'show')->name('show');

    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');

    Route::delete('/delete', 'delete')->name('delete');

    Route::post('/return', 'return')->name('return')->middleware('role:admin');

    Route::post('verify', 'verify')->name('verify');
});

Route::middleware('auth')->prefix('radioactive')->controller(RadioactiveController::class)->name('radioactive.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/detail/{radioactive:inventory_unique}', 'show')->name('detail');
    // Route::get('/detail/{isotopes}', 'detail')->name('detail');
});

Route::middleware('auth')->prefix('tool')->controller(ToolController::class)->name('tool.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/{tool:inventory_unique}', 'show')->name('detail');
    Route::get('/create', 'create')->name('create');
    Route::put('/edit-data', 'update')->name('update');
    Route::delete('/delete/{tool:inventory_unique}', 'destroy')->name('delete');

    Route::post('/logs', 'logs')->name('logs');
    Route::get('/report-problem', 'report')->name('report');

    Route::post('/bulk-upload', 'storeExcel')->name('create.bulk');
});

Route::middleware('auth')->prefix('maintenance')->controller(MaintenanceController::class)->name('maintenance.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/{maintenance}', 'detail')->name('detail');
    Route::get('/download/{maintenance}', 'download')->name('download');
    Route::post('/verify', 'verify')->name('verify');
    Route::post('/unverify', 'unverify')->name('unverify');
    Route::post('/delete', 'delete')->name('delete');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->controller(AdminController::class)->name('admin.')->group(function () {
    Route::get('/manage-user', 'manageUser')->name('manageUser');
    Route::get('/user-messages', 'manageMessage')->name('manageMessage');
    Route::get('/manage-borrow', 'manageBorrow')->name('manageBorrow');
});

Route::middleware('auth')->controller(DashboardController::class)->group(function () {
});

Route::middleware('auth')->controller(UserController::class)->group(function () {
    Route::post('update-profile', 'updateProfile')->name('updateProfile');
    Route::delete('photo', 'deletePhoto')->name('deletePhoto');
});
