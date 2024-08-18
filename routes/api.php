<?php

use App\Http\Controllers\Api\SportController;
use App\Http\Controllers\Api\FacilityController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


//for manage specific days
Route::post('/schedules', 'ScheduleController@store');

//for multiple images and videos
Route::post('/sports/{sport}/media', 'Api\MediaController@store')->name('media.store');
Route::put('/sports/{sport}/media', 'Api\MediaController@update')->name('media.update');
Route::delete('/media/{media}', 'Api\MediaController@destroy')->name('media.destroy');

//for sport
Route::apiResource('sport', SportController::class);
//for facility
Route::apiResource('facility', FacilityController::class);
//
Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function () {
    Route::post('/create-offer', 'AdminController@createOffer')->name('create-offer');
    Route::post('/edit-offer/{id}', 'AdminController@editOffer')->name('edit-offer');
    Route::get('/delete-offer/{id}', 'AdminController@deleteOffer')->name('delete-offer');
    Route::post('/create-discount', 'AdminController@createDiscount')->name('create-discount');
    Route::post('/edit-discount/{id}', 'AdminController@editDiscount')->name('edit-discount');
    Route::get('/delete-discount/{id}', 'AdminController@delete')->name('delete-discount');
    Route::get('/payments', 'AdminController@viewPayments')->name('view-payments');
    Route::get('/payments/filter', 'AdminController@filterPayments')->name('filter-payments');
});
//
Route::apiResource('articles', 'Api\ArticleController');
//
Route::post('articles/{id}/tags', 'Api\ArticleController@addTag');
