<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
$api = app('Dingo\Api\Routing\Router');

$api->version('v1', ['namespace' => 'App\Http\Controllers\Api', 'middleware' => ['api']], function ($api) {
    /** @var Dingo\Api\Routing\Router $api */

    $api->group(array('prefix' => 'auth', 'namespace' => 'Auth', 'as' => 'auth.'), function ($api) {
        $api->post('login',                 'LoginController@login');

    });

    //Private Routes
    $api->group(array('middleware' => ['jwt.auth']), function ($api) {
        $api->group(array('prefix' => 'transaction', 'namespace' => 'Transaction', 'as' => 'transaction.'), function ($api) {
            $api->post('create',        'TransactionController@createTransaction');
            $api->get('sent',           'TransactionController@sentTransactions');
            $api->get('income',         'TransactionController@incomeTransactions');
        });
    });
});