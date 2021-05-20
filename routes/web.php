<?php

use App\Http\Middleware\AdminCheck;
use Illuminate\Support\Facades\Route;

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

Route::prefix('app')->middleware([AdminCheck::class])->group(function(){

    // Route::get('app/all_user_pagi', 'UserController@all_user_pagi');
});

//Category
Route::get('all_category', 'CategoryController@all_category');
Route::get('getCategorywithLimit', 'CategoryController@getCategorywithLimit');
Route::get('app/subcriptions', 'CategoryController@all_subcriptions');

Route::get('/listing_details/single_adds', 'ReportController@single_ads');
Route::get('/listing_details/get_comment', 'ReportController@get_comment');
Route::get('/listing_details/count_total_view', 'ReportController@count_total_view');
//Product
Route::get('/listing_details/{id}', 'ProductController@listing_details')->name('listing_details');
Route::get('all_listing_pagi', 'ProductController@all_listing_pagi');
Route::get('all_lists', 'ProductController@all_lists');
Route::post('add_listing', 'ProductController@add_listing');
Route::get('latest_lists', 'ProductController@latest_lists');
Route::post('change_package','ProductController@change_package');
Route::get('all_color', 'ProductController@all_color');

//Animal type
Route::get('all_animal_type', 'ProductController@all_animal_type');
Route::get('getAnimalTypewithLimit', 'ProductController@getAnimalTypewithLimit');

//Product Report
Route::post('/listing_details/report', 'ReportController@report');
Route::post('/listing_details/post_comment', 'ReportController@post_comment');

//Upload image
Route::post('/upload', 'AdminController@upload');
Route::post('/delete_image', 'AdminController@deleteImage');

//User Profile
Route::get('/user_profile', 'Usercontroller@user_profile')->name('user_profile');
Route::post('/user_profile/edit_user', 'Usercontroller@edit_user');
Route::post('/user_profile/delete_image', 'AdminController@deleteImage');

//User Profile Ads
Route::get('/user_profile/all_listing_user', 'ProductController@all_listing_user');
Route::get('/user_profile/all_category', 'ProductController@all_category');
Route::post('/user_profile/edit_listing', 'ProductController@edit_listing');
Route::post('/user_profile/listing_delete', 'ProductController@listing_delete');
Route::get('/user_profile/get_favorite_list', 'ProductController@get_favorite_list');
Route::post('/user_profile/cancelWishlist', 'ProductController@cancelWishlist');
Route::get('/user_profile/all_animal_type', 'ProductController@all_animal_type');
Route::get('/user_profile/all_breed', 'BreedController@all_breed');
Route::post('/user_profile/submit_subscription', 'Usercontroller@submit_subscription');
Route::post('/user_profile/privacyChange', 'Usercontroller@privacyChange');

//add_wishlists
Route::post('add_wishlists', 'WishlistController@add_wishlists');

//Breed
Route::get('all_breed', 'BreedController@all_breed');
Route::get('getBreedwithLimit', 'BreedController@getBreedwithLimit');

//Message
Route::post('add_message', 'MessageController@add_message');

//Payment routes

Route::post('app/single_charge','PaymentController@single_charge');
Route::post('app/single_change_charge','PaymentController@single_change_charge');
Route::get('/payment/{id}', 'PaymentController@getPaymentpage');
Route::get('/change_package_payment/{id}', 'PaymentController@getchangePaymentpage');

//Tag
Route::get('all_tag','TagController@all_tag'); 

//User
Route::post('registration', 'Usercontroller@registration'); 
Route::post('login', 'Usercontroller@login');
Route::post('forgot_password', 'Usercontroller@passwordToken');
Route::post('PasswordReset', 'Usercontroller@PasswordReset');
Route::get('verification', 'UserController@verification_view');
Route::post('resend_email', 'UserController@resend_email');
Route::get('/logout', 'AdminController@logout');
Route::get('/', 'AdminController@index');

Route::post('submit_subscription', 'Usercontroller@submit_subscription');
Route::post('submit_subscription2', 'Usercontroller@submit_subscription2');
Route::get('/test', 'Usercontroller@test');
Route::get('/checkExpiredDate', 'Usercontroller@checkExpiredDate');
Route::get('/get_settings', 'AdminController@get_settings');

//User public profile  
Route::get('/user-profile/get_user', 'Usercontroller@get_user');
Route::get('/user-profile/get_approved_listing', 'Usercontroller@get_approved_listing');

Route::any('{slug}', 'AdminController@index')->where('slug', '([A-z\d\-\/_.]+)');

// Route::any('{slug}', 'AdminController@index')->where('slug', '[-a-z0-9_\s]+');
