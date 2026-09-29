<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\WartaController;
use App\Http\Controllers\Auth\JemaatAuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $wartas = \App\Models\Warta::query()
        ->where('is_published', true)
        ->orderByDesc('edition_date')
        ->orderByDesc('id')
        ->get();

    return view('home', [
        'wartas' => $wartas,
    ]);
})->name('home');

// PDF terbit dapat dibaca publik.
// Pemeriksaan status draft dilakukan di controller.
Route::get('/warta/{warta}/pdf', [WartaController::class, 'pdf'])
    ->whereNumber('warta')
    ->name('warta.pdf');

Route::middleware('guest')->group(function () {
    Route::get('/login', [JemaatAuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [JemaatAuthController::class, 'login'])
        ->middleware('throttle:10,1')
        ->name('login.store');

    Route::get('/register', [JemaatAuthController::class, 'showRegister'])
        ->name('register');

    Route::post('/register', [JemaatAuthController::class, 'register'])
        ->middleware('throttle:5,1')
        ->name('register.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/akun', [JemaatAuthController::class, 'account'])
        ->name('jemaat.account');

    Route::post('/logout', [JemaatAuthController::class, 'logout'])
        ->name('logout');
});

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::get('/warta', [WartaController::class, 'index'])
            ->name('warta.index');

        Route::post('/warta', [WartaController::class, 'store'])
            ->middleware('throttle:20,1')
            ->name('warta.store');

        Route::patch(
            '/warta/{warta}/status',
            [WartaController::class, 'updateStatus']
        )->name('warta.status');

        Route::delete('/warta/{warta}', [WartaController::class, 'destroy'])
            ->whereNumber('warta')
            ->name('warta.destroy');
    });

