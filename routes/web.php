<?php

use App\Http\Controllers\Site\PageController;
use Illuminate\Support\Facades\Route;


Route::post('submit_product_form/{product}', [PageController::class, 'submitProductForm'])->name('submit-product-form');
Route::get('/az', [PageController::class, 'redirectNoLocale'])->name('redirectNoLocale');

Route::group(
    [
        'prefix' => (request()->segment(1) === 'az' || request()->segment(1) === '') ? '' : LaravelLocalization::setLocale(),
        'middleware' => []
    ], function () {
    Route::get('/', [PageController::class, 'index'])->name('index');
});

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ], function () {
    Route::get('contacts', [PageController::class, 'contacts'])->name('contacts');
    Route::post('contacts', [PageController::class, 'sendContactForm'])->name('send-contact-form');
    Route::get('pages/{staticPage:slug}', [PageController::class, 'staticPage'])->name('static-page');
    Route::get('/{category:slug}/article/{article:slug}', [PageController::class, 'article'])->name('article')->where('category', '.*');
    Route::get('/{category:slug}/product/{product:slug}', [PageController::class, 'product'])->name('product')->where('category', '.*');
    Route::get('/{category:slug}/vacancy/{vacancy:slug}', [PageController::class, 'vacancy'])->name('vacancy');
    Route::get('/{category:slug}', [PageController::class, 'category'])->name('category')->where('category', '.*');
});
