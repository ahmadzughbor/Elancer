<?php

use App\Http\Controllers\freelancer\profileController;
use App\Http\Controllers\freelancer\ProposalsController;
use App\Models\Proposal;
use Illuminate\Support\Facades\route;

route::group([
'prefix'=> 'freelancer',
'as'=>'freelancer.',
'middleware'=>['auth']
],function(){
   // route::get('proposals','ProposalsController@index')->name('proposals.index');
    route::get('proposals/{project}/create',[ProposalsController::class,'create'])->name('proposals.create');
    route::post('proposals/{project}/create',[ProposalsController::class,'store'])->name('proposals.store');

    route::get('proposals/',[ProposalsController::class,'index'])->name('proposals.index');
    route::get('profile',[profileController::class,'edit'])->name('profile.edit');
    route::put('profile',[profileController::class,'update'])->name('profile.update');
} );

