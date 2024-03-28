<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix'=> 'randName',
    'as'=>'post.',
    'namaspace'=>'App\Http\Controllers',
], function (){
        //Route::get('/posts', 'PostController@index')->name('index');
        Route::get('/posts', [App\Http\Controllers\PostController::class, 'index'])
            ->name('index') //Without namespace
            ->withoutMiddleware('auth');
        //Route::get('/posts/{post}', 'PostController@show')->name('show');
        Route::get('/posts/{post}', [App\Http\Controllers\PostController::class, 'show'])->name('show');
        
        //Route::patch('/posts/{post}', 'PostController@update')->name('update');
        Route::patch('/posts/{post}', [App\Http\Controllers\PostController::class, 'update'])->name('update');

        //Route::delete('/posts/{post}', 'PostController@destroy')->name('destroy');
        Route::delete('/posts/{post}', [App\Http\Controllers\PostController::class, 'destroy'])->name('destroy');

        //Route::post('/posts', 'PostController@create')->name('create');
        Route::post('/posts', [App\Http\Controllers\PostController::class, 'store'])->name('store');
    }
);