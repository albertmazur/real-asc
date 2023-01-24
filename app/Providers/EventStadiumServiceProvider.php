<?php

namespace App\Providers;

use App\Repository\EventRepository;
use App\Repository\Eloquent\EventRepository as EloquentEventRepository;
use Illuminate\Support\ServiceProvider;

class EventStadiumServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(EventRepository::class, EloquentEventRepository::class);
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
