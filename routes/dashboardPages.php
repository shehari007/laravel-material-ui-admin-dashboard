<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GeneralSettingsController;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
*/

Route::get('/generalSettings', [GeneralSettingsController::class,'index1'], function () {
    return view('/dashboard/pages/generalSettings');
})->middleware(['auth', 'verified'])->name('generalSettingshome');

Route::post('/generalSettings/{type}', [GeneralSettingsController::class, 'superUpdate'], function () {
    return view('/dashboard/pages/generalSettings');
})->middleware(['auth', 'verified'])->name('generalSettings');

// Route::get('/inbox', [inboxController::class, 'index'])->middleware(['auth', 'verified'])->name('inbox');

Route::get('/inbox', function () {
    return view('/dashboard/pages/inbox/inbox');
})->middleware(['auth', 'verified'])->name('inbox');

Route::get('/newsAndupdates', function () {
    return view('/dashboard/pages/newsAndupdates');
})->middleware(['auth', 'verified'])->name('newsAndupdates');

Route::get('/blog', function () {
    return view('/dashboard/pages/blog');
})->middleware(['auth','verified'])->name('blog');

Route::get('/photoGallery', function () {
    return view('/dashboard/pages/photoGallery');
})->middleware(['auth','verified'])->name('photoGallery');

Route::get('/photoSlider', function () {
    return view('/dashboard/pages/photoSlider');
})->middleware(['auth','verified'])->name('photoSlider');

Route::get('/videoGallery', function () {
    return view('/dashboard/pages/videoGallery');
})->middleware(['auth','verified'])->name('videoGallery');

Route::get('/services', function () {
    return view('/dashboard/pages/services');
})->middleware(['auth','verified'])->name('services');

Route::get('/products', function () {
    return view('/dashboard/pages/products');
})->middleware(['auth','verified'])->name('products');

Route::get('/webPages', function () {
    return view('/dashboard/pages/webPages');
})->middleware(['auth','verified'])->name('webPages');

Route::get('/references', function () {
    return view('/dashboard/pages/references');
})->middleware(['auth','verified'])->name('references');

Route::get('/branches', function () {
    return view('/dashboard/pages/branches');
})->middleware(['auth','verified'])->name('branches');

Route::get('/locations', function () {
    return view('/dashboard/pages/locations');
})->middleware(['auth','verified'])->name('locations');

Route::get('/documents', function () {
    return view('/dashboard/pages/documents');
})->middleware(['auth','verified'])->name('documents');