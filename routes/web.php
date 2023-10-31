<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\HomeController;
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


Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
});

Route::controller(ClientController::class)->group(function () {
    Route::get('/category/{id}/{slug}', 'categoryPage')->name('category');
    Route::get('/product-details/{id}/{slug}', 'singleProduct')->name('singleproduct');
    Route::get('/all-products', 'showAllProducts')->name('showallproducts');
    Route::post('/search-products', 'searchProduct')->name('searchproduct');
    Route::get('/new-release', 'newRelease')->name('newrelease');

});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::controller(ClientController::class)->group(function () {
        Route::get('/add-to-cart', 'addToCart')->name('addtocart');
        Route::post('/add-product-to-cart', 'addProductToCart')->name('addproducttocart');
        Route::get('/shipping-address', 'getShippingAddress')->name('shippingaddress');
        Route::post('/add-shipping-address', 'goToCheckOut')->name('gotocheckout');
        Route::post('/place-order', 'placeOrder')->name('placeorder');
        Route::get('/checkout', 'checkout')->name('checkout');
        Route::get('/user-profile', 'userProfile')->name('userprofile');
        Route::get('/user-profile/pending-orders', 'pendingOrders')->name('pendingorders');
        Route::get('/user-profile/history', 'history')->name('history');
        Route::get('/new-release', 'newRelease')->name('newrelease');
        Route::get('/todays-deal', 'todaysDeal')->name('todaysdeal');
        Route::get('/custom-service', 'customService')->name('customservice');
        Route::get('/remove-cart-item/{id}', 'removeCartItem')->name('removecartitem');
        Route::post('/apply-coupon', 'applyCoupon')->name('applycoupon');
    });
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'role:user'])->name('dashboard');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/admin', 'index')->name('admindashboard');
    });
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/admin/all-category', 'index')->name('allcategory');
        Route::get('/admin/add-category', 'addCategory')->name('addcategory');
        Route::post('/admin/store-category', 'storeCategory')->name('storecategory');
        Route::get('/admin/edit-category/{id}', 'editCategory')->name('editcategory');
        Route::post('/admin/update-category', 'updateCategory')->name('updatecategory');
        Route::get('/admin/delete-category/{id}', 'deleteCategory')->name('deletecategory');

        Route::get('/admin/all-coupon', 'allCoupon')->name('allcoupon');
        Route::get('/admin/add-coupon', 'addCoupon')->name('addcoupon');
        Route::post('/admin/store-coupon', 'storeCoupon')->name('storecoupon');
        Route::get('/admin/edit-coupon/{id}', 'editCoupon')->name('editcoupon');
        Route::post('/admin/update-coupon', 'updateCoupon')->name('updatecoupon');
        Route::get('/admin/delete-coupon/{id}', 'deleteCoupon')->name('deletecoupon');
    });
    Route::controller(SubCategoryController::class)->group(function () {
        Route::get('/admin/all-subcategory', 'index')->name('allsubcategory');
        Route::get('/admin/add-subcategory', 'addSubCategory')->name('addsubcategory');
        Route::post('/admin/store-subcategory', 'storeSubCategory')->name('storesubcategory');
        Route::get('/admin/edit-subcategory/{id}', 'editSubCategory')->name('editsubcategory');
        Route::post('/admin/update-subcategory', 'updateSubCategory')->name('updatesubcategory');
        Route::get('/admin/delete-subcategory/{id}', 'deleteSubCategory')->name('deletesubcategory');

    });
    Route::controller(ProductController::class)->group(function () {
        Route::get('/admin/all-products', 'index')->name('allproducts');
        Route::get('/admin/add-product', 'addProduct')->name('addproduct');
        Route::post('/admin/store-product', 'storeProduct')->name('storeproduct');
        Route::get('/admin/edit-product-img/{id}', 'editProductImg')->name('editproductimg');
        Route::post('/admin/update-product-img', 'updateProductImg')->name('updateproductimg');
        Route::get('/admin/edit-product/{id}', 'editProduct')->name('editproduct');
        Route::post('/admin/update-product', 'updateProduct')->name('updateproduct');
        Route::get('/admin/delete-product/{id}', 'deleteProduct')->name('deleteproduct');

    });
    Route::controller(OrderController::class)->group(function () {
        Route::get('/admin/pending-order', 'index')->name('pendingorder');
    });
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';