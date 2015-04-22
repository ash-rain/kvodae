<?php

Route::get('/', [
	'middleware' => 'guest',
	'uses' => 'HomeController@welcome'
	]);

Route::get('home', 'HomeController@index');

Route::get('language/{locale}', function($locale){
	Session::set('lang', $locale);
	return back();
});

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
	'checkout' => 'CheckoutController',
	'notifications' => 'NotificationController'
]);

Route::model('templates', 'App\Template');
Route::model('products', 'App\Product');
Route::model('images', 'App\Image');
Route::model('vendor', 'App\Vendor');
Route::model('mes', 'App\User');

Route::resources([
	'templates' => 'TemplateController',
	'products' => 'ProductController',
	'images' => 'ImageController',
	'cart' => 'CartController',
	'me' => 'UserController',
]);

Route::group([
	'namespace' => 'Admin',
	'middleware' => 'admin'
	], function() {
		Route::resources([
			'vendor' => 'VendorController'
		]);
	}
);

Route::get('sc', ['middleware' => 'auth', function() {
	return view('starcraft');
}]);