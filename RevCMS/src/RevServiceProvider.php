<?php

namespace RevCMS;

use Illuminate\Support\ServiceProvider;

class RevServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('revcms', function(){
            return (new RevCMS());
        });
        $this->app->bind('RevCMS\RevCMS', function(){
           return (new RevCMS()); 
        });
    }
}
