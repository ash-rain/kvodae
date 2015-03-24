<?php

Route::get('/', 'WelcomeController@index');

Route::get('home', 'ProductController@index');

Route::get('language/{locale}', function($locale){
	Session::set('lang', $locale);
	return back();
});

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
	'checkout' => 'CheckoutController'
]);

Route::model('templates', 'App\Template');
Route::model('products', 'App\Product');
Route::model('images', 'App\Image');

Route::resources([
	'templates' => 'TemplateController',
	'products' => 'ProductController',
	'images' => 'ImageController',
	'cart' => 'CartController',
]);