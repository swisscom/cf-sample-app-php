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

$router->get('/', function () {
    return response()->json([ 'links' => [
      url('/version'),
      url('/env')
    ]]);
});

$router->get('/version', function () {
    return response()->json([ 'version' => 'Static version ;)']);
});

$router->get('/env', function () {
    return response()->json($_ENV); // don't expose this, it will expose your service settings
});
