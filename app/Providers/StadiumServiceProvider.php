<?php

namespace App\Providers;

use App\Repository\StadiumRepository;
use App\Repository\Eloquent\StadiumRepository as EloquentStadiumRepository;
use Illuminate\Support\ServiceProvider;

class StadiumServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(StadiumRepository::class, EloquentStadiumRepository::class);
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
