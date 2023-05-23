<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ToolController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\RadioactiveController;
use App\Http\Controllers\RadioactiveBorrowController;

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
// Landing page
Route::get('/', function () {
    return redirect()->to('/dashboard');
});

// Authenctication
Route::controller(AuthController::class)->group(function () {
    // Only guest
    Route::middleware('guest')->group(function () {
        Route::get('/login', 'login')->middleware('guest')->name('login');
        Route::get('/register', 'register')->middleware('guest')->name('register');
        Route::post('/auth', 'authenticate');
    });

    // Only logged in user
    Route::get('/logout', 'logout')->name('logout')->middleware('auth');
});

// Dashboard
Route::middleware('auth')->controller(DashboardController::class)->name('dashboard.')->group(function () {
    Route::get('/dashboard', 'index')->name('index');
    Route::get('/profile', 'profile')->name('profile');
    Route::get('/help', 'help')->name('help');
    Route::get('/contact-us', 'contact')->name('contact');
    Route::get('/agenda', 'agenda')->name('agenda');
    Route::get('/report-problem', 'report')->name('report');

    // Form request method
    Route::post('/blank', 'blank')->name('blank');
    Route::post('/send-message', 'storeMessage')->name('message.store');
});

// Activity
// Perizinan penggunaan laboratorium
Route::middleware('auth')->controller(ActivityController::class)->name('activity.')->group(function () {
    Route::get('/radiation-log', 'radiationLog')->name('radiationLog');
});

// Attendance
Route::middleware('auth')->prefix('attendance')->controller(AttendanceController::class)->name('attendance.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('show-all', 'total')->name('total');
    Route::get('show-me', 'me')->name('me');
});

// Radioactive Assets
Route::middleware('auth')->prefix('radioactive')->controller(RadioactiveController::class)->name('radioactive.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/detail/{radioactive:inventory_unique}', 'show')->name('detail');

    // Admin Previleges
    Route::middleware('role:admin')->group(function () {
        Route::get('create', 'create')->name('create');
        Route::put('edit-data', 'update')->name('update');
        Route::delete('delete/{radioactive:inventory_unique}', 'destroy')->name('delete');
    });
});

// Tool Assets
Route::middleware('auth')->prefix('tool')->controller(ToolController::class)->name('tool.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/detail/{tool:inventory_unique}', 'show')->name('detail');

    // Logging
    Route::get('logs', 'indexLog')->name('logs.index');
    Route::get('logs/{flag}', 'showLog')->name('logs.show');

    // Admin previleges
    Route::middleware('role:admin')->group(function () {
        Route::get('/create', 'create')->name('create');
        Route::post('/bulk-upload', 'storeExcel')->name('create.bulk');
        Route::put('/edit-data', 'update')->name('update');
        Route::delete('/delete/{tool:inventory_unique}', 'destroy')->name('delete');
    });
});

// Borrowing
Route::middleware('auth')->prefix('borrow')->name('borrow.')->group(function () {
    Route::view('/', 'Borrow.index', ['title' => 'Peminjaman'])->name('index');

    // Tool Borrowing
    Route::controller(BorrowController::class)->name('tool.')->prefix('tool')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{borrow}', 'show')->name('show');

        // Admin previleges
        Route::middleware('role:admin')->group(function () {
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::delete('/delete', 'delete')->name('delete');
            Route::post('/return', 'return')->name('return');
            Route::post('verify', 'verify')->name('verify');
        });
    });

    // Radioactive Borrowing
    Route::controller(RadioactiveBorrowController::class)->name('radioactive.')->prefix('radioactive')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{borrow}', 'show')->name('show');
        Route::delete('/delete', 'delete')->name('delete');

        // Admin previlege
        Route::middleware('role:admin')->group(function () {
            Route::post('/return', 'return')->name('return');
            Route::post('verify', 'verify')->name('verify');
        });
    });
});

// Maintenance
Route::middleware('auth')->prefix('maintenance')->controller(MaintenanceController::class)->name('maintenance.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/{maintenance}/detail', 'detail')->name('detail');
    Route::get('/download/{maintenance}', 'download')->name('download');

    // Admin previleges
    Route::middleware('role:admin')->group(function () {
        Route::get('/create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::post('/update', 'update')->name('update');
        Route::post('/verify', 'verify')->name('verify');
        Route::post('/unverify', 'unverify')->name('unverify');
        Route::post('/delete', 'delete')->name('delete');
    });
});

// Admin menu
Route::middleware(['auth', 'role:admin'])->prefix('admin')->controller(AdminController::class)->name('admin.')->group(function () {
    Route::get('/users', 'manageUser')->name('manageUser');
    Route::get('/messsage', 'manageMessage')->name('manageMessage');
    Route::get('/returns', 'returning')->name('returning');
});

// User Controller
Route::middleware('auth')->controller(UserController::class)->group(function () {
    Route::post('update-profile', 'updateProfile')->name('updateProfile');
    Route::delete('photo', 'deletePhoto')->name('deletePhoto');
});
