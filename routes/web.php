<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\FindHomeController;
use App\Http\Controllers\CommonsController;
use App\Http\Controllers\OrderController;

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

// auth
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'authLoginView']);
    Route::get('/register', [AuthController::class, 'authRegisterView']);
    Route::get('/forgot-password', [AuthController::class, 'authForgotPasswordView']);
    Route::post('/login', [AuthController::class, 'authLoginAction']);
    Route::post('/register', [AuthController::class, 'authRegisterAction'])->withoutMiddleware(['guest']);
    Route::post('/logout', [AuthController::class, 'authLogoutAction'])->withoutMiddleware(['guest']);
});

// web-page
Route::get('/', [CommonsController::class, 'indexView']);
Route::get('/find-home', [FindHomeController::class, 'findHomeView']);
Route::post('/find-home', [FindHomeController::class, 'findHomeAction']);
Route::get('/about-us', function () {
    return view('webPage.aboutUs');
});

Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/user/property', [PropertyController::class, 'listPropertyView']);
    Route::get('/user/property/{propertyId}', [PropertyController::class, 'detailPropertyView']);
    Route::get('/user/find-home', [FindHomeController::class, 'findHomeView']);
    Route::get('/user/cart', [orderController::class, 'cartView']);
    Route::post('/user/order/{propertyId}', [orderController::class, 'addOrderProperty']);
    Route::put('/user/order/submission/{orderId}', [orderController::class, 'submissionOrderProperty']);
});

// admin-page
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/property', [PropertyController::class, 'listPropertyView']);
    Route::get('/admin/property/add', [PropertyController::class, 'addPropertyView']);
    Route::get('/admin/property/{propertyId}', [PropertyController::class, 'detailPropertyView']);
    Route::post('/admin/property/add', [PropertyController::class, 'addPropertyAction']);
    Route::put('/admin/property/{propertyId}/edit', [PropertyController::class, 'editPropertyAction']);
    Route::delete('/admin/property/{propertyId}/delete', [PropertyController::class, 'deletePropertyAction']);
    Route::get('/admin/user', [AuthController::class, 'listUserView']);
    Route::get('/admin/user/add', [AuthController::class, 'addUserAdminView']);
    Route::get('/admin/order', [orderController::class, 'cartView']);
    Route::put('/admin/order/submission/{orderId}', [orderController::class, 'submissionOrderAdmin']);
});
