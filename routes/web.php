<?php

use App\Http\Controllers\BusinessCategoryController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\PeoplePdfController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('language/{locale?}', function ($locale = null) {
    if ($locale && in_array($locale, config('app.available_locales'))) {
        app()->setLocale($locale);
        session()->put('locale', $locale);
    }

    return redirect()->back();
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/people-pdf', [PeoplePdfController::class, 'download'])
    ->middleware('auth')->name('people.downloadPDF');

Route::controller(GalleryController::class)->prefix('gallery')->name('gallery')->middleware('auth')->group(function () {
    Route::get('/gallery', 'index')->name('.index');
    Route::get('/notesImages', 'notesImages')->name('.notesImages');
    Route::get('/peopleImages', 'peopleImages')->name('.peopleImages');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(PersonController::class)->prefix('person')->name('person')->middleware('auth')->group(function () {
    Route::get('/', 'index')->name('.index');
    Route::get('/create', 'create')->name('.create');
    Route::post('/store', 'store')->name('.store');
    Route::get('/{person}/show', 'show')->name('.show');
    Route::get('/{person}/edit', 'edit')->name('.edit');
    Route::put('/{person}/update', 'update')->name('.update');
    Route::get('/search', 'search')->name('.search');
    Route::get('/tag/{tag_name}', 'getByTag')->name('.getByTag');
    Route::post('/{person}/mark-as-favorite', 'markAsFavorite')->name('.markAsFavorite');
    Route::post('/{person}/mark-as-normal', 'markAsNormal')->name('.markAsNormal');
    Route::get('/{person}/restore', 'restoreFromTrash')->name('.restoreFromTrash');
    Route::delete('/{person}/destroy', 'destroy')->name('.destroy');
    Route::delete('/{person}/destroyPermanetly', 'destroyPermanetly')->name('.destroyPermanetly');
});

Route::controller(BusinessController::class)->prefix('business')->name('business')->middleware('auth')->group(function () {
    Route::get('/', 'index')->name('.index');
    Route::get('/create', 'create')->name('.create');
    Route::post('/store', 'store')->name('.store');
    Route::get('/{business}/show', 'show')->name('.show');
    Route::get('/{business}/edit', 'edit')->name('.edit');
    Route::put('/{business}/update', 'update')->name('.update');
    Route::get('/search', 'search')->name('.search');
    Route::get('/tag/{tag_name}', 'getByTag')->name('.getByTag');
    Route::get('/category/{category_name}', 'getByCategory')->name('.getByCategory');
    Route::post('/{business}/mark-as-favorite', 'markAsFavorite')->name('.markAsFavorite');
    Route::post('/{business}/mark-as-normal', 'markAsNormal')->name('.markAsNormal');
    Route::get('/{business}/restore', 'restoreFromTrash')->name('.restoreFromTrash');
    Route::delete('/{business}/destroy', 'destroy')->name('.destroy');
    Route::delete('/{business}/destroyPermanetly', 'destroyPermanetly')->name('.destroyPermanetly');
});

Route::get('/favorite', 'FavoriteContactsController')->middleware('auth')->name('favoriteContacts');
Route::get('/trash', 'TrashController')->middleware('auth')->name('trashedContacts');

Route::controller(TaskController::class)->prefix('task')->name('task')->middleware('auth')->group(function(){
    Route::get('/', 'index')->name('.index');
    Route::post('/store', 'store')->name('.store');
    Route::put('/{task}/complete', 'complete')->name('.complete');
});

Route::controller(TagController::class)->prefix('tag')->name('tag')->middleware('auth')->group(function(){
    Route::get('/', 'index')->name('.index');
    Route::get('/create', 'create')->name('.create');
    Route::post('/store', 'store')->name('.store');
    // Route::get('/{tag}/show', 'show')->name('.show');
    Route::get('/{tag}/edit', 'edit')->name('.edit');
    Route::put('/{tag}/update', 'update')->name('.update');
    Route::delete('/{tag}/destroy', 'destroy')->name('.destroy');
});

Route::controller(BusinessCategoryController::class)->prefix('businessCategory')->name('businessCategory')->middleware('auth')->group(function(){
    Route::get('/', 'index')->name('.index');
    Route::get('/create', 'create')->name('.create');
    Route::post('/store', 'store')->name('.store');
    Route::get('/{businessCategory}/edit', 'edit')->name('.edit');
    Route::put('/{businessCategory}/update', 'update')->name('.update');
    Route::delete('/{businessCategory}/destroy', 'destroy')->name('.destroy');
});

Route::controller(NoteController::class)->prefix('note')->name('note')->middleware('auth')->group(function(){
    Route::get('/', 'index')->name('.index');
    Route::get('/create', 'create')->name('.create');
    Route::post('/store', 'store')->name('.store');
    Route::get('/{note}/show', 'show')->name('.show');
    Route::get('/{note}/edit', 'edit')->name('.edit');
    Route::put('/{note}/update', 'update')->name('.update');
    Route::get('/search', 'search')->name('.search');
    Route::get('/tag/{tag_name}', 'getByTag')->name('.getByTag');
    Route::delete('/{note}/destroy', 'destroy')->name('.destroy');
});

require __DIR__.'/auth.php';
