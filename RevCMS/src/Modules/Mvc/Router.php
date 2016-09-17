<?php 
namespace RevCMS\Modules\Mvc;
use Route;
class Router {

	/**
	 * Web Routes
	 * @return void 
	 */
	public function webRoutes(){
		Route::group(['prefix' => \Config::get('revcms.uri'), 'namespace' => 'RevCMS'], function(){
			Route::get('/', 'DashboardController@index');
			Route::resource('/pages', 'PagesController');
			Route::get('/media', 'MediaController@index');
			Route::group(['prefix' => 'settings'], function(){
				Route::get('/settings', 'SettingsController@index');
				// Route::get('/admin/settings/backend', 'AdminSettingsController@index');
			});

			Route::group(['prefix' => 'developer', 'namespace' => 'Developer'], function(){
				Route::group(['prefix' => 'mvc'], function(){
					Route::group(['prefix' => 'controllers'], function(){
						Route::get('/', 'ControllersController@index');
					});

					Route::group(['prefix' => 'models'], function(){
						Route::get('/', 'ModelsController@index');
					});

					Route::group(['prefix' => 'views'], function(){
						Route::get('/', 'ViewsController@index');
					});
				});
			});
		});
	}

	/**
	 * Api Routes
	 * @return  void
	 */
	public function apiRoutes(){
		Route::group(['prefix' => 'revcms', 'namespace' => 'RevCMS\Developer'], function(){
			Route::get('/developer/mvc/controllers', 'ControllersController@allControllers');
			Route::post('developer/mvc/controllers/make', 'ControllersController@create');
			Route::get('/developer/mvc/controllers/get-content', 'ControllersController@getContent');
		});
	}
}