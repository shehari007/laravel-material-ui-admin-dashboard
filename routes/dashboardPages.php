<?php

use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GeneralSettingsController;
use App\Http\Controllers\InboxController;
use App\Http\Controllers\NewsAndUpdateController;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
*/

// ------  General Settings Routes Start -------------------------------- ///

Route::get('/generalSettings', [GeneralSettingsController::class,'index1'], function () {
    return view('/dashboard/pages/generalSettings');
})->middleware(['auth', 'verified'])->name('generalSettingshome');

Route::post('/generalSettings/{type}', [GeneralSettingsController::class, 'superUpdate'], function () {
    return view('/dashboard/pages/generalSettings');
})->middleware(['auth', 'verified'])->name('generalSettings');

// ------  General Settings Routes End -------------------------------- ///


// ------  Inbox Messages Routes Start -------------------------------- ///

Route::get('/inbox', [InboxController::class,'getInbox'], function () {
    return view('/dashboard/pages/inbox');
})->middleware(['auth', 'verified'])->name('inboxhome');

Route::post('/inbox/{id}', [InboxController::class,'deleteInbox'], function () {
    return view('/dashboard/pages/inbox');
})->middleware(['auth', 'verified'])->name('inbox');

Route::post('/inbox/selectedAction/{type}', [InboxController::class,'selectedAction'])->name('inbox');

// ------  Inbox Messages Routes End -------------------------------- ///


// ------  News And Updates Routes Start -------------------------------- ///

Route::get('/newsAndupdates',[NewsAndUpdateController::class, 'getNewsAndUpdates'], function () {
    return view('/dashboard/pages/newsAndupdates');
})->middleware(['auth', 'verified'])->name('newsAndupdateshome');

Route::post('/newsAndupdates/insertNew',[NewsAndUpdateController::class, 'insertNew'], function () {
    return view('/dashboard/pages/newsAndupdates');
})->middleware(['auth', 'verified'])->name('newsAndupdates');

Route::post('/newsAndupdates/editNews/{id}',[NewsAndUpdateController::class, 'editNews'], function () {
    return view('/dashboard/pages/newsAndupdates');
})->middleware(['auth', 'verified'])->name('newsAndupdates');

Route::post('/newsAndupdates/{id}', [NewsAndUpdateController::class,'deleteNews'], function () {
    return view('/dashboard/pages/newsAndupdates');
})->middleware(['auth', 'verified'])->name('newsAndupdates');

Route::post('/newsAndupdates/deleteSelected/{type}', [NewsAndUpdateController::class,'deleteSelectedNews'])->name('newsAndupdates');

// ------  Inbox Messages Routes End -------------------------------- ///


// ------  Blogs Routes Start -------------------------------- ///
Route::get('/blog', [BlogController::class, 'getBlogs'], function () {
    return view('/dashboard/pages/blog');
})->middleware(['auth','verified'])->name('bloghome');

Route::post('/blog/insertNewBlog', [BlogController::class, 'insertNewBlog'], function () {
    return view('/dashboard/pages/blog');
})->middleware(['auth','verified'])->name('blog');

Route::post('/blog/deleteSelected/{typeBlog}', [BlogController::class, 'deleteSelectedBlogs'])->name('blog');

Route::post('/blog/editBlogs/{id}',[BlogController::class, 'editBlogs'], function () {
    return view('/dashboard/pages/blog');
})->middleware(['auth', 'verified'])->name('blog');

Route::post('/blog/{id}', [BlogController::class,'deleteBlog'], function () {
    return view('/dashboard/pages/blog');
})->middleware(['auth', 'verified'])->name('blog');



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