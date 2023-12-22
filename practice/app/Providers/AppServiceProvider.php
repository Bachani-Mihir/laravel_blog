<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

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
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

         Blade::if('admin', function () {
            return auth()->check() && auth()->user()->role === 'admin';
        });

        Blade::if('user', function () {
            return auth()->check() && auth()->user()->role === 'user';
        });
     /*    Blade::directive('admin', function () {
            return "<?php if(auth()->check() && @can('admin')): ?>";
        });

        Blade::directive('endadmin', function () {
            return "<?php endif; ?>";
        }); */
    }
}
