<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/ways', function () {
    return view('ways');
});

/* admin */

//display form to create themes
Route::get('/admin', 'ThemeController@create');

//create a new theme
Route::post('/admin', 'ThemeController@store');
