<?php

use App\Http\Controllers\cartcontroller;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\checkoutcontroller;
use App\Http\Controllers\customercontroller;
use App\Http\Controllers\CustomerLOGcontroller;
use App\Http\Controllers\customerLOGINcontroler;
use App\Http\Controllers\customerlogincontroller;
use App\Http\Controllers\customerregcontroller;
use App\Http\Controllers\customerREGISTERcontroler;
use App\Http\Controllers\FronEndController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ordercontroller;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubCategoryController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\PDFController;
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
// frontend
Route::get('/', [FronEndController::class, 'welcome']);
Route::get('/banner', [FronEndController::class, 'banner'])->name('banner');
Route::post('/add/banner', [FronEndController::class, 'add_banner'])->name('add.banner');
Route::get('/single/product/{slug}', [FronEndController::class, 'single_product'])->name('single.product');
Route::get('/customer', [FronEndController::class, 'customer'])->name('customer');
Route::post('/getsizeid', [FronEndController::class, 'getsizeid']);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
// USER //
Route::get('/user', [HomeController::class, 'user'])->name('user');
Route::get('/user/delete/{user_id}', [HomeController::class, 'user_delete'])->name('user.delete');
Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
Route::post('/edit/profile', [HomeController::class, 'edit_profile'])->name('edit.profile');
Route::post('/edit/password', [HomeController::class, 'edit_password'])->name('edit.password');
Route::post('/edit/photo', [HomeController::class, 'edit_photo'])->name('edit.photo');
// CATEGORY //
Route::get('/category', [CategoryController::class, 'category'])->name('category');
Route::post('/add/category', [CategoryController::class, 'Add_category'])->name('add.category');
Route::get('/edit/category/{category_id}', [CategoryController::class, 'edit_category'])->name('edit.category');
Route::post('/update/category}', [CategoryController::class, 'update_category'])->name('update.category');
Route::get('/delete/category/{category_id}}', [CategoryController::class, 'delete_category'])->name('delete.category');
Route::get('/restopre/category/{category_id}}', [CategoryController::class, 'restopre_category'])->name('restopre.category');
Route::get('/hard/delete/category/{category_id}}', [CategoryController::class, 'hard_delete_category'])->name('hard.delete.category');

// SUBCATEGORY //
Route::get('/subcategory', [SubCategoryController::class, 'subcategory'])->name('subcategory');
Route::post('/add/subcategory', [SubCategoryController::class, 'add_subcategory'])->name('add.subcategory');
Route::get('/delete/subcategory/{subcategory_id}', [SubCategoryController::class, 'delete_subcategory'])->name('delete.subcategory');
Route::get('/edit/subcategory/{subcategory_id}', [SubCategoryController::class, 'edit_subcategory'])->name('edit.subcategory');
Route::post('/update/subcategory', [SubCategoryController::class, 'update_subcategory'])->name('update.subcategory');

// Product //
Route::get('/product', [ProductController::class, 'product'])->name('product');
Route::post('/add/product', [ProductController::class, 'add_product'])->name('add.product');
Route::get('/view/product', [ProductController::class, 'view_product'])->name('view.product');
Route::get('/delete/product/{product_id}', [ProductController::class, 'delete_product'])->name('delete.product');
// ajax //
Route::post('/getsubcategory', [ProductController::class, 'getsubcategory']);
// variation //
Route::get('/variation', [ProductController::class, 'variation'])->name('variation');
Route::post('/add/variation', [ProductController::class, 'add_variation'])->name('add.variation');
Route::get('/edit/color/{color_id}', [ProductController::class, 'edit_color'])->name('edit.color');
Route::get('/delete/color/{color_id}', [ProductController::class, 'delete_color'])->name('delete.color');
Route::post('/update/color', [ProductController::class, 'update_color'])->name('update.color');
Route::post('/add/variation', [ProductController::class, 'add_variation'])->name('add.variation');
Route::get('/edit/size/{size_id}', [ProductController::class, 'edit_size'])->name('edit.size');
Route::get('/delete/size/{size_id}', [ProductController::class, 'size_color'])->name('size.color');
Route::post('/update/size', [ProductController::class, 'update_size'])->name('update.size');
// inventory //
Route::get('/inventory/{product_id}', [ProductController::class, 'inventory'])->name('inventory');
Route::post('/add/inventory', [ProductController::class, 'add_inventory'])->name('add.inventory');
Route::get('/delete/inventory/{inventory_id}', [ProductController::class, 'delete_inventory'])->name('delete.inventory');
// customer register //
Route::post('/customer/reg/log', [CustomerREgcontroller::class, 'customer_log_reg'])->name('customer.log.reg');
Route::post('/customer', [CustomerLOGcontroller::class, 'customer_login'])->name('customer.login');
Route::get('/customer/logout', [CustomerLOGcontroller::class, 'customer_logout'])->name('customer.logout');
Route::get('/customer/profile', [CustomerLOGcontroller::class, 'customer_profile'])->name('customer.profile');
Route::get('/customer/status', [CustomerLOGcontroller::class, 'customer_status'])->name('customer.status');
// cart store//
Route::post('/cart/store', [cartcontroller::class, 'cart_store'])->name('cart.store');
Route::get('/cart/remove/{cart_id}', [cartcontroller::class, 'cart_remove'])->name('cart.remove');
Route::get('/wishlist/remove/{wish_id}', [cartcontroller::class, 'wishlist_remove'])->name('wishlist.remove');
Route::get('/view/cart', [FronEndController::class, 'view_cart'])->name('view.cart');
Route::get('/coupon', [HomeController::class, 'coupon'])->name('coupon');
Route::post('/coupon/store', [HomeController::class, 'coupon_store'])->name('coupon.store');
Route::post('/card/update', [FronEndController::class, 'card_update'])->name('card.update');

// checkout//
Route::get('/checkout', [checkoutcontroller::class, 'checkout'])->name('checkout');
Route::post('/getcityid', [checkoutcontroller::class, 'getcityid']);
Route::post('/checkout/store', [checkoutcontroller::class, 'checkout_store'])->name('checkout.store');
Route::get('/order/confirm/{order_id}', [checkoutcontroller::class, 'order_confirm'])->name('order.confirm');
// order//
Route::get('/view/order',[ordercontroller::class,'view_order'])->name('view.order');
Route::post('/order/status',[ordercontroller::class,'order_status'])->name('order.status');

// stripe//
Route::controller(StripePaymentController::class)->group(function(){
    Route::get('stripe', 'stripe');
    Route::post('stripe', 'stripePost')->name('stripe.post');
});

// invoice //
Route::get('/invoice/download/{order_id}',[customercontroller::class,'invoice'])->name('download.order');
Route::get('/test/invoice/{order_id}',[customercontroller::class,'test_invoice'])->name('test.onvoice');
