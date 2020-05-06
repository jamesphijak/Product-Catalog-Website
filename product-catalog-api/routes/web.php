<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use \Ramsey\Uuid\Uuid;
use \Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

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
use Illuminate\Http\Request;

$router->get('/', function () use ($router) {
    return $router->app->version();
});

// Public Route (No Require api token)
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

    $router->get('/uuid' ,function() {
        $uuid4 = Uuid::uuid4();
        return response()->json([ 'uuid' => $uuid4->toString()]);
    });

    $router->get('/test_cors' ,function(Request $request) {
        $cors_allow  = explode(',', env('CORS_ORIGIN_URL'));
        $cors = $request->header('Origin');
        $check = in_array($cors, $cors_allow);
        return response()->json(['cors_url' => $cors_allow, 'is_in' => $check]);
    });


    // Users
    $router->group(['prefix' => 'user'], function ($router) {
        $router->post('register', 'UserController@register');
        $router->post('login', ['uses' => 'UserController@login']);
    });
});

// Protected Route (Require api token)
$router->group(['prefix' => 'api/v1', 'middleware' => 'jwt.auth'], function ($router) {
    $router->get('testUser', function(){ return 'User'; });
});

// Protected Route (Require api token with admin role)
$router->group(['prefix' => 'api/v1', 'middleware' => ['jwt.auth','jwt.auth.admin']], function ($router) {
    $router->get('testAdmin', function(){ return 'Admin'; });
});