<?php

namespace App\Providers;

use App\Services\TopicService;
use Illuminate\Support\ServiceProvider;

class TopicServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {

        $this->app->singleton(TopicService::class, function ($app) {
            return new TopicService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
