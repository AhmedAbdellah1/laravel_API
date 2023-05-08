<?php

use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;
use PhpParser\Node\Expr\AssignOp\Pow;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast;





Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
});


Route::middleware(['jtw.verify'])->group(function () {
    Route::get('/posts', [PostController::class, 'index']);
    Route::post('/posts/{id}', [PostController::class, 'update']);
    Route::get('/posts/{post}', [PostController::class, 'show']);
    Route::post('/posts', [PostController::class, 'store']);
    Route::post('/posts/{post}', [PostController::class, 'destroy']);
});
