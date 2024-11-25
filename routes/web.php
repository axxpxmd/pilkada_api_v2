<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Http\Controllers\TpsController;

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
    return 'dibuat dengan kasih sayang';
});

$router->get('get-tps-belum-kota', 'TpsController@getTpsBelumByKota');
$router->get('get-tps-belum-kecamatan/{id_kota}', 'TpsController@getTpsBelumByKecamatan');
$router->get('get-tps-belum-kelurahan/{id_kecamatan}', 'TpsController@getTpsBelumByKelurahan');
