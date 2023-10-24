<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::controller(User::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/detail/{id_user}', 'detail');
    Route::get('/delete/{id_user}', 'delete');
    Route::post('/add', 'add');
    Route::put('/edit', 'edit');
    Route::post('/findStates', 'findStates');
    Route::get('/filter/{id_area}', 'filter');
});
