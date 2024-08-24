<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Functions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VerificationController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Public Routes
Route::middleware(['guest'])->group(function () {
Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::post('/register', [RegisterController::class, 'register'])->name('register');
});
    
    
Route::get('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Routes for Unverified Users
Route::middleware(['auth', 'unverified'])->group(function () {
    Route::get('/email/verify', function () {
        return view('auth.verify');
    })->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect('/dashboard');
    })->middleware(['auth', 'signed'])->name('verification.verify');
    

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('resent', true);
    })->name('verification.resend');
});

// Routes for Authenticated Users with Verified Emails
Route::middleware(['auth', 'verified'])->group(function () {
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');
    Route::get('/dashboard', [Functions::class, 'dashboard'])->name('dashboard');

    Route::get('/repository/{category}', function($category){
        return view('repository', ['category' => $category]);
    })->name('repository');
    Route::get('/inquiry', function () {
        return view('inquiry');
    })->name('inquiry');
    Route::get('/proposals', function () {
        return view('proposals');
    })->name('proposals');
    Route::get('/downloadable', function () {
        return view('downloadableform');
    })->name('downloadable');
    Route::get('/settings', function () {
        return view('settings');
    })->name('settings');
    Route::get('/settings/password', function () {
        return view('settingspassword');
    })->name('settings.password');
    Route::get('/settings/contact', function () {
        return view('settingscontact');
    })->name('settings.contact');
    Route::get('/settings/profile', function () {
        return view('settingsprofile');
    })->name('settings.profile');
    Route::get('/notification', function () {
        return view('notification');
    })->name('notification');
    Route::get('/projectsandrequests', function () {
        return view('projectsandrequests');
    })->name('projectsandrequests');
    Route::get('/requests', [Functions::class, 'request_page'])->name('requests');
    Route::get('/requests/{month}', [Functions::class, 'request_month'])->name('requests.month');
    Route::get('/requests/{month}/{folder}', [Functions::class, 'request_folder'])->name('requests.folder');


    Route::post('/settings/password/update', [Functions::class, 'changePassword'])->name('settings.password.update');
    Route::post('/settings/contact/update', [Functions::class, 'changeContact'])->name('settings.contact.update');
    Route::post('/settings/profile/update', [Functions::class, 'changeProfile'])->name('settings.profile.update');

    Route::post('/inquiry/submit', [Functions::class, 'submitInquiry'])->name('submit.inquiry');
    Route::post('/proposals/submit', [Functions::class, 'submitProposals'])->name('submit.proposals');

    Route::post('/requests/{month}/option', [Functions::class, 'requestsoption'])->name('requests.option');
});

// Home Route (Accessible to unauthenticated users)
Route::get('/home', [HomeController::class, 'index'])
    ->middleware('redirect.verified')
    ->name('home');


Auth::routes(['verify' => true]);