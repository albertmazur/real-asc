<?php

namespace App\Providers;

use App\Repository\CommentRepository;
use App\Repository\Eloquent\CommentRepository as EloquentCommentRepository;
use Illuminate\Support\ServiceProvider;

class CommentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(CommentRepository::class, EloquentCommentRepository::class);
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
