<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::prefix('v1') // This includes 'v1' name in routes uri automatically, run php artisan route:list and see result under URI collumn
    ->group(function () {

        // call class to require routes recursively
        \App\Helper\Routes\RouteHelper::includeRoutes(__DIR__ . '/api/v1');

        // this are requiring the files one by one
        /* require __DIR__.'/api/v1/users.php';
        require __DIR__.'/api/v1/posts.php';
        require __DIR__.'/api/v1/comments.php'; */
    });

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
