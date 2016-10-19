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
                        'action' => 'CustomMenuController@index',
                        'type' => 'get',
                        'title' => 'Menu 1',
                        'iconClass' => 'fa fa-file-o',
                    ));

        \RevCMS::router()
                ->register('web', array(
                        'uri' => '/custom-menu-2',
                        'action' => 'CustomMenuController@show',
                        'type' => 'get',
                        'title' => 'Menu 2',
                        'iconClass' => 'fa fa-file-o',
                    ));
    }
}
