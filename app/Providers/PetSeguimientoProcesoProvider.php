<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\PetSeguimientoProcesoInterface;
use App\Repositories\PetSeguimientoRepository;

class PetSeguimientoProcesoProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind(PetSeguimientoProcesoInterface::class, PetSeguimientoRepository::class);
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
