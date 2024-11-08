<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GithubController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\StoryController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MusicArticleController;
use App\Http\Controllers\Auth\ForgotPasswordController;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/email/forgot', function () {
    return view('email.forgot-password');
});
Route::patch('/locale/setLocale', [LocaleController::class, 'setLocale'])->name('locale.setLocale');

//ROUTES FOR GITHUB
Route::prefix('github')->name('github.')->group(function () {
    Route::post('/auto-deploy', [GithubController::class, 'autoDeploy'])->name('autoDeploy'); // AUTO-DEPLOY
});

// AUTH ROUTES
Route::middleware(['guest.custom'])->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login.index');
    Route::post('/login', [LoginController::class, 'process'])->name('login.process');
    Route::get('/register', [RegisterController::class, 'index'])->name('register.index');
    Route::post('/register', [RegisterController::class, 'process'])->name('register.process');
    Route::get('/forgot-password', [ForgotPasswordController::class, 'index'])->name('forgot-password.index');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'process'])->name('forgot-password.process');
    Route::get('/forgot-password/reset', [ForgotPasswordController::class, 'reset'])->name('forgot-password.reset');
    Route::post('/forgot-password/reset', [ForgotPasswordController::class, 'processReset'])->name('forgot-password.processReset');
});
Route::post('/logout', [LoginController::class, 'logout'])->name('login.logout')->middleware(['auth.custom']);

// ROLE USER ROUTES
Route::middleware(['auth.custom', 'role:user'])->name('user.')->group(function () {
    //
});

// ROLE ADMIN ROUTES
Route::middleware(['auth.custom', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // DASHBOARD
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    // USER
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/action/{id?}', [UserController::class, 'action'])->name('user.action');
    Route::put('/user/process', [UserController::class, 'process'])->name('user.process');
    Route::patch('/user/process-password', [UserController::class, 'processPassword'])->name('user.processPassword');
    Route::patch('/user/update-status', [UserController::class, 'updateStatus'])->name('user.updateStatus');
    Route::delete('/user/delete/{id}', [UserController::class, 'delete'])->name('user.delete');
    // PROFILE
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');
});

// SERVER UPLOAD ROUTES
Route::prefix('upload')->name('upload.')->group(function () {
    Route::post('/filepond/process', [UploadController::class, 'filepondProcess'])->name('filepondProcess');
    Route::delete('/filepond/revert', [UploadController::class, 'filepondRevert'])->name('filepondRevert');
    Route::post('/quill/image-upload', [UploadController::class, 'quillImageUpload'])->name('quillImageUpload');
});

