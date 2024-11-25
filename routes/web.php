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

// Belum
$router->get('get-tps-belum-kota', 'TpsBelumController@getTpsBelumByKota');
$router->get('get-tps-belum-kecamatan/{id_kota}', 'TpsBelumController@getTpsBelumByKecamatan');
$router->get('get-tps-belum-kelurahan/{id_kecamatan}', 'TpsBelumController@getTpsBelumByKelurahan');

// Sudah
$router->get('get-tps-sudah-kota', 'TpsSudahController@getTpsSudahByKota');
$router->get('get-tps-sudah-kecamatan/{id_kota}', 'TpsSudahController@getTpsSudahByKecamatan');
$router->get('get-tps-sudah-kelurahan/{id_kecamatan}', 'TpsSudahController@getTpsSudahByKelurahan');
