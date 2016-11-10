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
        $this->app->bind('RevCMS\Modules\Mvc\Mvc', 'RevCMS\Modules\Mvc\Mvc');
        $this->app->bind('RevCMS\Modules\Router\Router', 'RevCMS\Modules\Router\Router');
        $this->app->bind('RevCMS\Modules\Theme\ThemeManager', 'RevCMS\Modules\Theme\ThemeManager');
        $this->app->bind('RevCMS\Modules\Dashboard\Dashboard', 'RevCMS\Modules\Dashboard\Dashboard');
        $this->app->bind('RevCMS\Modules\Cms\Cms', 'RevCMS\Modules\Cms\Cms');
        $this->app->bind('RevCMS\Modules\Cms\Builder\PageDirector', 'RevCMS\Modules\Cms\Builder\PageDirector');
        $this->app->bind('RevCMS\Modules\Settings\SettingsManager', 'RevCMS\Modules\Settings\SettingsManager');

        $this->app->singleton('revcms', 'RevCMS\RevCMS');
        $this->app->singleton('RevCMS\RevCMS', 'RevCMS\RevCMS');

        $this->app->bind('RevCMS\Repositories\CMS\PageRepository', 'RevCMS\Repositories\CMS\PageRepository');
    }
}
