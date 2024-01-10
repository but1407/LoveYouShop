<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Product\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Menus\MenuController;
use App\Http\Controllers\Users\LoginController;
use App\Http\Controllers\Users\AuthController;
use App\Http\Controllers\Users\VerificationController;
use App\Http\Controllers\Admin\Setting\SettingController;
use App\Http\Controllers\Admin\Sliders\SliderController;
use App\Http\Controllers\Admin\Users\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// Route::group([

//     'middleware' => 'api',
//     'prefix' => 'auth'

// ], function ($router) {

//     Route::post('login', [AuthController::class,'login']);
//     Route::post('logout', [AuthController::class,'logout']);
//     Route::post('refresh', [AuthController::class,'refresh']);
//     Route::get('me', [AuthController::class,'me']);

// });


// Route::get('/home', function () {
//     return view('home');
// })->name('home');
// Route::prefix('admin/users')->group(function() {
//         #LoginController
//         Route::controller(LoginController::class)->group(function () {
//                 Route::get('login','index')->name('login.index');
//                 Route::post('login/store', 'store')->name('login.store');
//                 #forgot password
//                 Route::get('users/forgot-password', 'forgotPassword')->name('users.forgot-password');
//                 Route::post('users/forgot-password','postForgotPass')->name('forgot-password');
//                 Route::get('users/forgot-password/search-success','searchSuccess')->name('search-success');
//                 Route::get('get-password/{customer}/{token}','getPass')->name('users.change-password');
//                 Route::post('get-password/{customer}/{token}','postGetPass');
//         #register
//         Route::controller(AuthController::class)->group(function () {
//             Route::get('/index',  'index')->name('users.index');
//             Route::post('/register',  'register')->name('register');
//             Route::post('/re_register',  're_register');
            
//          });
//         Route::controller(VerificationController::class)->group(function () {
//             Route::get('email/verify/{id}', 'verify')->name('verification.verify');
//             Route::post('email/verify_OTP', 'verify_OTP')->name('verification.verify_OTP');
//             Route::post('email/logout_OTP', 'logout_OTP');
//         });
//     });
// });

// Route::middleware(['auth'])
//     ->group(function () {
//         Route::prefix('admin')->name('admin.')->group(function () {
//             #Category
//             Route::controller(CategoryController::class)->name('categories.')->prefix('categories')->group(function () {
//                 Route::get('/', 'index')->name('index');

//                 Route::get('/create', 'create')->name('create');
//                 Route::post('/store', 'store')->name('store');
//                 Route::get('/edit/{id}', 'edit')->name('edit');
//                 Route::post('/update/{id}', 'update')->name('update');
//                 Route::get('/delete/{id}', 'delete')->name('delete');
//             });
//             #Menus
//             Route::controller(MenuController::class)->name('menus.')->prefix('menus')->group(function () {
//                 Route::get('/', 'index')->name('index');

//                 Route::get('/create', 'create')->name('create');
//                 Route::post('/store', 'store')->name('store');
//                 Route::get('/edit/{id}', 'edit')->name('edit');
//                 Route::post('/update/{id}', 'update')->name('update');
//                 Route::get('/delete/{id}', 'delete')->name('delete');

//             });
//             #Product 
//             Route::controller(ProductController::class)->name('products.')->prefix('products')->group(function () {
//                 Route::get('/', 'index')->name('index');
//                 Route::get('/create', 'create')->name('create');
//                 Route::post('/store', 'store')->name('store');
//                 Route::get('/edit/{id}', 'edit')->name('edit');
//                 Route::post('/update/{id}', 'update')->name('update');
//                 Route::get('/delete/{id}', 'delete')->name('delete');

//             });
//             #Slider
//              Route::controller(SliderController::class)->name('sliders.')->prefix('sliders')->group(function () {
//                 Route::get('/', 'index')->name('index');
//                 Route::get('/create', 'create')->name('create');
//                 Route::post('/store', 'store')->name('store');
//                 Route::get('/edit/{id}', 'edit')->name('edit');
//                 Route::post('/update/{id}', 'update')->name('update');
//                 Route::get('/delete/{id}', 'delete')->name('delete');

//             });
//             #Setting
//             Route::controller(SettingController::class)->name('settings.')->prefix('settings')->group(function () {
//                 Route::get('/', 'index')->name('index');
//                 Route::get('/create', 'create')->name('create');
//                 Route::post('/store', 'store')->name('store');
//                 Route::get('/edit/{id}', 'edit')->name('edit');
//                 Route::post('/update/{id}', 'update')->name('update');
//                 Route::get('/delete/{id}', 'delete')->name('delete');

//             });
//             #User
//             Route::controller(UserController::class)->name('users.')->prefix('users')->group(function () {
//                 Route::get('/', 'index')->name('index');
//                 Route::get('/create', 'create')->name('create');
//                 Route::post('/store', 'store')->name('store');
//                 // Route::get('/edit/{id}', 'edit')->name('edit');
//                 // Route::post('/update/{id}', 'update')->name('update');
//                 // Route::get('/delete/{id}', 'delete')->name('delete');

//             });
            
//             #logout
//             Route::get('/logout', [LoginController::class, 'logout'])->name('users.logout');
//         });
//     });

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});