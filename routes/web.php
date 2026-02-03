<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Controllers
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DashboardController;

// Finance
use App\Http\Controllers\Finance\CenterController;
use App\Http\Controllers\Finance\ProfessorController;
use App\Http\Controllers\Finance\GroupController;
use App\Http\Controllers\Finance\MonthlyFinancialController;
use App\Http\Controllers\Finance\YearlyFinanceController;

/*
|--------------------------------------------------------------------------
| Home
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('admin.dashboard')
        : redirect()->route('login');
})->name('home');

/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.store');
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

/*
|--------------------------------------------------------------------------
| Admin Area (secured)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->group(function () {

    /*
    | Dashboard
    */
    Route::get('/admin', [DashboardController::class, 'index'])
        ->name('admin.dashboard');

    /*
    |--------------------------------------------------------------------------
    | GLS FINANCE MODULE
    |--------------------------------------------------------------------------
    | Numeric-only management system (no students, no enrollments)
    */

    Route::prefix('finance')->name('finance.')->group(function () {

        // CRUD core tables
        Route::resource('centers', CenterController::class);
        Route::resource('professors', ProfessorController::class);
        Route::resource('groups', GroupController::class);
        Route::resource('monthly-financials', MonthlyFinancialController::class);

        // Yearly dashboard (select year → profs + groups details)
        Route::get('yearly', [YearlyFinanceController::class, 'index'])
            ->name('yearly');
    });
});

/*
|--------------------------------------------------------------------------
| Fallback
|--------------------------------------------------------------------------
*/
Route::fallback(function () {
    abort(404);
});
