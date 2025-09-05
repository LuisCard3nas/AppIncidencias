<?php

namespace App\Modules\Incidents;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class IncidentsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Cargar vistas del módulo
        $this->loadViewsFrom(__DIR__.'/Resources/views', 'incidents');
        
        // Cargar rutas del módulo con middleware web
        Route::middleware('web')
            ->group(__DIR__.'/routes.php');
    }
}
