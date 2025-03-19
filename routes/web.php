<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClickController;
use App\Http\Controllers\SiteController;


Route::prefix('api')->group(function () {
    Route::post('/clicks', [ClickController::class, 'store']);
    Route::get('/clicks/data/{site_id}', [ClickController::class, 'getClicks']);
    Route::get('/clicks/stats/data/{site_id}', [ClickController::class, 'getClickStats']);
    Route::get('/csrf-token', [SiteController::class, 'getCsrfToken']);
});
Route::get('/clicks/stats/{siteId}', [ClickController::class, 'showStats']);
Route::get('/clicks/{siteId}', [ClickController::class, 'showClicksMap']);
Route::get('/', [SiteController::class, 'index']);
Route::resource('sites', SiteController::class);
Route::get('/track-clicks', function () {
    return view('track_clicks');
})->name('track_clicks');

