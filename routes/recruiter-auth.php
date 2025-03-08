<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Auth\ConfirmablePasswordController;
// use App\Http\Controllers\Auth\EmailVerificationNotificationController;
// use App\Http\Controllers\Auth\EmailVerificationPromptController;
// use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\DashboardController;
// use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\PasswordController;
// use App\Http\Controllers\Auth\NewPasswordController;
// use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Recruiter\Auth\NewPasswordController;
use App\Http\Controllers\Recruiter\ProfileController;
use App\Http\Controllers\Recruiter\CandidateController;
use App\Http\Controllers\Recruiter\Auth\LoginController;
// use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Recruiter\RecruitLeadController;
use App\Http\Controllers\Recruiter\Auth\PasswordResetLinkController;
use App\Http\Controllers\Recruiter\RecruitActivityController;
use App\Http\Controllers\Recruiter\CandidateResponseController;
use App\Http\Controllers\Recruiter\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Mail;

Route::prefix('recruiter')->middleware('guest:recruiter')->group(function () {
    // Route::get('register', [RegisteredUserController::class, 'create'])
    //     ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [LoginController::class, 'create'])
        ->name('recruiter.login');

    Route::post('login', [LoginController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('recruiter_password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('recruiter_password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('recruiter_password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('recruiter_password.store');
       

Route::get('/send-test-email', function () {
    Mail::raw('This is a test email', function ($message) {
        $message->to('recipient@example.com') // Replace with your email
                ->subject('Test Email');
    });

    return 'Test email sent!';
});

});

Route::prefix('recruiter')->middleware('auth:recruiter')->group(function () {
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

    Route::put('password', [PasswordController::class, 'update'])->name('recruiter.password.update');
    Route::get('/dashboard', [DashboardController::class, 'Recruitdashboard'])->name('recruiter.dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('recruiter.profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('recruiter.profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('recruiter.profile.destroy');
    Route::post('logout', [LoginController::class, 'destroy'])
        ->name('recruiter.logout');
    Route::resource('candidates', CandidateController::class);
    Route::resource('leads', RecruitLeadController::class);
    Route::prefix('leads/{recruit_lead_id}/activities')->name('recruit_activities.')->group(function () {
        Route::get('/', [RecruitActivityController::class, 'index'])->name('index');
        Route::get('/create', [RecruitActivityController::class, 'create'])->name('create');
        Route::post('/', [RecruitActivityController::class, 'store'])->name('store');
        Route::get('/{id}', [RecruitActivityController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [RecruitActivityController::class, 'edit'])->name('edit');
        Route::put('/{id}', [RecruitActivityController::class, 'update'])->name('update');
        Route::delete('/{activity_id}', [RecruitActivityController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('leads/{recruit_lead_id}/responses')->name('candidate_responses.')->group(function () {
        Route::get('/', [CandidateResponseController::class, 'index'])->name('index');
        Route::get('/create', [CandidateResponseController::class, 'create'])->name('create');
        Route::post('/', [CandidateResponseController::class, 'store'])->name('store');
        Route::get('/{response_id}', [CandidateResponseController::class, 'show'])->name('show');
        Route::get('/{response_id}/edit', [CandidateResponseController::class, 'edit'])->name('edit');
        Route::put('/{response_id}', [CandidateResponseController::class, 'update'])->name('update');
        Route::delete('/{response_id}', [CandidateResponseController::class, 'destroy'])->name('destroy');
    });
});
