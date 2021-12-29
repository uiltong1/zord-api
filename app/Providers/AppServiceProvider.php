<?php

namespace App\Providers;

use App\Http\Interfaces\DesenvolvedorInterface;
use App\Http\Interfaces\NivelInterface;
use App\Services\DesenvolvedorService;
use App\Services\NivelService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            NivelInterface::class,
            NivelService::class
        );

        $this->app->bind(
            DesenvolvedorInterface::class,
            DesenvolvedorService::class
        );
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
