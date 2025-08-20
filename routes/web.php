<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StripeController;

Route::get('/', function () {
    return view('welcome');
});



//user routes
Route::get('/moon', [UserController::class, 'home'])->name('home');
Route::get('/moon/signup', [UserController::class, 'signup'])->name('signup');
Route::post('/moon/signup', [UserController::class, 'signupPost'])->name('signupPost');
Route::get('/moon/signin', [UserController::class, 'signin'])->name('signin');
Route::post('/moon/signin', [UserController::class, 'signinPost'])->name('signinPost');
Route::get('/moon/logout', [UserController::class, 'logout'])->name('logout');
Route::get('/moon/cart', [UserController::class, 'AddToCart'])->name('showCart');
Route::get('/moon/wishlist', [UserController::class, 'AddToWishlist'])->name('showWishlist');



//product routes
Route::get('/moon/products', [ProductController::class, 'showAllproducts'])->name('showallproducts');
Route::get('/moon/products/{id}', [ProductController::class, 'showDetailproduct'])->name('showDetail');
Route::post('/moon/Cartdetail/{id}', [ProductController::class, 'saveToCart'])->name('saveCart');
Route::get('/moon/CartItemRemove/{id}', [ProductController::class, 'cartItemRemove'])->name('cartItemRemove');
Route::post('/moon/Wishlistdetail/{id}', [ProductController::class, 'saveToWishlist'])->name('saveWishlist');
Route::get('/moon/wishlistItemRemove/{id}', [ProductController::class, 'wishlistItemRemove'])->name('wishlistItemRemove');
Route::get('/moon/orderdetail', [ProductController::class, 'orderDetail'])->name('order_detail');
Route::post('/moon/placeorder', [ProductController::class, 'placeOrder'])->name('place_order');
Route::get('/moon/currentorder', [ProductController::class, 'getCurrent'])->name('get_current');
Route::get('/moon/category/{category}', [ProductController::class, 'showCategory'])->name('show_category');
Route::get('/moon/search', [ProductController::class, 'searchProducts'])->name('search');




//Admin routes
Route::get('/admin', [AdminController::class, 'index'])->name('admin_index');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin_login');
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin_dashboard');
Route::get('/admin/sale', [AdminController::class, 'sale'])->name('admin_sale');

Route::get('/admin/order', [AdminController::class, 'order'])->name('admin_order');
Route::get('/admin/changeStatus/{oid}', [AdminController::class, 'changeStatus'])->name('admin_changeStatus');

Route::get('/admin/product', [AdminController::class, 'product'])->name('admin_product');
Route::get('/admin/product/delete/{id}', [AdminController::class, 'productDelete'])->name('admin_productDelete');
Route::get('/admin/product/edit/{id}', [AdminController::class, 'productEdit'])->name('admin_productEdit');
Route::post('/admin/product/update/{id}', [AdminController::class, 'productUpdate'])->name('admin_productUpdate');

Route::get('/admin/newproduct', [AdminController::class, 'newproduct'])->name('admin_newproduct');
Route::post('/admin/product/add', [AdminController::class, 'addProduct'])->name('admin_addProduct');

Route::get('/admin/customer', [AdminController::class, 'customer'])->name('admin_customer');
Route::get('/admin/customerHistory,{id}', [AdminController::class, 'customerHistory'])->name('admin_cusHistory');

Route::get('/admin/createaccount', [AdminController::class, 'createaccount'])->name('admin_createaccount');
Route::Post('/admin/addAccount', [AdminController::class, 'addAccount'])->name('admin_addAccount');

Route::get('/admin/homepage', [AdminController::class, 'homepageDesign'])->name('admin_homepage');
Route::post('/admin/homepage/carouselUpdate/{id}', [AdminController::class, 'carouselUpdate'])->name('admin_carouselUpdate');
Route::post('/admin/homepage/bannerUpdate/{id}', [AdminController::class, 'bannerUpdate'])->name('admin_bannerUpdate');
Route::put('/admin/homepage/productUpdate/{id}', [AdminController::class, 'productWithModelsUpdate'])->name('admin_productWithModelsUpdate');


Route::get('/admin/setting', [AdminController::class, 'setting'])->name('admin_setting');
Route::post('/admin/updateAccount', [AdminController::class, 'updateProfile'])->name('admin_updateProfile');

Route::get('/admin/message', [AdminController::class, 'message'])->name('admin_message');
Route::get('/admin/deleteMessage/{id}', [AdminController::class, 'deleteMessage'])->name('admin_deleteMessage');
Route::get('/admin/bookMessage', [AdminController::class, 'bookMessage'])->name('admin_bookMessage');
Route::get('/admin/deleteAppointments/{id}', [AdminController::class, 'deleteAppointments'])->name('admin_deleteAppointments');

Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin_logout');
Route::get('/admin/search', [AdminController::class, 'searchProduct'])->name('admin_search');




//headerFooter routes
Route::get('/moon/aboutUs', [UserController::class, 'aboutUs'])->name('aboutUs');
Route::get('/moon/bookAppoint', [UserController::class, 'book'])->name('book');
Route::post('/moon/book', [UserController::class, 'appointment'])->name('bookAppointment');
Route::get('/moon/location', [UserController::class, 'location'])->name('location');
Route::get('/moon/privacy', [UserController::class, 'privacy'])->name('privacy');
Route::get('/moon/termsOfUs', [UserController::class, 'termsOfUs'])->name('termsOfUs');
Route::get('/moon/cookie', [UserController::class, 'cookie'])->name('cookie');
Route::get('/moon/careers', [UserController::class, 'careers'])->name('careers');
Route::get('/moon/contactUs', [UserController::class, 'contactUs'])->name('contactUs');
Route::post('/moon/Contact', [UserController::class, 'saveMessage'])->name('saveContact');




// Payment for Stripe
Route::controller(StripeController::class)->group(function () {
    Route::get('/stripe', 'stripe')->name('stripe'); // Add a name for GET request
    Route::post('/stripe', 'stripePost')->name('stripe.post');
});