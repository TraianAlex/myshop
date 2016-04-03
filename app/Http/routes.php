<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::resource('about', 'AboutController', ['only' => ['index']]);
//Route::resource('contact', 'ContactController', ['only' => ['create', 'store']]);
Route::get('contact', [
	'as' => 'contact',
    'uses' => 'ContactController@create'
]);
Route::post('contact', [
	'as' => 'contact_store',
    'uses' => 'ContactController@store'
]);

Route::resource('discounts', 'DiscountsController', ['only' => ['index']]);

Route::resource('products', 'ProductController', ['only' => ['index', 'show']]);

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'admin'], function(){
	Route::get('/', 'IndexController@index');
    Route::resource('orders', 'OrderController');
    Route::resource('products', 'ProductController');
});

Route::get('cart', 'CartController@index');
Route::post('cart/store', 'CartController@store');
Route::get('cart/remove/{id}', 'CartController@remove');
Route::post('cart/complete', [
    'as' => 'cart.complete',
    'uses' => 'CartController@complete'
]);

Route::get('products/download/{id}', ['uses' => 'ProductController@download']);

/**
 * Membership routes
 */
Route::get('plans', [
	'as' => 'plans', 'uses' => 'SubscriptionsController@index'
]);
Route::get('plans/subscribe/{planId}', [
    'as' => 'plans.subscribe', 'uses' => 'SubscriptionsController@subscribe'
]);
Route::post('plans/process', [
    'as' => 'plans.process', 'uses' => 'SubscriptionsController@process'
]);
Route::post('plans/coupon', [
    'as' => 'plans.coupon', 'uses' => 'SubscriptionsController@applyCoupon'
]);
Route::post('plans/swap', [
    'as' => 'plans.swap', 'uses' => 'SubscriptionsController@swapPlans'
]);
Route::post('plans/cancel', [
    'as' => 'plans.cancel', 'uses' => 'SubscriptionsController@cancelPlan'
]);
Route::get('invoices', [
    'as' => 'invoices', 'uses' => 'SubscriptionsController@invoices'
]);
Route::get('invoices/download/{id}', [
    'uses' => 'SubscriptionsController@downloadInvoice'
]);

Route::post('checkout', [
    'uses' => 'CheckoutController@index'
]);
Route::get('checkout/thankyou', [
    'as' => 'checkout.thankyou', 'uses' => 'CheckoutController@thankyou'
]);

Route::post('stripe/webhook', 'StripeController@handleWebhook');
