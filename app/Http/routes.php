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

$app->get('/', function () {
    return response()->json([ 'links' => [
      url('/version'),
      url('/env'),
      url('/migrate'),
      url('/users'),
      url('/users/add/5'),
      url('/users/delete')
    ]]);
});

$app->get('/version', function () use ($app) {
    return response()->json([ 'version' => $app->version()]);
});

$app->get('/env', function () {
    return response()->json($_ENV);
});

$app->get('/migrate', function () {
    try {
        \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
        return response()->json(['migrated' => true]);
    } catch (Exception $e) {
        return response()->json([
            'error' => $e->getMessage(),
            'trace' => $e->getTrace()
        ]);
    }
});

$app->get('/users/add/{amount}', function ($amount) {
    $faker = Faker\Factory::create();
    $users = [];

    for ($i = 0; $i < $amount; $i++) {
        array_push($users, [
          'firstName' => $faker->firstName,
          'lastName' => $faker->lastName,
          'birthday' => $faker->date(),
          'email' => $i . $faker->email,
          'password' => $faker->password
        ]);
    }
    try {
        \Illuminate\Support\Facades\DB::table('users')->insert($users);
        return response()->json([
          'amount' => $amount,
          'users added' => $users
        ]);
    } catch (Exception $e) {
        return response()->json(
          [
            'error' => $e->getMessage(),
            'trace' => $e->getTrace()
          ]
        );
    }
});

$app->get('/users', function () {
    $result = \Illuminate\Support\Facades\DB::table('users')->get();
    $count = \Illuminate\Support\Facades\DB::table('users')->count();
    return response()->json([
      'count' => $count,
      'users' => $result
    ]);
});

$app->get('/users/delete', function () {
    \Illuminate\Support\Facades\DB::table('users')->truncate();
    $result = \Illuminate\Support\Facades\DB::table('users')->get();
    return response()->json(['users' => $result]);
});
