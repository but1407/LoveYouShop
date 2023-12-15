<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Users\LoginController;
use App\Http\Controllers\Users\AuthController;
use App\Http\Controllers\Users\VerificationController;

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
// Route::get('/', function () {
//     return redirect()->view('home');
// });
Route::get('/', function () {
    return redirect()->route('login.index');
})->name('login');
Route::prefix('admin/users')->group(function() {
        #LoginController
        Route::controller(LoginController::class)->group(function () {
                Route::get('login','index')->name('login.index');
                Route::post('login/store', 'store')->name('login.store');
                #forgot password
                Route::get('users/forgot-password', 'forgotPassword')->name('users.forgot-password');
                Route::post('users/forgot-password','postForgotPass')->name('forgot-password');
                Route::get('users/forgot-password/search-success','searchSuccess')->name('search-success');
                Route::get('get-password/{customer}/{token}','getPass')->name('users.change-password');
                Route::post('get-password/{customer}/{token}','postGetPass');
        #register
        Route::controller(AuthController::class)->group(function () {
            Route::get('/index',  'index')->name('users.index');
            Route::post('/register',  'register')->name('register');
            Route::post('/re_register',  're_register');
            
         });
        Route::controller(VerificationController::class)->group(function () {
            Route::get('email/verify/{id}', 'verify')->name('verification.verify');
            Route::post('email/verify_OTP', 'verify_OTP')->name('verification.verify_OTP');
            Route::post('email/logout_OTP', 'logout_OTP');
        });


    });
});

Route::get('/home', function () {
    return view('home');
})->name('home');
Route::controller(CategoryController::class)->middleware(['auth'])->name('categories.')->prefix('categories')
    ->group(function () {
        Route::get('/', 'index')->name('index');

        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');

        Route::get('/delete/{id}', 'delete')->name('delete');



});