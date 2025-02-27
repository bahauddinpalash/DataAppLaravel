<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Auth\ConfirmablePasswordController;
// use App\Http\Controllers\Auth\EmailVerificationNotificationController;
// use App\Http\Controllers\Auth\EmailVerificationPromptController;
//use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\RoleController;
// use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Bdm\BdmController;
// use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\BdmLeadController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\CandidatesController;
use App\Http\Controllers\Admin\BdmActivityController;
use App\Http\Controllers\Admin\RecruitLeadController;
use App\Http\Controllers\Recruiter\RecruiterController;
use App\Http\Controllers\Admin\ClientsResponseController;
use App\Http\Controllers\Admin\RecruitActivityController;
use App\Http\Controllers\Admin\CandidateResponseController;
use App\Http\Controllers\Admin\Auth\RegisteredUserController;

Route::prefix('admin')->middleware('guest:admin')->group(function () {
    // Route::get('register', [RegisteredUserController::class, 'create'])
    //     ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [LoginController::class, 'create'])
        ->name('admin.login');

    Route::post('login', [LoginController::class, 'store']);

    // Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
    //     ->name('password.request');

    // Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
    //     ->name('password.email');

    // Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
    //     ->name('password.reset');

    // Route::post('reset-password', [NewPasswordController::class, 'store'])
    //     ->name('password.store');
});

Route::prefix('admin')->middleware('auth:admin')->group(function () {
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

    Route::put('password', [PasswordController::class, 'update'])->name('admin.password.update');
    Route::get('/dashboard', [DashboardController::class, 'Admindashboard'])->name('admin.dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('admin.profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('admin.profile.destroy');
    Route::post('logout', [LoginController::class, 'destroy'])
        ->name('admin.logout');
    Route::resource('bdms', BdmController::class);
    Route::resource('admins', AdminController::class);
    Route::resource('admin-candidates', CandidatesController::class);
    Route::resource('recruiters', RecruiterController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('bdm-clients', ClientController::class);
    Route::resource('admin-bdm-leads', BdmLeadController::class);
    Route::resource('admin-recruit-leads', RecruitLeadController::class);
    Route::prefix('admin-bdm-leads/{bdm_lead_id}/bdm-activities')->group(function () {
        Route::get('/', [BdmActivityController::class, 'index'])->name('bdm-activities.index');
        Route::get('/create', [BdmActivityController::class, 'create'])->name('bdm-activities.create');
        Route::post('/', [BdmActivityController::class, 'store'])->name('bdm-activities.store');
        Route::get('/{bdm_activity}/edit', [BdmActivityController::class, 'edit'])->name('bdm-activities.edit');
        Route::put('/{bdm_activity}', [BdmActivityController::class, 'update'])->name('bdm-activities.update');
        Route::delete('/{bdm_activity}', [BdmActivityController::class, 'destroy'])->name('bdm-activities.destroy');
    });
    Route::prefix('admin-bdm-leads/{bdm_lead_id}/client-responses')->group(function () {
        Route::get('/', [ClientsResponseController::class, 'index'])->name('client-response.index');
        Route::get('/create', [ClientsResponseController::class, 'create'])->name('client-response.create');
        Route::post('/', [ClientsResponseController::class, 'store'])->name('client-response.store');
        Route::get('/{response_id}/edit', [ClientsResponseController::class, 'edit'])->name('client-response.edit');
        Route::put('/{response_id}', [ClientsResponseController::class, 'update'])->name('client-response.update');
        Route::delete('/{response_id}', [ClientsResponseController::class, 'destroy'])->name('client-response.destroy');
    });
    Route::prefix('admin-recruit-leads/{recruit_lead_id}/activities')->name('admin_recruit_activities.')->group(function () {
        Route::get('/', [RecruitActivityController::class, 'index'])->name('index');
        Route::get('/create', [RecruitActivityController::class, 'create'])->name('create');
        Route::post('/', [RecruitActivityController::class, 'store'])->name('store');
        Route::get('/{id}', [RecruitActivityController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [RecruitActivityController::class, 'edit'])->name('edit');
        Route::put('/{id}', [RecruitActivityController::class, 'update'])->name('update');
        Route::delete('/{activity_id}', [RecruitActivityController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('admin-recruit-leads/{recruit_lead_id}/responses')->name('admin_candidate_responses.')->group(function () {
        Route::get('/', [CandidateResponseController::class, 'index'])->name('index');
        Route::get('/create', [CandidateResponseController::class, 'create'])->name('create');
        Route::post('/', [CandidateResponseController::class, 'store'])->name('store');
        Route::get('/{response_id}', [CandidateResponseController::class, 'show'])->name('show');
        Route::get('/{response_id}/edit', [CandidateResponseController::class, 'edit'])->name('edit');
        Route::put('/{response_id}', [CandidateResponseController::class, 'update'])->name('update');
        Route::delete('/{response_id}', [CandidateResponseController::class, 'destroy'])->name('destroy');
    });
    
});
