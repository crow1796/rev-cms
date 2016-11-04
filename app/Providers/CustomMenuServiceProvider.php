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
                ->register(array(
                        'uri' => '/custom-menu',
                        'uses' => 'CustomMenuController@index',
                        'title' => 'Menu 1',
                        'iconClass' => 'revicon-package',
                        'params' => array(
                            'middleware' => array(),
                            ),
                        'children' => array(
                                array(
                                        'uri' => '/custom-submenu-1',
                                        'uses' => 'CustomMenuController@submenu1',
                                        'title' => 'SubMenu 1',
                                        'params' => array(),
                                    ),
                            ),
                    ));
    }
}
