<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\StripeController;
use App\Http\Controllers\User\AllUserController;
use App\Http\Controllers\User\CompareController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CuponController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\WishlistController;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\Admin\AdminController;
use App\Http\Controllers\Backend\VendorOrderController;
use App\Http\Controllers\User\CashonDeliveryController;
use App\Http\Controllers\Backend\ShippingAreaController;
use App\Http\Controllers\Backend\Vendor\VendorController;
use App\Http\Controllers\Backend\Admin\CategoryController;
use App\Http\Controllers\Backend\Admin\SubCategoryController;
use App\Http\Controllers\Backend\Vendor\VendorProductController;

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

// Route::get('/', function () {
//     return view('frontend.index');
// });
Route::get('/',[IndexController::class,'index']);

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::post('/user/profile', [UserController::class, 'update'])->name('user.profile.update');
    Route::get('/user/logout', [UserController::class, 'logout'])->name('user.logout');
    Route::post('/change-password',[UserController::class,'UserPasswordUpdate'])->name('user.update.password');
    //Wishlist Routes
    Route::get('/wishlist', [WishlistController::class, 'allWishlist'])->name('wishlist');
    Route::get('/wishlist-products', [WishlistController::class, 'wishlistProduct']);
    Route::get('/wishlist-remove/{id}',[WishlistController::class,'wishlistRemove']);
    //Compare Routes
    Route::get('/compare', [CompareController::class, 'allCompare'])->name('compare');
    Route::get('/compare-products', [CompareController::class, 'compareProduct']);
    Route::get('/compare-remove/{id}',[CompareController::class,'compareRemove']);
   //View Cart Routes
    Route::get('/my-cart',[CartController::class,'myCart'])->name('myCart');
    Route::get('/my-cart-product',[CartController::class,'myCartProduct']);
    Route::get('/cart-remove/{id}',[CartController::class,'myCartRemove']);
    Route::get('/cart-decrement/{id}',[CartController::class,'cartDecrement']);
    Route::get('/cart-increment/{id}',[CartController::class,'cartIncrement']);
    //Checkout routes
    Route::get('/district-ajax/{division_id}', [CheckoutController::class, 'getDistrict']);
    Route::get('/state-ajax/{district_id}', [CheckoutController::class, 'getState']);
    Route::post('/checkout-payment', [CheckoutController::class, 'storeCheckout'])->name('checkout.store');
    //Stripe route
    Route::post('/stripe-order', [StripeController::class, 'stripeOrder'])->name('stripe.order');
    //Cash route
    Route::post('/cash-on-delivery/order', [CashonDeliveryController::class, 'cashOrder'])->name('cash.order');
    // User Dashboard All Route
    Route::get('/user/account', [AllUserController::class, 'userAccount'])->name('user.account.page');
    Route::get('/user/change-password', [AllUserController::class, 'userChangePassword'])->name('user.change.password');
    Route::get('/user/orders', [AllUserController::class, 'userOrder'])->name('user.order');
    Route::get('/user/order/details/{order_id}', [AllUserController::class, 'userOrderdetails'])->name('user.order.details');
    Route::get('/user/invoice-download/{order_id}', [AllUserController::class, 'userOrderinvoice'])->name('user.invoice.download');
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
    // Product Routes
    Route::get('/all-product', [ProductController::class, 'allProducts'])->name('all.products');
    Route::get('/add-product', [ProductController::class, 'addProduct'])->name('add.product');
    Route::post('/store-product', [ProductController::class, 'storeProduct'])->name('product.store');
    Route::get('/edit-product/{id}', [ProductController::class, 'editProduct'])->name('edit.product');
    Route::post('/update-product/{id}', [ProductController::class, 'updateProduct'])->name('update.product');
    Route::post('/update-product/thambnail/{id}', [ProductController::class, 'updateThambnail'])->name('update.thambnail');
    Route::get('/delete/product/multiple-image/{id}', [ProductController::class, 'deleteMultiImg'])->name('delete.multiimg');
    Route::get('/product/inactive/{id}', [ProductController::class, 'inactive'])->name('product.inactive');
    Route::get('/product/active/{id}', [ProductController::class, 'active'])->name('product.active');
    Route::get('/delete/product/{id}', [ProductController::class, 'productDelete'])->name('product.delete');
    // SubCategory Routes
    Route::get('/all-subcategory', [SubCategoryController::class, 'allSubCategory'])->name('all.subcategories');
    Route::get('/add-subcategory', [SubCategoryController::class, 'addSubCategory'])->name('add.subcategory');
    Route::post('/store-subcategory', [SubCategoryController::class, 'subcategoryStore'])->name('subcategory.store');
    Route::get('/edit-subcategory/{id}', [SubCategoryController::class, 'editSubCategory'])->name('edit.subcategory');
    Route::post('/update-subcategory/{id}', [SubCategoryController::class, 'updateSubCategory'])->name('update.subcategory');
    Route::get('/delete-subcategory/{id}', [SubCategoryController::class, 'deleteSubCategory'])->name('delete.subcategory');
    Route::get('/subcategory-ajax/{category_id}', [SubCategoryController::class, 'getSubcategory'])->name('subcategory.ajax');
    // Vendor Active & Inactive Routes
    Route::get('/inactive-vendor', [AdminController::class, 'inactiveVendor'])->name('vendor.inactive');
    Route::get('/active-vendor', [AdminController::class, 'activeVendor'])->name('vendor.active');
    Route::get('/inactive-vendor/details/{id}', [AdminController::class, 'inactiveVendorDetails'])->name('inactive.vendorDetails');
    Route::get('/active-vendor/details/{id}', [AdminController::class, 'activeVendorDetails'])->name('active.vendorDetails');
    Route::post('/active-vendor/approve/{id}', [AdminController::class, 'activeVendorApprove'])->name('active.vendor.approve');
    Route::post('/inactive-vendor/approve/{id}', [AdminController::class, 'inactiveVendorApprove'])->name('inactive.vendor.approve');
    // Slider Routes
    Route::get('/slider-list', [SliderController::class, 'allSlider'])->name('all.slider');
    Route::get('/add-slider', [SliderController::class, 'addSlider'])->name('add.slider');
    Route::post('/store-slider', [SliderController::class, 'sliderStore'])->name('slider.store');
    Route::get('/edit-slider/{id}', [SliderController::class, 'editSlider'])->name('edit.slider');
    Route::post('/update-slider/{id}', [SliderController::class, 'updateSlider'])->name('update.slider');
    Route::get('/delete-slider/{id}', [SliderController::class, 'deleteSlider'])->name('delete.slider');
    // Banner Routes
    Route::get('/banner-list', [BannerController::class, 'allBanner'])->name('all.banner');
    Route::get('/add-banner', [BannerController::class, 'addBanner'])->name('add.banner');
    Route::post('/store-banner', [BannerController::class, 'storeBanner'])->name('banner.store');
    Route::get('/edit-banner/{id}', [BannerController::class, 'editBanner'])->name('edit.banner');
    Route::post('/update-banner/{id}', [BannerController::class, 'updateBanner'])->name('update.banner');
    Route::get('/delete-banner/{id}', [BannerController::class, 'deleteBanner'])->name('delete.banner');
    // Cupon Routes
    Route::get('/coupon-list', [CuponController::class, 'allCupon'])->name('all.cupon');
    Route::get('/add-coupon', [CuponController::class, 'addCupon'])->name('add.cupon');
    Route::post('/store-coupon', [CuponController::class, 'storeCoupon'])->name('coupon.store');
    Route::get('/edit-coupon/{id}', [CuponController::class, 'editCoupon'])->name('edit.coupon');
    Route::post('/update-coupon/{id}', [CuponController::class, 'updateCoupon'])->name('update.coupon');
    Route::get('/delete-coupon/{id}', [CuponController::class, 'deleteCoupon'])->name('delete.coupon');
    // Shipping Division Routes
    Route::get('/division-list', [ShippingAreaController::class, 'allDivision'])->name('all.division');
    Route::get('/add-division', [ShippingAreaController::class, 'addDivision'])->name('add.division');
    Route::post('/store-division', [ShippingAreaController::class, 'storeDivision'])->name('store.division');
    Route::get('/edit-division/{id}', [ShippingAreaController::class, 'editDivision'])->name('edit.division');
    Route::post('/update-division/{id}', [ShippingAreaController::class, 'updateDivision'])->name('update.division');
    Route::get('/delete-division/{id}', [ShippingAreaController::class, 'deleteDivision'])->name('delete.division');
    // Shipping District Routes
    Route::get('/district-list', [ShippingAreaController::class, 'allDistrict'])->name('all.district');
    Route::get('/add-district', [ShippingAreaController::class, 'addDistrict'])->name('add.district');
    Route::post('/store-district', [ShippingAreaController::class, 'storeDistrict'])->name('store.district');
    Route::get('/edit-district/{id}', [ShippingAreaController::class, 'editDistrict'])->name('edit.district');
    Route::post('/update-district/{id}', [ShippingAreaController::class, 'updateDistrict'])->name('update.district');
    Route::get('/delete-district/{id}', [ShippingAreaController::class, 'deleteDistrict'])->name('delete.district');
    // Shipping State Routes
    Route::get('/state-list', [ShippingAreaController::class, 'allState'])->name('all.state');
    Route::get('/add-state', [ShippingAreaController::class, 'addState'])->name('add.state');
    Route::post('/store-state', [ShippingAreaController::class, 'storeState'])->name('store.state');
    Route::get('/district-ajax/{division_id}', [ShippingAreaController::class, 'getDistrict']);
    Route::get('/edit-state/{id}', [ShippingAreaController::class, 'editState'])->name('edit.state');
    Route::post('/update-state/{id}', [ShippingAreaController::class, 'updateState'])->name('update.state');
    Route::get('/delete-state/{id}', [ShippingAreaController::class, 'deleteState'])->name('delete.state');
    // Order Routes
    Route::get('/pending-order', [OrderController::class, 'pendingOrder'])->name('pending.order');
    Route::get('/confirmed-order', [OrderController::class, 'confirmedOrder'])->name('confirmed.order');
    Route::get('/processing-order', [OrderController::class, 'processingOrder'])->name('processing.order');
    Route::get('/deliverd-order', [OrderController::class, 'deliverdedOrder'])->name('deliverded.order');
    Route::get('/order/details/{id}', [OrderController::class, 'adminOrderDetails'])->name('order.details');
    Route::get('/pending-confirm/{id}', [OrderController::class, 'pendingConfirm'])->name('pending.confirm');
    Route::get('/confirm-processing/{id}', [OrderController::class, 'confirmProcessing'])->name('confirm.processing');
    Route::get('/processing-deliverd/{id}', [OrderController::class, 'processingDeliverd'])->name('processing.deliverd');
    Route::get('/invoice/download/{id}', [OrderController::class, 'invoiceDownload'])->name('invoice.download');
});

