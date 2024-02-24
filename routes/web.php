<?php

use App\Http\Controllers\Backend\Admin\AdminController;
use App\Http\Controllers\Backend\Vendor\VendorController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Admin Dashboard
Route::prefix('/admin')->as('admin.')->middleware(['auth','role:admin'])->group(function(){
    Route::get('/dashboard',[AdminController::class,'AdminDashboard'])->name('dashboard');
    Route::get('/logout',[AdminController::class,'destroy'])->name('logout');
    Route::get('/profile',[AdminController::class,'adminProfile'])->name('profile');
    Route::post('/profile',[AdminController::class,'adminProfileStore'])->name('profile.store');
});

//Vendor Dashboard
Route::prefix('/vendor')->as('vendor.')->middleware(['auth','role:vendor'])->group(function(){
    Route::get('/dashboard',[VendorController::class,'VendorDashboard'])->name('dashboard');
});

Route::get('/admin/login',[AdminController::class,'adminLogin']);
require __DIR__.'/auth.php';
