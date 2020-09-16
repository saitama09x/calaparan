<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Partial_object;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //

        $this->app->bind('App\Services\Partial_object', function ($app) {
          return new Partial_object();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
