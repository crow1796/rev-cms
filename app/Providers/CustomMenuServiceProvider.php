<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class CustomMenuServiceProvider extends ServiceProvider
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
        \RevCMS::router()
                ->register('web', array(
                        'uri' => '/custom-menu',
                        'uses' => 'CustomMenuController@index',
                        'type' => 'get',
                        'title' => 'Menu 1',
                        'iconClass' => 'fa fa-home',
                        'params' => array(),
                    ));
    }
}
