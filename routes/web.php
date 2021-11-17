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

Route::get('/', 'ThemeController@index');

//display themes on front end
Route::get('/themes', 'ThemeController@index');

//display theme on front end
Route::get('/themes/{slug}/{id}', 'ThemeController@show');

//display video on front end
Route::get('/video/{slug}/{id}', 'VideoController@show');

//display search
Route::get('/search/{query?}', 'VideoController@search');

Route::get('/ways', function () {
    return view('ways');
});

/* admin */

//display list of videos
Route::get('/admin/', 'VideoController@index');

Route::post('/admin/search', ['as' => 'search-videos', 'uses' => 'VideoController@searchAdmin']);

//display form to create videos
Route::get('/admin/createVideo', 'VideoController@create');

//create a new video
Route::post('/admin/createVideo', 'VideoController@store');

//delete video
Route::post('/admin/deleteVideo/{id}', 'VideoController@destroy');

//edit video
Route::get('/admin/editVideo/{id}', 'VideoController@edit');

//update video thumbnails
Route::post('/admin/update-thumbnails', 'VideoController@thumbnails');

//display list of themes
Route::get('/admin/themes', 'ThemeController@indexAdmin');

//display form to create themes
Route::get('/admin/createTheme', 'ThemeController@create');

//create a new theme
Route::post('/admin/themes', 'ThemeController@store');

//edit theme
Route::get('/admin/editTheme/{id}', 'ThemeController@edit');

//update theme
Route::post('/admin/editTheme/{id}', 'ThemeController@update');

//delete theme
Route::post('/admin/deleteTheme/{id}', 'ThemeController@destroy');

//update theme
Route::post('/admin/editVideo/{id}', 'VideoController@update');

//display options page
Route::get('/admin/options', 'OptionsController@edit');

//update theme
Route::post('/admin/options', 'OptionsController@update');
