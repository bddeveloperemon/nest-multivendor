<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Backend\Admin\AdminController;
use App\Http\Controllers\Backend\Vendor\VendorController;
use App\Http\Controllers\Backend\Admin\CategoryController;
use App\Http\Controllers\Backend\Admin\SubCategoryController;

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
    Route::get('/user/logout', [UserController::class, 'logout'])->name('user.logout');
    Route::post('/change-password',[UserController::class,'UserPasswordUpdate'])->name('user.update.password');
});

//Admin Dashboard
Route::prefix('/admin')->as('admin.')->middleware(['auth','role:admin'])->group(function(){
    Route::get('/dashboard',[AdminController::class,'AdminDashboard'])->name('dashboard');
    Route::get('/logout',[AdminController::class,'destroy'])->name('logout');
    Route::get('/profile',[AdminController::class,'adminProfile'])->name('profile');
    Route::post('/profile',[AdminController::class,'adminProfileStore'])->name('profile.store');
    Route::get('/change-password',[AdminController::class,'adminChangePassword'])->name('change.password');
    Route::post('/change-password',[AdminController::class,'adminPasswordUpdate'])->name('update.password');
    // Brand Routes
    Route::get('/all-brand', [BrandController::class, 'allBrands'])->name('all.brands');
    Route::get('/add-brand', [BrandController::class, 'addBrand'])->name('add.brand');
    Route::post('/store-brand', [BrandController::class, 'brandStore'])->name('brand.store');
    Route::get('/edit-brand/{id}', [BrandController::class, 'editBrand'])->name('edit.brand');
    Route::post('/update-brand/{id}', [BrandController::class, 'updateBrand'])->name('update.brand');
    Route::get('/delete-brand/{id}', [BrandController::class, 'deleteBrand'])->name('delete.brand');
    // Category Routes
    Route::get('/all-category', [CategoryController::class, 'allCategory'])->name('all.categories');
    Route::get('/add-category', [CategoryController::class, 'addCategory'])->name('add.category');
    Route::post('/store-category', [CategoryController::class, 'categoryStore'])->name('category.store');
    Route::get('/edit-category/{id}', [CategoryController::class, 'editCategory'])->name('edit.category');
    Route::post('/update-category/{id}', [CategoryController::class, 'updateCategory'])->name('update.category');
    Route::get('/delete-category/{id}', [CategoryController::class, 'deleteCategory'])->name('delete.category');
    // SubCategory Routes
    Route::get('/all-subcategory', [SubCategoryController::class, 'allSubCategory'])->name('all.subcategories');
    Route::get('/add-subcategory', [SubCategoryController::class, 'addSubCategory'])->name('add.subcategory');
    Route::post('/store-subcategory', [SubCategoryController::class, 'subcategoryStore'])->name('subcategory.store');
    Route::get('/edit-subcategory/{id}', [SubCategoryController::class, 'editSubCategory'])->name('edit.subcategory');
    Route::post('/update-subcategory/{id}', [SubCategoryController::class, 'updateSubCategory'])->name('update.subcategory');
    Route::get('/delete-subcategory/{id}', [SubCategoryController::class, 'deleteSubCategory'])->name('delete.subcategory');
    // Vendor Active & Inactive Routes
    Route::get('/vendor-inactive', [AdminController::class, 'inactiveVendor'])->name('vendor.inactive');
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
Route::get('/vendor/login',[VendorController::class,'vendorLogin'])->name('vendor.login');
Route::get('/become/vendor',[VendorController::class,'becomeVendor'])->name('become.vendor');
Route::post('/vendor/register',[VendorController::class,'vendorRegister'])->name('vendor.register');
require __DIR__.'/auth.php';
