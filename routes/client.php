<?php

use App\Http\Controllers\client\projectsController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix'=>'client',
    'as'=>'client.',
    'middleware'=>['auth'],
],function(){
    Route::resource('projects',projectsController::class );
});

