<?php

use Illuminate\Support\Facades\Route;

#Shop
Route::prefix('shop')->group( function (){
Route::get('/', 'ShopController@categories');
Route::get('cart', 'ShopController@cart');
Route::get('checkout', 'ShopController@checkout');
Route::get('clear-cart', 'ShopController@clearCart');
Route::get('add-to-cart', 'ShopController@addToCart');
Route::get('update-cart', 'ShopController@updateCart');
Route::get('remove-item/{pid}', 'ShopController@removeItem');
Route::get('{curl}', 'ShopController@products');
Route::get('{curl}/{purl}', 'ShopController@item');
});

#User
Route::prefix('user')->group( function (){
    Route::middleware(['signedguard'])->group(function () {
        Route::get('signin', 'UserController@getSignin');
        Route::post('signin', 'UserController@postSignin');
        Route::get('signup', 'UserController@getSignup');
        Route::post('signup', 'UserController@postSignup');
    });
    Route::middleware(['loginguard'])->group(function () {
        Route::get('profile', 'PagesController@getProfile');
        Route::put('change/pass', 'UserController@updatePassword');
        Route::put('profile/image', 'UserController@updateProfileImage');
        Route::put('info', 'UserController@updateProfileInfo');
    });
    Route::get('logout', 'UserController@logout');
});

#Wishlist
Route::prefix('wishlist')->group( function (){
    Route::middleware(['loginguard'])->group(function () {
        Route::get('/', 'WishlistController@store');
        Route::get('remove', 'WishlistController@destroy');
    }); 
});

# CMS
Route::prefix('cms')->group( function (){
    Route::middleware(['cmsguard'])->group(function (){
        Route::get('dashboard', 'CmsController@dashboard');
        Route::get('orders', 'CmsController@orders');
        Route::resource('menu', 'MenuController');
        Route::resource('content', 'ContentController');
        Route::resource('categories', 'CategoriesController');
        Route::resource('products', 'ProductsController');

        Route::prefix('users')->group( function (){ 
            Route::get('/', 'CmsUserController@index');
            Route::get('create', 'CmsUserController@create');
            Route::get('{id}/edit', 'CmsUserController@edit');
            Route::get('{id}', 'CmsUserController@show');
            Route::post('/', 'CmsUserController@store');
            Route::put('{id}', 'CmsUserController@update');
            Route::delete('{id}', 'CmsUserController@destroy');
         });
        //  Route::prefix('dash')->group( function (){ 
        //     Route::get('users-countries', 'CmsUserController@getUsersCountries');
        //  });
    });
});

#Pages
Route::get('/', 'PagesController@home');
Route::get('/{url}', 'PagesController@content');
Route::get('/autocomplete/{term}', 'PagesController@productsSearch');
