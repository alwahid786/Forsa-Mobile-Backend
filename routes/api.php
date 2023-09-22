<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\StripeController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Auth Routes (without Authentication)
Route::post('/register', [AuthController::class, 'signup']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/forgot-password', [AuthController::class, 'forgotEmail']);
Route::post('/verify/otp', [AuthController::class, 'verifyOtp']);
Route::post('/reset/password', [AuthController::class, 'resetPassword']);

// Social Logins 
Route::post('/social-login', [AuthController::class, 'handleSocialiteCallback']);

// Setting Routes (without Authentication)
Route::post('/contact', [ContactController::class, 'contactUs']);

// Auth Routes (with Authentication)
Route::middleware('auth:api')->group(function () {
    Route::post('/switch-profile', [AuthController::class, 'updateToVendorProfile']);
});
// ------------------------Admin Routes---------------------------
// Category Routes (with Authentication)
Route::group(
    ['prefix' => 'category', 'middleware' => ['api', 'auth:api']],
    function () {
        Route::post('/add-category', [CategoryController::class, 'addCategory']);
        Route::post('/list', [CategoryController::class, 'categoryList']);
    }
);
Route::middleware('auth:api')->group(function () {
    Route::post('/add/banner', [AdminController::class, 'addBanner']);
    Route::get('/banners/list', [AdminController::class, 'allBanners']);
    Route::post('/add/size', [AdminController::class, 'addSize']);
    Route::post('/sizes', [AdminController::class, 'getSizes']);
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/brands', [AdminController::class, 'brands']);
});

// -------------------------------------Vendor Routes-------------------------------------

// Product Routes (with Authentication)
Route::group(
    ['prefix' => 'product', 'middleware' => ['api', 'auth:api']],
    function () {
        Route::post('/add-product', [ProductController::class, 'addProduct']);
    }
);

// Vendor Dashboard Routes (with Authentication)
Route::group(
    ['prefix' => 'vendor', 'middleware' => ['api', 'auth:api']],
    function () {
        Route::post('/dashboard', [VendorController::class, 'dashboardData']);
        Route::get('/stripe_connect_url', [StripeController::class, 'stripeConnectUrl']);
        Route::post('/withdraw', [StripeController::class, 'withdrawAmount']);
        Route::post('/product/add-to-sold', [ProductController::class, 'addToSoldProduct']);
        Route::post('/product/delete', [ProductController::class, 'deleteProduct']);
        Route::post('/location', [VendorController::class, 'addUpdateLocation']);
        Route::get('/get-location', [VendorController::class, 'getLocation']);
        Route::get('/check-stripe', [VendorController::class, 'checkStripe']);
    }
);
Route::get('vendor/stripe_redirect_url', [StripeController::class, 'stripeRedirectUrl']);


// ------------------User Side Routes---------------------
// User Dashboard Routes (with Authentication)
Route::group(
    ['prefix' => 'user', 'middleware' => ['api', 'auth:api']],
    function () {
        Route::post('/dashboard', [UserController::class, 'dashboardData']);
        Route::post('/product/detail', [ProductController::class, 'productDetail']);
        Route::post('/search/product', [ProductController::class, 'searchProducts']);
        Route::post('/update-profile', [UserController::class, 'updateProfile']);
    }
);

// User Order Routes (with Authentication)
Route::group(
    ['prefix' => 'user', 'middleware' => ['api', 'auth:api']],
    function () {
        Route::post('/payment-intent', [OrderController::class, 'paymentIntent']);
        Route::post('/place-order', [OrderController::class, 'placeOrder']);
        Route::get('/order-history', [OrderController::class, 'orderHistory']);
        Route::post('/add-favourite', [ProductController::class, 'addToFavourite']);
        Route::post('/add-review', [OrderController::class, 'addReview']);
        Route::get('/favourites-list', [ProductController::class, 'favouritesList']);
    }
);

// Common Chat Routes (with Authentication)
Route::group(
    ['prefix' => 'chat', 'middleware' => ['api', 'auth:api']],
    function () {
        Route::post('/send-message', [ChatController::class, 'sendMessage']);
        Route::get('/all-chats', [ChatController::class, 'allChats']);
        Route::post('/chat-details', [ChatController::class, 'chatDetail']);
    }
);

// Settings Routes (with Authentication)
Route::group(
    ['prefix' => 'settings'],
    function () {
        Route::post('/get-fileLink', [SettingController::class, 'uploadFile']);
    }
);

// Common Routes (with Authentication)
Route::group(
    ['prefix' => 'common', 'middleware' => ['api', 'auth:api']],
    function () {
        Route::post('/change-order-status', [OrderController::class, 'changeOrderStatus']);
        Route::get('/notifications', [NotificationController::class, 'getNotifications']);
        Route::post('/notifications/mark-read', [NotificationController::class, 'markNotificationAsRead']);
        Route::post('/notifications/delete', [NotificationController::class, 'deleteNotification']);
    }
);
