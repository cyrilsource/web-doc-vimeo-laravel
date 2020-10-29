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

//display themes on front end
Route::get('/themes', 'ThemeController@index');

//display themes on front end
Route::get('/themes/{id}', 'ThemeController@show');

Route::get('/ways', function () {
    return view('ways');
});

/* admin */

//display form to create themes
Route::get('/admin', 'ThemeController@create');

//create a new theme
Route::post('/admin', 'ThemeController@store');

//edit theme
Route::get('/admin/editTheme/{id}', 'ThemeController@edit');

//update theme
Route::post('/admin/editTheme/{id}', 'ThemeController@update');

//delete theme
Route::post('/admin/deleteTheme/{id}', 'ThemeController@destroy');

//display form to create videos
Route::get('/admin/videos', 'VideoController@create');

//create a new video
Route::post('/admin/videos', 'VideoController@store');

//delete video
Route::post('/admin/deleteVideo/{id}', 'VideoController@destroy');

//edit video
Route::get('/admin/editVideo/{id}', 'VideoController@edit');

//display options page
Route::get('/admin/options', 'OptionsController@edit');

//update theme
Route::post('/admin/options', 'OptionsController@update');
