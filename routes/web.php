<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Backend\Admin\AdminController;
use App\Http\Controllers\Backend\Vendor\VendorController;

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
    return view('frontend.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::post('/user/profile', [UserController::class, 'update'])->name('user.profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Admin Dashboard
Route::prefix('/admin')->as('admin.')->middleware(['auth','role:admin'])->group(function(){
    Route::get('/dashboard',[AdminController::class,'AdminDashboard'])->name('dashboard');
    Route::get('/logout',[AdminController::class,'destroy'])->name('logout');
    Route::get('/profile',[AdminController::class,'adminProfile'])->name('profile');
    Route::post('/profile',[AdminController::class,'adminProfileStore'])->name('profile.store');
    Route::get('/change-password',[AdminController::class,'adminChangePassword'])->name('change.password');
    Route::post('/change-password',[AdminController::class,'adminPasswordUpdate'])->name('update.password');
});

//Vendor Dashboard
Route::prefix('/vendor')->as('vendor.')->middleware(['auth','role:vendor'])->group(function(){
    Route::get('/dashboard',[VendorController::class,'VendorDashboard'])->name('dashboard');
    Route::get('/logout',[VendorController::class,'destroy'])->name('logout');
    Route::get('/profile',[VendorController::class,'vendorProfile'])->name('profile');
    Route::post('/profile',[VendorController::class,'vendorProfileStore'])->name('profile.store');
    Route::get('/change-password',[VendorController::class,'vendorChangePassword'])->name('change.password');
    Route::post('/change-password',[VendorController::class,'vendorPasswordUpdate'])->name('update.password');
});

Route::get('/admin/login',[AdminController::class,'adminLogin']);
Route::get('/vendor/login',[VendorController::class,'vendorLogin']);
require __DIR__.'/auth.php';
