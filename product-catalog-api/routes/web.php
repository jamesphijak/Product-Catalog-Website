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

$router->get('/', function () use ($router) {
    return $router->app->version();
});


$router->group(['prefix' => 'api/v1'], function ($router) {
    // Other
    $router->get('/key', function() { return response()->json(['random_key' => \Illuminate\Support\Str::random(32)]); });
    $router->get('/env', function() { return $_ENV; });
    $router->get('/datetime', function() {
        $datetime = explode(" ", Carbon\Carbon::now()->toDateTimeString());
        return response()->json([
            'date' => $datetime[0],
            'time' => $datetime[1]    
        ]);
        
    });

    // Users
    $router->post('user/register', 'UserController@register');
    $router->post('user/login', ['uses' => 'UserController@login']);
});