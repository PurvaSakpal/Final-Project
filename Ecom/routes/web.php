<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CMSController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\OrderDetailsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubCategoryController;
use App\Models\SubCategory;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//user routes start
Route::get('/adduser',[UserController::class,'AddUser'])->name('add.user');
Route::get('/showuser',[UserController::class,'ShowUser'])->name('show.user');
Route::post('/postadduser',[UserController::class,'PostAddUser'])->name('post.add.user');
Route::get('/edituser/{id}',[UserController::class,'EditUser'])->name('edit.user');
Route::post('/postedituser',[UserController::class,'PostEditUser'])->name('post.edit.user');
Route::post('/deleteuser',[UserController::class,'DeleteUser'])->name('delete.user');
//User routes ends

//Banner Routes starts
Route::get('/banner/addbanner',[BannerController::class,'AddBanner'])->name('add.banner');
Route::post('banner/postaddBanner',[BannerController::class,'PostAddBanner'])->name('post.add.banner');
Route::get('/banner/showbanner',[BannerController::class,'ShowBanner'])->name('show.banner');
Route::get('/banner/editbanner/{id}',[BannerController::class,'EditBanner'])->name('edit.banner');
Route::post('/banner/posteditbanner',[BannerController::class,'PostEditBanner'])->name('post.edit.banner');
Route::patch('/banner/deletebanner',[BannerController::class,'DeleteBanner'])->name('delete.banner');
//Banner Routes end

//Category Routes start
Route::get('/category/addcategory',[CategoryController::class,'AddCategory'])->name('add.category');
Route::post('/category/postaddcategory',[CategoryController::class,'AddPostCategory'])->name('add.post.category');
Route::get('/category/showcategory',[CategoryController::class,'ShowCategory'])->name('show.category');
Route::get('/category/editcategory/{id}',[CategoryController::class,'EditCategory'])->name('edit.category');
Route::post('/category/posteditcategory',[CategoryController::class,'PostEditCategory'])->name('post.edit.category');
Route::post('/category/deletecategory',[CategoryController::class,'DeleteCategory'])->name('delete.category');

//Sub Category Start
Route::get('/subcategory/addsubcategory',[SubCategoryController::class,'AddSubCategory'])->name('add.subcategory');
Route::post('/subcategory/postaddsubcategory',[SubCategoryController::class,'PostAddCategory'])->name('add.post.subcategory');
Route::get('/subcategory/showsubcategory',[SubCategoryController::class,'ShowSubCategory'])->name('show.subcategory');
Route::get('/subcategory/editsubcategory/{id}',[SubCategoryController::class,'EditSubCategory'])->name('edit.subcategory');
Route::post('/subcategory/posteditcategory',[SubCategoryController::class,'PostEditSubCategory'])->name('post.edit.subcategory');
Route::post('/subcategory/deletesubcategory',[SubCategoryController::class,'DeleteSubCategory'])->name('delete.subcategory');

//Product Routes
Route::get('/products/addproduct',[ProductController::class,'AddProduct'])->name('add.product');
Route::post('/products/postaddproduct',[ProductController::class,'PostAddProduct'])->name('post.add.product');
Route::get('/products/showproducts',[ProductController::class,'ShowProducts'])->name('show.products');
Route::get('/products/editproduct/{id}',[ProductController::class,'EditProduct'])->name('edit.product');
Route::post('/products/posteditproduct',[ProductController::class,'PostEditProduct'])->name('post.edit.product');
Route::post('/products/deleteproduct',[ProductController::class,'DeleteProduct'])->name('delete.product');

//Coupon Routes
Route::get('/coupons/showcoupons',[CouponController::class,'ShowCoupons']);
Route::get('/coupons/addcoupon',[CouponController::class,'AddCoupon'])->name('add.coupon');
Route::post('/coupons/addpostcoupon',[CouponController::class,'AddPostCoupon'])->name('add.post.coupon');
Route::get('/coupons/editcoupon/{id}',[CouponController::class,'EditCoupon']);
Route::post('/coupons/editpostcoupon',[CouponController::class,'EditPostCoupon'])->name('edit.post.coupon');
Route::post('/coupons/deletecoupon',[CouponController::class,'DeleteCoupon']);

//Contact Us Routes
Route::get('/contact/showcontactdetails',[ContactController::class,'ShowContactDetails'])->name('show.contact.details');

//Add Banner Image
Route::get('/cms/addbannerimage',[CMSController::class,'AddBannerImage']);
Route::post('/cms/postaddbannerimage',[CMSController::class,'PostAddBannerImage'])->name('post.add.bannerimage');
Route::get('/cms/showbannerimage',[CMSController::class,'ShowBannerImage'])->name('show.banner.image');
Route::post('/cms/deletebannerimage',[CMSController::class,'DeleteBannerImage'])->name('delete.banner.image');

//Show Order Details
Route::get('/order/orderdetails',[OrderDetailsController::class,'ShowOrderDetails'])->name('show.orderdetails');
Route::get('/order/orderinfo/{id}',[OrderDetailsController::class,'OrderInfo'])->name('order.info');
