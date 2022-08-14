<?php

namespace App\Providers;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config ;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use NumberFormatter;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('currency',function($app){
            return new NumberFormatter(App::currentLocale(), NumberFormatter::CURRENCY);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        JsonResource::withoutWrapping();
        if(App::environment('production')){
            Config::set('app.debug',false);
        }

        Validator::extend('filter' , function($attribute,$value){
            if($value == 'god'){
                return false;
            }

            return true;
        }, 'this word valied');
        Paginator::useBootstrap();
    }
}
