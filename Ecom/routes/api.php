<?php

use App\Http\Controllers\ApiController;
use App\Models\User;
use Facade\FlareClient\Api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/users', [ApiController::class, 'Index']);
Route::post('/login', [ApiController::class, 'Login']);
Route::post('/register', [ApiController::class, 'Register']);
Route::post('/contactus', [ApiController::class, 'ContactUs']);

Route::get('/banners', [ApiController::class, 'Banners']);
Route::get('/categories', [ApiController::class, 'Categories']);
Route::get('/products', [ApiController::class, 'Products']);
Route::get('/product/{id}', [ApiController::class, 'GetProduct']);
Route::get('/category/{id}', [ApiController::class, 'getCategory']);
Route::get('/subcategory/{id}', [ApiController::class, 'GetSubCategory']);
Route::post('/changepassword', [ApiController::class, 'ChangePassword']);
Route::get('/profile/{id}', [ApiController::class, 'UserInfo']);
Route::post('/editprofile', [ApiController::class, 'EditUser']);
Route::get('/coupons', [ApiController::class, 'Coupons']);
Route::post('/logout', [ApiController::class, 'Logout']);
Route::post('/applycoupon', [ApiController::class, 'ApplyCoupon']);
Route::post('/placeorder', [ApiController::class, 'PlaceOrder']);
Route::post('/addtowishlist', [ApiController::class, 'AddToWishlist']);
Route::get('/wishlistproduct/{id}', [ApiController::class, 'WishlistProduct']);
Route::post('/deletewishlistitem', [ApiController::class, 'DeleteItem']);
Route::get('/myorders/{id}', [ApiController::class, 'MyOrders']);
Route::get('/bannerimage', [ApiController::class, 'BannerImage']);
Route::get('/cmsaddress', [ApiController::class, 'CmsAddress']);
