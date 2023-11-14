<?php

use App\Http\Controllers\Admin\BlogController;
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
    Route::get('/subcategory/{id}/{slug}', 'subcategoryPage')->name('subcategory');
    Route::post('/category-sort', 'categorySort')->name('categorysort');
    
    Route::get('/product-details/{id}/{slug}', 'singleProduct')->name('singleproduct');
    // show san pham trang san pham
    Route::get('/all-products', 'showAllProducts')->name('showallproducts');
    // loc san pham trang san pham
    Route::post('/sort-by', 'sortBy')->name('sortby');


    // search
    Route::post('/search-products', 'searchProduct')->name('searchproduct');
    Route::get('/new-release', 'newRelease')->name('newrelease');
    Route::get('/contact', 'contact')->name('contact');
    Route::post('/send-contact', 'sendContact')->name('sendcontact');

    // search by Image
    Route::get('/search-by-image', 'searchByImage')->name('searchbyimage');
    Route::post('/search-by-image-handle', 'searchByImageHandle')->name('searchbyimagehandle');

});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::controller(ClientController::class)->group(function () {
        Route::get('/add-to-cart', 'addToCart')->name('addtocart');
        Route::post('/add-product-to-cart', 'addProductToCart')->name('addproducttocart');
        Route::get('/shipping-address', 'getShippingAddress')->name('shippingaddress');
        Route::post('/add-shipping-address', 'goToCheckOut')->name('gotocheckout');
        Route::post('/place-order', 'placeOrder')->name('placeorder');

        // vnpay
        Route::post('/vnpay-payment', 'vnpayPayment')->name('vnpaypayment');
        Route::get('/vnpay-check', 'vnpayCheck')->name('vnpaycheck');

        // user profile
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


Route::controller(DashboardController::class)->group(function () {
    Route::get('/admin', 'index')->name('admindashboard');
    Route::get('/admin-login', 'adminLogin')->name('adminlogin');
    Route::post('/admin-login-post', 'adminLoginPost')->name('adminloginpost');
    Route::post('/admin-logout-post', 'adminLogout')->name('adminlogout');
    // Liên hệ
    Route::get('/admin-contact', 'adminContact')->name('admincontact');
});

// blog
Route::controller(BlogController::class)->group(function () {
    // them sua xoa
    Route::get('/admin-blog', 'adminBlog')->name('adminblog');
    Route::get('/admin/add-blog', 'addBlog')->name('addblog');
    Route::post('/admin/store-blog', 'storeBlog')->name('storeblog');
    Route::get('/admin/edit-blog/{id}', 'editBlog')->name('editblog');
    Route::post('/admin/update-blog', 'updateBlog')->name('updateblog');
    Route::get('/admin/delete-blog/{id}', 'deleteBlog')->name('deleteblog');

    // hien thi
    Route::get('blog', 'allBlog')->name('allblog');
    Route::get('blogdetail', 'blogDetail')->name('blogdetail');
    Route::get('/blog-details/{id}/{slug}', 'singleBlog')->name('singleblog');

});

Route::controller(CategoryController::class)->group(function () {
    Route::get('/admin/all-category', 'index')->name('allcategory');
    Route::get('/admin/add-category', 'addCategory')->name('addcategory');
    Route::post('/admin/store-category', 'storeCategory')->name('storecategory');
    Route::get('/admin/edit-category/{id}', 'editCategory')->name('editcategory');
    Route::post('/admin/update-category', 'updateCategory')->name('updatecategory');
    Route::get('/admin/delete-category/{id}', 'deleteCategory')->name('deletecategory');

    // Viết nhờ mã giảm giá
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
    Route::get('/admin/pending-order', 'pendingOrder')->name('pendingorder');
    Route::get('/admin/completed-order', 'completedOrder')->name('completedorder');
    Route::get('/admin/done-order', 'doneOrder')->name('doneorder');
    Route::get('/admin/cancel-order', 'cancelOrder')->name('cancelorder');
    Route::post('/admin/change-status', 'changeStatus')->name('changestatus');
    Route::post('/admin/change-status-to-done', 'changeStatusToDone')->name('changestatustodone');
    Route::post('/admin/change-status-to-cancel', 'changeStatusToCancel')->name('changestatustocancel');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';