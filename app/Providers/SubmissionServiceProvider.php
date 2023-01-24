<?php

namespace App\Providers;

use App\Repository\SubmissionRepository;
use App\Repository\Eloquent\SubmissionRepository as EloquentSubmissionRepository;
use Illuminate\Support\ServiceProvider;

class SubmissionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(SubmissionRepository::class, EloquentSubmissionRepository::class);
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
