<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use DB;
class MetalProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        view()->composer('*',function($view){
            $view->with('metal_array',DB::table('metals')->get());
            });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
