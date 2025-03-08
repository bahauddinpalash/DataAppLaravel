<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Auth\ConfirmablePasswordController;
// use App\Http\Controllers\Auth\EmailVerificationNotificationController;
// use App\Http\Controllers\Auth\EmailVerificationPromptController;
// use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Bdm\LeadController;
use App\Http\Controllers\DashboardController;
// use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Bdm\ClientController;
// use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Bdm\ProfileController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Bdm\Auth\LoginController;
use App\Http\Controllers\Bdm\SalesActivityController;
use App\Http\Controllers\Bdm\ClientResponseController;
use App\Http\Controllers\Bdm\Auth\PasswordResetLinkController;
// use App\Http\Controllers\Bdm\Auth\RegisteredUserController;
use App\Http\Controllers\Bdm\Auth\NewPasswordController;

Route::prefix('bdm')->middleware('guest:bdm')->group(function () {
    // Route::get('register', [RegisteredUserController::class, 'create'])
    //     ->name('register');

    // Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [LoginController::class, 'create'])
        ->name('bdm.login');

    Route::post('login', [LoginController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('bdm_password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('bdm_password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('bdm_password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('bdm_password.store');
});

Route::prefix('bdm')->middleware('auth:bdm')->group(function () {
    // Route::get('verify-email', EmailVerificationPromptController::class)
    //     ->name('verification.notice');

    // Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
    //     ->middleware(['signed', 'throttle:6,1'])
    //     ->name('verification.verify');

    // Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
    //     ->middleware('throttle:6,1')
    //     ->name('verification.send');

    // Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
    //     ->name('password.confirm');

    // Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('bdm.password.update');
    Route::get('/dashboard', [DashboardController::class, 'Bdmdashboard'])->name('bdm.dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('bdm.profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('bdm.profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('bdm.profile.destroy');
    Route::post('logout', [LoginController::class, 'destroy'])
        ->name('bdm.logout');
    // ClientController resource routes
    Route::resource('clients', ClientController::class);
    Route::resource('bdm-leads', LeadController::class);
    // Route::resource('sales_activities', SalesActivityController::class);
    // Group routes under /bdm/sales_activities
    Route::prefix('bdm-leads/{bdm_lead_id}/sales_activities')->group(function () {
        Route::get('/', [SalesActivityController::class, 'index'])->name('sales_activities.index');
        Route::get('{/create', [SalesActivityController::class, 'create'])->name('sales_activities.create');
        Route::post('/', [SalesActivityController::class, 'store'])->name('sales_activities.store');
        Route::get('/{sales_activity}/edit', [SalesActivityController::class, 'edit'])->name('sales_activities.edit');
        Route::put('/{sales_activity}', [SalesActivityController::class, 'update'])->name('sales_activities.update');
        Route::delete('/{sales_activity}', [SalesActivityController::class, 'destroy'])->name('sales_activities.destroy');
    });

    Route::prefix('bdm-leads/{bdm_lead_id}/client-responses')->group(function () {
        Route::get('/', [ClientResponseController::class, 'index'])->name('response.index'); // List all responses for a lead
        Route::get('/create', [ClientResponseController::class, 'create'])->name('response.create'); // Show create form
        Route::post('/', [ClientResponseController::class, 'store'])->name('response.store'); // Store a new response
        Route::get('/{response_id}/edit', [ClientResponseController::class, 'edit'])->name('response.edit'); // Show edit form
        Route::put('/{response_id}', [ClientResponseController::class, 'update'])->name('response.update'); // Update an existing response
        Route::delete('/{response_id}', [ClientResponseController::class, 'destroy'])->name('response.destroy'); // Delete a response
    });

});
