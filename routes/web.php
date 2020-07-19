<?php

use Illuminate\Support\Str;
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

// $router->get('/', function () use ($router) {
//     return $router->app->version();
// });

$router->get('/', function () use ($router) {
    return view('welcome');
});

//Generate APP_KEY
$router->get('/key', function() {
    return Str::Random(32);
});

$router->get('/todo', 'ToDoModule\ToDoController@index');
$router->get('/todo/{id}', 'ToDoModule\ToDoController@show');
$router->post('/todo', 'ToDoModule\ToDoController@store');
$router->put('/todo/{id}', 'ToDoModule\ToDoController@update');
$router->delete('/todo/{id}', 'ToDoModule\ToDoController@destroy');