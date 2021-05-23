<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

//use Illuminate\Http\Response;

$router->get('/', function () use ($router) {
    return response(['error' => ['code' => 418, 'description' => 'I\'m a teapot']], 418);
});

$router->group(['prefix' => 'account'], function () use ($router) {

    $router->post('/login', 'Account\LoginController@login');
    $router->post('/signup', 'Account\SignupController@signup');

});


$router->group(['prefix' => 'catalog'], function () use ($router) {

    $router->get('/films', 'Catalog\FilmsController@getAllFilms');
    $router->get('/films/{id:[0-9]+}', 'Catalog\FilmsController@displayInfo');
    $router->get('/films/{slug}', 'Catalog\FilmsController@fetchBySlug');
    // TODO: what languages a film is available in
    $router->get('/films/{id}/languages', 'Catalog\FilmsController@getFilmLanguages');

});

$router->get('/info', 'UserController@displayInfo');