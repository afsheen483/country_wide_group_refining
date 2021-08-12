<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use DB;
class UserProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        view()->composer('*',function($view){
            $view->with('user_array',\App\Models\User::role('vendor')->get());
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
