<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
use Illuminate\Support\Facades\Artisan;

$router->get('/', function () use ($router) {
    return $router->app->version();
});

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return '<h1>Cache facade value cleared</h1>';
});

$router->group(['prefix' => 'api'], function () use ($router) {
	
	$router->get('/', function () use ($router) {
		return 'Hai';
	});
	
	$router->post('register', 'UserController@register');
	$router->post('login', 'AuthController@login');
	$router->post('getAvblCarList', 'CarController@getAvblCarList');
});

$router->group(['prefix' => 'api','middleware' => 'auth'], function () use ($router) {
	
	$router->get('getCurrentUser', 'UserController@getCurrentUser');
	$router->get('getUser/{userId}', 'UserController@getUser');
	
	$router->post('addCar', 'CarController@addCar');
	$router->get('getCar/{carId}', 'CarController@getCar');
	$router->post('updateCarInfo', 'CarController@updateCarInfo');
	$router->post('updateCarStatus', 'CarController@updateCarStatus');
	$router->delete('deleteCar/{carId}', 'CarController@deleteCar');
	$router->post('getCarList', 'CarController@getCarList');
});
