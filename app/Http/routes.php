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
Route::get('/test', function(){
    return Hash::make('123456');
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
    
    Route::get('payments', [
        'as' => 'payments.index',
        'uses' => 'PaymentsController@index']
    );
    Route::get('payments/{id}/show', [
        'as' => 'payments.show',
        'uses' => 'PaymentsController@show'
    ]);

    Route::resource('orders', 'OrdersController');
    Route::resource('orders.address', 'AddressController');
    Route::resource('orders.payment', 'OrderPaymentController');

    Route::group(['prefix' => 'types'], function () {
        Route::resource('addresses', 'AddressTypesController');
        Route::resource('payments', 'PaymentTypesController');
    });

    Route::get('orders/categories/{id}', 'OrdersController@getProductsByCategory');
    Route::get('orders/{order}/payment/type/{id}', 'OrderPaymentController@getPaymentType');
    
    Route::resource('products', 'ProductsController');
    Route::resource('categories', 'CategoriesController');
    
    Route::group(['middleware' => 'isAdmin'], function(){
        Route::resource('users', 'UsersController');
        Route::resource('statuses', 'OrderStatusesController');
        
        Route::group(['prefix' => 'types'], function () {
            Route::resource('address', 'AddressTypesController');
            Route::resource('payment', 'PaymentTypesController');
        });
    });
});