<?php

namespace RevCMS;

use Illuminate\Support\ServiceProvider;
use RevCMS\Modules\Mvc\Mvc;
use RevCMS\Modules\Router\Router;
use RevCMS\Modules\Theme\ThemeManager;
use RevCMS\Modules\Dashboard\Dashboard;
use RevCMS\Modules\Cms\Cms;
use RevCMS\Modules\Cms\Builder\PageDirector;
use RevCMS\Modules\Settings\SettingsManager;

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
            return (new RevCMS(
                new Mvc(),
                new Router(),
                new ThemeManager(),
                new Dashboard(),
                new Cms(new PageDirector($this->app)),
                new SettingsManager()
            ));
        });

        $this->app->singleton('RevCMS\RevCMS', function(){
           return (new RevCMS(
                new Mvc(),
                new Router(),
                new ThemeManager(),
                new Dashboard(),
                new Cms(new PageDirector($this->app)),
                new SettingsManager()
            )); 
        });
    }
}
