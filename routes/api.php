<?php

use App\Http\Controllers\Api\AuthTokensController;
use App\Http\Controllers\Api\ProjectsController;
use App\Http\Middleware\checkApiKey;
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

        Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
            return $request->user();
        });
        // api/projects => index
        // api/projects => store  post
        // api/projects/{project} =>show
        // api/projects{project} => update  put|patch
        // api/projects{project} => delete   delete
        Route::apiResource('projects',ProjectsController::class);
        route::post('auth/tokens',[AuthTokensController::class,'store'])->middleware('guest:sanctum');
        route::get('auth/tokens',[AuthTokensController::class,'index'])->middleware('auth:sanctum');
        route::delete('auth/tokens/{$id}',[AuthTokensController::class,'destroy'])->middleware('auth:sanctum');


