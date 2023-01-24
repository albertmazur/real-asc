<?php

namespace App\Providers;

use App\Repository\TicketRepository;
use App\Repository\Eloquent\TicketRepository as EloquentTicketRepository;
use Illuminate\Support\ServiceProvider;

class TicketServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(TicketRepository::class, EloquentTicketRepository::class);
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
