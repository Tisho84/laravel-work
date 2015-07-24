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

use Illuminate\Support\Facades\Mail;

Route::get('/test', function(){

});

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
    'auth'     => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

Route::group(['middleware' => 'auth'], function () {
    Route::get('profile', [
        'as'   => 'viewProfile',
        'uses' => 'UsersController@viewProfile'
    ]);
    Route::put('profile', [
        'as'   => 'updateProfile',
        'uses' => 'UsersController@updateProfile'
    ]);

    Route::resource('orders', 'OrdersController');
    Route::resource('orders.address', 'AddressController');
    Route::resource('orders.products', 'OrderProductsController');
    
    Route::resource('products', 'ProductsController');
    Route::resource('categories', 'CategoriesController');
    Route::get('orders/{order}/cancel', ['as' => 'orders.cancel', 'uses' => 'OrdersController@cancel']);

    Route::group(['middleware' => 'isAdmin'], function(){
        Route::resource('users', 'UsersController');
    });
});