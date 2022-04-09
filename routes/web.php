<?php

use App\Http\Controllers\adminController;
use App\Http\Controllers\auth\facebookController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\commentController;
use App\Http\Controllers\profileController;
use GuzzleHttp\Middleware;
use App\Http\Controllers\auth\GoogleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\friendController;
use App\Http\Controllers\paypal\paypalController;
use App\Providers\AppServiceProvider;
use Illuminate\Support\Facades\Auth;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {

    Auth::routes();
    Route::get('login/{user_id?}', [LoginController::class, 'showLoginForm'])->name('login');
    Route::get('register/{user_id?}', [RegisterController::class, 'showRegistrationForm'])->name('register');

    Route::get('/',                             [HomeController::class, 'index']);
    Route::get('home',                          [HomeController::class, 'index'])->name('home');
    Route::get('about_us',                      [HomeController::class, 'about_us'])->name('about_us');
    Route::get('contact_us',                    [HomeController::class, 'contact_us'])->name('contact_us');
    Route::middleware('auth')->group(function () {
        Route::post('send_message',                 [HomeController::class, 'send_message'])->name('send_message');
        Route::get('followers/{user_id}',           [HomeController::class, 'followers'])->name('followers');
        Route::get('work_with_us/{user_id}',        [HomeController::class, 'work_with_us'])->name('work_with_us');
        Route::get('work_site/subscribe_now/{user_id}',         [HomeController::class, 'subscribe'])->name('subscribe');
        Route::get('work_with_us/subscribe_now/{belongs_to}',   [HomeController::class, 'subscribe_now'])->name('work.subscribe');
        Route::get('get_notice',                    [HomeController::class, 'get_notice'])->name('get_notice');
        Route::get('onlone_status',                 [HomeController::class, 'onlone_status'])->name('onlone_status');
        // Route::get('belongs_to/{user_id}',  [HomeController::class, 'belongs_to'])->name('belongs_to');
        // Route::get('subscribe/{user_id?}',  [HomeController::class, 'subscribe'])->name('subscribe');
    });

    // Start Comment Controllers
    Route::group(['prefix' => 'project/comment', 'middleware' => 'auth'], function () {
        Route::post('/{project_id}',                [commentController::class, 'index'])->name('comment');
        Route::get('edit/{project_id}',            [commentController::class, 'edit'])->name('comment.edit');
        Route::post('update/{project_id}',          [commentController::class, 'update'])->name('comment.update');
        Route::get('delete/{project_id}',          [commentController::class, 'delete'])->name('comment.delete');
    });


    // Start Project Controllers
    Route::group(['prefix' => 'project', 'middleware' => 'auth'], function () {
        Route::get('new_project',                   [projectController::class, 'new_project'])->name('project.new_project');
        Route::post('create',                       [projectController::class, 'create'])->name('project.create');
        Route::get('edit/{project_id}',             [projectController::class, 'edit'])->name('project.edit');
        Route::post('update/{project_id}',          [projectController::class, 'update'])->name('project.update');
        Route::get('delete/{project_id}',           [projectController::class, 'delete'])->name('project.delete');
        Route::get('/{project_id}',                 [projectController::class, 'project'])->name('project');
    });

    // Start Profile Controllers
    Route::group(['prefix' => 'profile', 'middleware' => 'auth'], function () {
        Route::get('/{user_id}',                [profileController::class, 'index'])->name('profile');
        Route::get('edit/{user_id}',            [profileController::class, 'edit'])->name('profile.edit');
        Route::post('update/{user_id}',         [profileController::class, 'update'])->name('profile.update');
    });

    // Start Profile Controllers
    Route::group(['prefix' => 'friend', 'middleware' => 'auth'], function () {
        Route::get('add_friend/{friend_id}',        [friendController::class, 'add_friend'])->name('add_friend');
        Route::get('remove_friend/{friend_id}',     [friendController::class, 'remove_friend'])->name('remove_friend');
    });

    Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'adminpage']], function () {
        // Route::get('/',             [adminController::class, 'index'])->name('admin');
        Route::get('messages',      [adminController::class, 'messages'])->name('admin.messages');
        Route::get('users',         [adminController::class, 'users'])->name('admin.users');
        Route::get('projects',      [adminController::class, 'projects'])->name('admin.projects');
        Route::get('comments',      [adminController::class, 'comments'])->name('admin.comments');
    });
});

Route::get('auth/google',           [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback',  [GoogleController::class, 'handleGoogleCallback']);


Route::get('auth/facebook',             [facebookController::class, 'facebookRedirect'])->name('fb.login');
Route::get('auth/facebook/callback',    [facebookController::class, 'loginWithFacebook']);


// Route::get('handle-payment',    [paypalController::class, 'handlePayment'])->name('make.payment');
// Route::get('cancel-payment',    [paypalController::class, 'paymentCancel'])->name('cancel.payment');
// Route::get('payment-success',   [paypalController::class, 'paymentSuccess'])->name('success.payment');

Route::get('paynow', [paypalController::class, 'index']);
