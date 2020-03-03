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

        $this->publishes([
            $this->getConfigFile() => config_path('nova-excel.php'),
        ], 'config');
    }

    public function register()
    {
        $this->mergeConfigFrom(
            $this->getConfigFile(),
            'nova-excel'
        );
    }

    /**
     * Register the tool's routes.
     *
     * @return void
     */
    protected function routes()
    {
        if (!config('nova-excel.add_routes')) return;
        if ($this->app->routesAreCached()) {
            return;
        }

        Route::middleware(['nova'])
            ->prefix('nova-vendor/maatwebsite/laravel-nova-excel')
            ->group(__DIR__ . '/../routes/api.php');
    }

    protected function getConfigFile(): string
    {
        return __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'nova-excel.php';
    }
}
