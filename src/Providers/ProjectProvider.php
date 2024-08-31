<?php

namespace AlessandroBertozzi\Project\Providers;

use Illuminate\Support\ServiceProvider;

class ProjectProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
//        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
//        $this->loadViewsFrom(__DIR__.'/../views', 'inspire');
        $this->loadMigrationsFrom(__DIR__.'/../migrations');
        $this->publishes([
            __DIR__.'/../migrations' => database_path('migrations')
        ], 'project-migrations');
        $this->publishes([
            __DIR__.'/../models' => database_path('models')
        ], 'project-models');
    }
}
