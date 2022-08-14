<?php

use App\Events\messageCreated;
use App\Http\Controllers\client\projectsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\ProjectsController as ControllersProjectsController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group([
    'prefix' => LaravelLocalization::setLocale(),
],function (){
    Route::get('/', [HomeController::class,'index'])->name('Home');
});
// Route::get('/', function () {
//     return view('layouts.front');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth:web,admin'])->name('dashboard');

// require __DIR__ . '/auth.php';
// Route::group([
//     'prefix' => 'Admin',
//     'as' => 'admin.',
// ], function () {
//     require __DIR__ . '/auth.php';
// });

Route::get('projects/{project}',[ControllersProjectsController::class,'show'])->name('project.show');
Route::get('messages',[MessagesController::class,'create'])->name('messages');
Route::post('messages',[MessagesController::class,'create']);

Route::get('otp/request',[OtpController::class,'create'])->name('otp.create');
Route::post('otp/request',[OtpController::class,'store']);
Route::get('otp/verify',[OtpController::class,'verifyForm'])->name('otp.verify');
Route::post('otp/verify',[OtpController::class,'verify']);
require __DIR__ . '/dashboard.php';
require __DIR__ . '/freelancer.php';
require __DIR__ . '/client.php';
