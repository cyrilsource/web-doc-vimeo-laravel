<?php

use Illuminate\Support\Facades\Route;

// Import des contrôleurs (namespace par défaut)
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\OptionsController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Routes web de l’application (syntaxe Laravel 8 avec ::class).
|
*/

// Accueil
Route::get('/', [ThemeController::class, 'index']);

// Affichage des thèmes (front)
Route::get('/themes', [ThemeController::class, 'index']);

// Affichage d’un thème (front)
Route::get('/themes/{slug}/{id}', [ThemeController::class, 'show']);

// Affichage d’une vidéo (front)
Route::get('/video/{slug}/{id}', [VideoController::class, 'show']);

// Recherche (front)
Route::get('/search/{query?}', [VideoController::class, 'search']);

// Autocomplete (front)
Route::get('/autocomplete', [VideoController::class, 'autocomplete']);

// Page ways (vue statique)
Route::get('/ways', function () {
    return view('ways');
});


/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/

// Accueil admin → nouvelle vue sans Vue.js
Route::get('/admin', fn () => view('admin.home'))->name('admin.home');


Route::match(['GET','POST'], '/admin/search', [VideoController::class, 'searchAdmin'])
    ->name('search-videos');

// Formulaire création vidéo
Route::get('/admin/createVideo', [VideoController::class, 'create']);

// Création vidéo
Route::post('/admin/createVideo', [VideoController::class, 'store']);

Route::match(['GET','POST'], '/admin/deleteVideo/{id}', [VideoController::class, 'destroy']);
Route::match(['GET','POST'], '/admin/deleteVideoPdf/{id}', [VideoController::class, 'destroyPdf']);

// Édition vidéo
Route::get('/admin/editVideo/{id}', [VideoController::class, 'edit']);

// Mise à jour des vignettes (POST)
Route::post('/admin/update-thumbnails', [VideoController::class, 'thumbnails']);

// Liste des thèmes (admin)
Route::get('/admin/themes', [ThemeController::class, 'indexAdmin']);

// Formulaire création thème
Route::get('/admin/createTheme', [ThemeController::class, 'create']);

// Création thème
Route::post('/admin/themes', [ThemeController::class, 'store']);

// Édition thème
Route::get('/admin/editTheme/{id}', [ThemeController::class, 'edit']);

// Mise à jour thème (POST)
Route::post('/admin/editTheme/{id}', [ThemeController::class, 'update']);

Route::match(['GET','POST'], '/admin/deleteTheme/{id}', [ThemeController::class, 'destroy']);
Route::match(['GET','POST'], '/admin/deleteThemePdf/{id}', [ThemeController::class, 'destroyPdf']);

// Mise à jour vidéo (admin)
Route::post('/admin/editVideo/{id}', [VideoController::class, 'update']);

// Options (affichage)
Route::get('/admin/options', [OptionsController::class, 'edit']);

// Options (mise à jour)
Route::post('/admin/options', [OptionsController::class, 'update']);