//Vendor Dashboard
Route::prefix('/vendor')->as('vendor.')->middleware(['auth','role:vendor'])->group(function(){
    Route::get('/dashboard',[VendorController::class,'VendorDashboard'])->name('dashboard');
    Route::get('/logout',[VendorController::class,'destroy'])->name('logout');
    Route::get('/profile',[VendorController::class,'vendorProfile'])->name('profile');
    Route::post('/profile',[VendorController::class,'vendorProfileStore'])->name('profile.store');
    Route::get('/change-password',[VendorController::class,'vendorChangePassword'])->name('change.password');
    Route::post('/change-password',[VendorController::class,'vendorPasswordUpdate'])->name('update.password');
    // Vendor Product routes
    Route::get('/product-list',[VendorProductController::class, 'vendorProductList'])->name('productList');
    Route::get('/add-product',[VendorProductController::class, 'vendorAddProduct'])->name('add.product');
    Route::get('/subcategory-ajax/{category_id}', [SubCategoryController::class, 'getSubcategory'])->name('subcategory.ajax');
    Route::post('/store-product', [VendorProductController::class, 'vendorStoreProduct'])->name('product.store');
    Route::get('/edit-product/{id}', [VendorProductController::class, 'vendorEditProduct'])->name('edit.product');
    Route::post('/update-product/{id}', [VendorProductController::class, 'vendorUpdateProduct'])->name('update.product');
    Route::post('/update-product/thambnail/{id}', [VendorProductController::class, 'vendorUpdateThambnail'])->name('update.thambnail');
    Route::get('/delete/product/multiple-image/{id}', [VendorProductController::class, 'vendorDeleteMultiImg'])->name('delete.multiimg');
    Route::get('/product/inactive/{id}', [VendorProductController::class, 'vendorProductInactive'])->name('product.inactive');
    Route::get('/product/active/{id}', [VendorProductController::class, 'vendorProductActive'])->name('product.active');
    Route::get('/delete/product/{id}', [VendorProductController::class, 'vendorProductDelete'])->name('product.delete');
    // Vendor Order routes
    Route::get('/order', [VendorOrderController::class, 'vendorOrder'])->name('order');
});

