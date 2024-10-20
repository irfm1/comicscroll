<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');




    Route::post('/get-comic', 'App\Http\Controllers\CrawllerController@getComic')->name('getComic');

    Route::get('comics', 'App\Http\Controllers\ComicController@index')->name('api.comics.index');

    Route::post('comics', 'App\Http\Controllers\ComicController@store')->name('comics.store');
    Route::put('comics/{comic}', 'App\Http\Controllers\ComicController@update')->name('comics.update');
    Route::delete('comics/{comic}', 'App\Http\Controllers\ComicController@destroy')->name('comics.destroy');

    Route::get('chapters', 'App\Http\Controllers\ChapterController@index')->name('chapters.index');
    Route::post('chapters', 'App\Http\Controllers\ChapterController@store')->name('chapters.store');
    Route::put('chapters/{chapter}', 'App\Http\Controllers\ChapterController@update')->name('chapters.update');
    Route::delete('chapters/{chapter}', 'App\Http\Controllers\ChapterController@destroy')->name('chapters.destroy');

    Route::get('pages', 'App\Http\Controllers\PageController@index')->name('pages.index');
    Route::post('pages', 'App\Http\Controllers\PageController@store')->name('pages.store');
    Route::put('pages/{page}', 'App\Http\Controllers\PageController@update')->name('pages.update');
    Route::delete('pages/{page}', 'App\Http\Controllers\PageController@destroy')->name('pages.destroy');

