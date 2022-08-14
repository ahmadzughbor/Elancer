<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard\CategoriesController;
use App\Http\Controllers\dashboard\RolesController;

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/',function(){
//     return view('dashboard');
// });
Route::group([
    'prefix'=>'/dashboard',
    'middleware'=> 'auth:web,admin',
    //'as'=>'categories.'
   // 'namespace'=> 'dashboard'
],function(){
    route::resource('roles','App\Http\Controllers\dashboard\RolesController' );
    Route::put('/categories/trash/{category}/restore',[CategoriesController::class,'restore'])->name('categories.restore');
    Route::delete('/categories/trash/{category}/',[CategoriesController::class,'forseDelete'])->name('categories.forceDeleted');
    Route::get('/categories/trash',[CategoriesController::class,'trash'])->name('categories.trash');
    Route::resource('/categories',CategoriesController::class);

    // Route::get('/categories', [CategoriesController::class, 'index'])
    // ->name('index');
    // Route::get('/categories/create',[CategoriesController::class,'create'])
    // ->name('create');
    // Route::get('/category/show/{category}', [CategoriesController::class, 'show'])
    // ->name('show');
    // Route::post('/categories',[CategoriesController::class,'store'])
    // ->name('store');
    // Route::get('/categories/{category}/edit',[CategoriesController::class, 'edit'])
    // ->name('edit');
    // Route::put('/categories/{category}',[CategoriesController::class, 'update'])
    // ->name('update');
    // Route::delete('/categories/{category}',[CategoriesController::class, 'destroy'])
    // ->name('destroy');
});

// Route::get('/dashboard/categories/trash',[CategoriesController::class,'trash'])->name('categories.trash');
