<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if(env("APP_SCHEME") == "http"){
            URL::forceScheme("http");
        }elseif(env("APP_SCHEME") == "https"){
            URL::forceScheme("https");
        }
    }
}
