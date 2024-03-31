<?php

use Illuminate\Support\Facades\Route;

// can use to create routes quickly, more simple. 
//Route::apiResource('users', App\Http\Controllers\UserController::class);

Route::group([
   /*  'middleware'=> [
        'auth',
    ], */
    'prefix'=> 'randName',
    'as'=> 'users.',
    'namaspace'=> 'App\Http\Controllers',
    
], function(){
    //to get all users data
    Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('index'); //without namespace
    //Route::get('/users', 'UserController@index')->name('index');-----------> //with namespace - helps to minimize the code bruv, same thing as previous line 

    //to get a specified user data
    Route::get('/users/{user}',[App\Http\Controllers\UserController::class, 'show'])
    ->name('show')
    ->withoutMiddleware('auth')//without middleware - can exclude middleware by doing this.
    //->where('user', '[0-9]+') //where() - checks if the endpoint in th uri is only intergers, only goes to controller if integer
    ->whereNumber('user');// same as the previous where() but dont need regular exp.

    //to create a new user
    Route::post('/users', [App\Http\Controllers\UserController::class, 'store'])->name('store');

    //To update a user data
    Route::patch('/users/{user}', [App\Http\Controllers\UserController::class, 'update'])->name('update');

    //to delete a user
    Route::delete('/users/{user}', [App\Http\Controllers\UserController::class, 'destroy'])->name('destroy');
});

