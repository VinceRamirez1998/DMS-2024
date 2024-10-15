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
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\NoticeBoardController;

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
    Route::get('/dashboard', [Functions::class, 'dashboard'])->name('dashboard');
    Route::get('/repository/{category}', [Functions::class, 'repository'])->name('repository');
    // Route::get('/repository/{category}', function($category){
    //     return view('repository', ['category' => $category]);
    // })->name('repository');
    Route::get('/inquiry', function () {
        return view('inquiry');
    })->name('inquiry');
    Route::get('/proposal/form', function () {
        return view('proposal_form');
    })->name('proposal.form');
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
    Route::get('/notifications', [Functions::class, 'notifications'])->name('notifications');
    Route::get('/projectsandrequests', function () {
        return view('projectsandrequests');
    })->name('projectsandrequests');
    Route::get('/{type}', [Functions::class, 'request_page'])->name('requests');
    Route::get('/requests/{month}', [Functions::class, 'request_month'])->name('requests.month');
    Route::get('/requests/{month}/{folder}', [Functions::class, 'request_folder'])->name('requests.folder');
    Route::get('/project/{folder}', [Functions::class, 'projects_folder'])->name('projects.folder');
    Route::post('/proposal/comment/submit', [Functions::class, 'proposalcommentsubmit'])->name('proposal.comment.submit');
    Route::post('/request/comment/submit', [Functions::class, 'requestcommentsubmit'])->name('request.comment.submit');
    Route::post('/inquiry/comment/submit', [Functions::class, 'inquirycommentsubmit'])->name('inquiry.comment.submit');
    Route::post('/request/assign/department', [Functions::class, 'selectdepartment'])->name('select.department');
    Route::post('/proposal/submit', [Functions::class, 'proposalsubmit'])->name('proposal.submit');

    Route::post('/settings/password/update', [Functions::class, 'changePassword'])->name('settings.password.update');
    Route::post('/settings/contact/update', [Functions::class, 'changeContact'])->name('settings.contact.update');
    Route::post('/settings/profile/update', [Functions::class, 'changeProfile'])->name('settings.profile.update');

    Route::post('/inquiry/submit', [Functions::class, 'submitInquiry'])->name('submit.inquiry');
    Route::post('/proposals/submit', [Functions::class, 'submitProposal'])->name('submit.proposals');
    Route::post('/request/transfer', [Functions::class, 'requesttransfer'])->name('request.transfer');
    Route::post('/inquiry/transfer', [Functions::class, 'inquirytransfer'])->name('inquiry.transfer');
    Route::post('/requests/{month}/option', [Functions::class, 'requestsoption'])->name('requests.option');
    Route::post('/projects/{folder}/option', [Functions::class, 'projectsoption'])->name('projects.option');

    Route::post('/projects/progress/forward', [Functions::class, 'progressbar'])->name('progress.forward');

    Route::post('/notification/update', [Functions::class, 'notificationupdate'])->name('notification.update');
    Route::get('/notification/{route}', [Functions::class, 'notificationroute'])->name('notification.route');
});

// Home Route
Route::get('/home', [HomeController::class, 'index'])
    ->middleware('redirect.verified')
    ->name('home');


Auth::routes(['verify' => true]);

// Annoucements
Route::get('/', [AnnouncementController::class, 'index'])->name('home');
Route::get('/email/verification-notice', [AnnouncementController::class, 'verificationNotice'])->name('verification.notice');
Route::get('/dashboard', [Functions::class, 'dashboard'])->name('dashboard.index');


