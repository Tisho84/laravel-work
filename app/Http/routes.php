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

use App\Order;

Route::get('/aa', function(){

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

    Route::resource('products', 'ProductsController');
    Route::resource('categories', 'CategoriesController');
    Route::get('orders/{orders}/cancel', ['as' => 'orders.cancel', 'uses' => 'OrdersController@cancel']);
    Route::post('orders/{orders}', ['as' => 'orders.payment', 'uses' => 'OrdersController@payment']);

    Route::group(['middleware' => 'isAdmin'], function(){
        Route::resource('users', 'UsersController');
    });


    Route::resource('orders', 'OrdersController'); #midleware isActive in construct
    Route::group(['middleware' => 'isActive'], function(){
        Route::resource('orders.address', 'AddressController');
        Route::resource('orders.products', 'OrderProductsController');
    });
});