<?php

namespace Maatwebsite\LaravelNovaExcel;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class LaravelNovaExcelServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->booted(function () {
            $this->routes();
        });
    }

    /**
     * Register the tool's routes.
     *
     * @return void
     */
    protected function routes()
    {
        if (config('excel_nova.add_routes') !== true) return;
        if ($this->app->routesAreCached()) {
            return;
        }

        Route::middleware(['nova'])
             ->prefix('nova-vendor/maatwebsite/laravel-nova-excel')
             ->group(__DIR__ . '/../routes/api.php');
    }
}