Route::middleware(['auth','role:admin'])->group(function(){
    Route::post('/admin/update/multiple-image', [ProductController::class, 'updateMultiImg'])->name('admin.update.multi_img');
});
Route::middleware(['auth','role:vendor'])->group(function(){
    Route::post('/update-product/multiple-image', [VendorProductController::class, 'vendorUpdateMultiImg'])->name('vendor.update.multi_img');
});

Route::get('/admin/login',[AdminController::class,'adminLogin'])->middleware('guest');
Route::get('/vendor/login',[VendorController::class,'vendorLogin'])->name('vendor.login')->middleware('guest');
Route::get('/become/vendor',[VendorController::class,'becomeVendor'])->name('become.vendor');
Route::post('/vendor/register',[VendorController::class,'vendorRegister'])->name('vendor.register');

// Frontend Routes
Route::get('/product/details/{id}/{slug}',[IndexController::class,'productDetails']);
Route::get('/product/subcategory/{id}/{slug}',[IndexController::class,'SubCateWiseProduct']);
Route::get('/product/category/{id}',[IndexController::class,'CateWiseProduct']);
Route::get('/vendor/details/{id}',[IndexController::class,'vendorDetails'])->name('vendor.details');
Route::get('/all-vendors',[IndexController::class,'all_vendor'])->name('vendor.all');
Route::get('/product/view/modal/{id}',[IndexController::class,'viewModal']); //product view modal with ajax
Route::post('/add-to-cart/store/{id}',[CartController::class,'addToCart']); //add to cart store data
Route::post('/add-to-cart/details/store/{id}',[CartController::class,'addToCartDetails']); //add to cart product details store
Route::get('/product/mini-cart',[CartController::class,'addMiniCart']); //add to cart product show mini cart
Route::get('/product/mini-cart/remove/{id}',[CartController::class,'miniCartProductRemove']); //mini cart product mini cart remove
Route::post('/add-to-wishlist/{product_id}',[WishlistController::class,'addToWishlist']); //add to wishlist product
Route::post('/add-to-compare/{product_id}',[CompareController::class,'addToCompare']); //add to compare
Route::post('/apply-coupon',[CartController::class,'couponApply']); //apply coupon
Route::get('/coupon-calculation',[CartController::class,'couponCalculate']); //coupon calculate
Route::get('/remove-coupon',[CartController::class,'removeCoupon']); // remove coupon
Route::get('/checkout',[CartController::class,'checkout'])->name('checkout'); //checkout routes;
require __DIR__.'/auth.php';
