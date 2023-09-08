<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoriesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GeneralSettingsController;
use App\Http\Controllers\InboxController;
use App\Http\Controllers\NewsAndUpdateController;
use App\Http\Controllers\PhotoslidesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\WebpagesController;

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

// ------  Blogs Routes End -------------------------------- ///


// ------  Web Pages Routes Start -------------------------------- ///

Route::get('/webPages', [WebpagesController::class, 'getWebPages'],function () {
    return view('/dashboard/pages/webPages');
})->middleware(['auth','verified'])->name('webPageshome');

Route::post('/webPages/insertNewWebPage', [WebpagesController::class, 'insertNewWebPage'],function () {
    return view('/dashboard/pages/webPages');
})->middleware(['auth','verified'])->name('webPages');


Route::post('/webPages/editWebPages/{id}', [WebpagesController::class, 'editWebPage'],function () {
    return view('/dashboard/pages/webPages');
})->middleware(['auth','verified'])->name('webPages');

Route::post('/webPages/{id}', [WebpagesController::class, 'deleteWebPage'],function () {
    return view('/dashboard/pages/webPages');
})->middleware(['auth','verified'])->name('webPages');

Route::post('/webPages/deleteSelected/{typeWebPage}', [WebpagesController::class, 'deleteSelectedWebPages'],function () {
    return view('/dashboard/pages/webPages');
})->middleware(['auth','verified'])->name('webPages');


// ------- Web Pages Routes End -------------------------------- //




// -------- Products Routes Start -------------------------------- //


Route::get('/products', [ProductsController::class, 'getProducts'], function () {
    return view('/dashboard/pages/products');
})->middleware(['auth','verified'])->name('productshome');


Route::post('/products/insertNewProduct', [ProductsController::class, 'insertNewProduct'], function () {
    return view('/dashboard/pages/products');
})->middleware(['auth','verified'])->name('products');

Route::post('/products/{id}', [ProductsController::class, 'deleteProduct'], function () {
    return view('/dashboard/pages/products');
})->middleware(['auth','verified'])->name('products');


Route::post('/products/deleteSelected/{typeProduct}', [ProductsController::class, 'deleteSelectedProducts'], function () {
    return view('/dashboard/pages/products');
})->middleware(['auth','verified'])->name('products');


Route::post('/products/editProduct/{id}', [ProductsController::class, 'editProduct'], function () {
    return view('/dashboard/pages/products');
})->middleware(['auth','verified'])->name('products');



Route::get('/products/category', [CategoriesController::class, 'getCategories' ], function () {
    return view('/dashboard/pages/category');
})->middleware(['auth','verified'])->name('categoryhome');


Route::post('/products/category/insertNewCategory', [CategoriesController::class, 'insertNewCategory' ], function () {
    return view('/dashboard/pages/category');
})->middleware(['auth','verified'])->name('category');



Route::post('/products/category/editCategory/{id}', [CategoriesController::class, 'editCategory' ], function () {
    return view('/dashboard/pages/category');
})->middleware(['auth','verified'])->name('category');


Route::post('/products/category/{id}', [CategoriesController::class, 'deleteCategory' ], function () {
    return view('/dashboard/pages/category');
})->middleware(['auth','verified'])->name('category');


Route::post('/products/category/deleteSelected/{typeCategory}', [CategoriesController::class, 'deleteSelectedCategories' ], function () {
    return view('/dashboard/pages/category');
})->middleware(['auth','verified'])->name('category');


// -------- Products Routes End -------------------------------- //




// -------- Services Routes Start -------------------------------- //

Route::get('/services', [ServicesController::class, 'getServices'],  function () {
    return view('/dashboard/pages/services');
})->middleware(['auth','verified'])->name('serviceshome');


Route::post('/services/insertNewService', [ServicesController::class, 'insertNewService'],  function () {
    return view('/dashboard/pages/services');
})->middleware(['auth','verified'])->name('services');

Route::post('/services/editService/{id}', [ServicesController::class, 'editService'],  function () {
    return view('/dashboard/pages/services');
})->middleware(['auth','verified'])->name('services');


Route::post('/services/deleteService/{id}', [ServicesController::class, 'deleteService'],  function () {
    return view('/dashboard/pages/services');
})->middleware(['auth','verified'])->name('services');

Route::post('/services/deleteSelected/{typeService}', [ServicesController::class, 'deleteSelectedServices'],  function () {
    return view('/dashboard/pages/services');
})->middleware(['auth','verified'])->name('services');


// -------- Services Routes End -------------------------------- //



// --------- PhotoSlider Routes Start --------------------------------///

Route::get('/photoSlider',[PhotoslidesController::class, 'getPhotoSliders'], function () {
    return view('/dashboard/pages/photoSlider');
})->middleware(['auth','verified'])->name('photoSliderhome');


Route::post('/photoSlider/insertNewSlider',[PhotoslidesController::class, 'insertNewSlider'], function () {
    return view('/dashboard/pages/photoSlider');
})->middleware(['auth','verified'])->name('photoSlider');


Route::post('/photoSlider/deleteSlide/{id}',[PhotoslidesController::class, 'deleteSlide'], function () {
    return view('/dashboard/pages/photoSlider');
})->middleware(['auth','verified'])->name('photoSlider');


Route::post('/photoSlider/editSlide/{id}',[PhotoslidesController::class, 'editSlide'], function () {
    return view('/dashboard/pages/photoSlider');
})->middleware(['auth','verified'])->name('photoSlider');


Route::post('/photoSlider/deleteSelectedSlides/{typeSlide}',[PhotoslidesController::class, 'deleteSelectedSlides'], function () {
    return view('/dashboard/pages/photoSlider');
})->middleware(['auth','verified'])->name('photoSlider');

// -------- PhotoSlider Routes End -------------------------------- ///


Route::get('/photoGallery', function () {
    return view('/dashboard/pages/photoGallery');
})->middleware(['auth','verified'])->name('photoGallery');



Route::get('/videoGallery', function () {
    return view('/dashboard/pages/videoGallery');
})->middleware(['auth','verified'])->name('videoGallery');




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