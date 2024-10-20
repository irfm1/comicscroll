<?php

use App\Models\Comic;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard', function () {
        //get all comics for the loged user
        $comics = Comic::all();
        return view('dashboard')->with('comics', $comics);
    })->name('dashboard');

    Route::post('/get-comic', 'App\Http\Controllers\CrawllerController@getComic')->name('getComic');
    Route::get('/comics/{comic}', 'App\Http\Controllers\ComicController@show')->name('showComic');
    Route::get('/comics/{comic}/{chapter}', 'App\Http\Controllers\ChapterController@show')->name('showChapter');

    Route::get('/comics/{comic}/{chapter}/{page_id}', 'App\Http\Controllers\PageController@setImage')->name('setImage-Pages');
});



