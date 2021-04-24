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

$router->get('/info', 'UserController@displayInfo');
$router->get('/catalog/films', 'Catalog\FilmsController@getAllFilms');
$router->get('/catalog/films/{id}', 'Catalog\FilmsController@displayInfo');
$router->get('/catalog/films/{slug}', 'Catalog\FilmsController@fetchBySlug');
// TODO: what languages a film is available in
$router->get('/catalog/films/{id}/languages', 'Catalog\FilmsController@getFilmLanguages');
