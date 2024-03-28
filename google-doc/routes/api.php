<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
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
        require __DIR__.'/api/v1/users.php';
        require __DIR__.'/api/v1/posts.php';
        require __DIR__.'/api/v1/comments.php';
    });

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
