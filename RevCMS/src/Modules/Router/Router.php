<?php 
namespace RevCMS\Modules\Router;
use RevCMS\Traits\Router\RegistersRoute;
use Route;
use RevCMS\Modules\Abstracts\RevCMSModule;

class Router extends RevCMSModule {

	use RegistersRoute;

	protected $webRoutes;
	protected $apiRoutes;

	public function __construct(){
		$this->webRoutes = array();
		$this->apiRoutes = array();
	}

	/**
	 * Web Routes
	 * @return void 
	 */
	public function webRoutes(){
		$customWebRoutes = $this->webRoutes;
		Route::group(['prefix' => \Config::get('revcms.uri')], function() use ($customWebRoutes){
			Route::get('/', ['as' => 'revdashboard', 'uses' => '\RevCMS\Http\Controllers\DashboardController@index']);
			Route::get('/login', ['as' => 'revlogin', 'uses' => '\RevCMS\Http\Controllers\Auth\LoginController@showLoginForm']);

			Route::group(['prefix' => 'pages', 'as' => 'revpages.'], function(){
				Route::get('/', ['as' => 'index', 'uses' => '\RevCMS\Http\Controllers\PagesController@index']);
				Route::get('/create', ['as' => 'create', 'uses' => '\RevCMS\Http\Controllers\PagesController@create']);
			});

			Route::group(['prefix' => '/media', 'as' => 'revmedia.'], function(){
				Route::get('/', ['as' => 'library', 'uses' => '\RevCMS\Http\Controllers\MediaController@index']);
			});

			Route::group(['prefix' => 'settings', 'as' => 'revsettings.'], function(){
				Route::get('/', ['as' => 'index', 'uses' => '\RevCMS\Http\Controllers\SettingsController@index']);
				Route::get('/general', ['as' => 'general', 'uses' => '\RevCMS\Http\Controllers\SettingsController@generalSettings']);
				Route::post('/update-general-settings', ['as' => 'updategeneralsettings', 'uses' => '\RevCMS\Http\Controllers\SettingsController@updateGeneralSettings']);
			});
			// Theme Routes
			Route::group(['prefix' => 'themes', 'as' => 'revthemes.'], function(){
				Route::get('/', ['as' => 'installed', 'uses' => '\RevCMS\Http\Controllers\ThemesController@index']);
			});

			Route::group(['prefix' => '/developer', 'as' => 'revdeveloper.'], function(){
				Route::group(['prefix' => '/mvc', 'as' => 'mvc.'], function(){
					Route::get('/', ['as' => 'index', 'uses' => '\RevCMS\Http\Controllers\Developer\MVCController@index']);
					Route::group(['prefix' => 'controllers', 'as' => 'controllers.'], function(){
						Route::get('/', ['as' => 'index', 'uses' => '\RevCMS\Http\Controllers\Developer\ControllersController@index']);
					});

					Route::group(['prefix' => 'models', 'as' => 'models.'], function(){
						Route::get('/', ['as' => 'index', 'uses' => '\RevCMS\Http\Controllers\Developer\ModelsController@index']);
					});

					Route::group(['prefix' => 'views', 'as' => 'views.'], function(){
						Route::get('/', ['as' => 'index', 'uses' => '\RevCMS\Http\Controllers\Developer\ViewsController@index']);
					});
				});
			});

			foreach($customWebRoutes as $route){
				Route::get($route['uri'], $route['params'] + ['uses' => $route['uses']]);
				foreach($route['children'] as $childRoute){
					Route::get($childRoute['uri'], $childRoute['params'] + ['uses' => $childRoute['uses']]);
				}
			}
		});

		include base_path('routes/revcms_web.php');
	}

	/**
	 * Api Routes
	 * @return  void
	 */
	public function apiRoutes(){
		Route::group(['prefix' => 'revcms'], function(){
			Route::group(['prefix' => '/developer/mvc/controllers'], function(){
				Route::get('/', '\RevCMS\Http\Controllers\Developer\ControllersController@allControllers');
				Route::post('/make', '\RevCMS\Http\Controllers\Developer\ControllersController@create');
				Route::post('/delete-controller', '\RevCMS\Http\Controllers\Developer\ControllersController@deleteControllers');
				Route::patch('/update-controller', '\RevCMS\Http\Controllers\Developer\ControllersController@updateController');
				Route::get('/get-content', '\RevCMS\Http\Controllers\Developer\ControllersController@getContent');
			});

			Route::group(['prefix' => 'pages'], function(){
				Route::post('/store', '\RevCMS\Http\Controllers\PagesController@store');
				Route::get('/populate-fields', '\RevCMS\Http\Controllers\PagesController@populateFields');
				Route::get('/generate-fields', '\RevCMS\Http\Controllers\PagesController@generateFields');
			});

			Route::group(['prefix' => 'themes'], function(){
				Route::get('/installed-themes', '\RevCMS\Http\Controllers\ThemesController@getInstalledThemes');
				Route::post('/activate-theme', '\RevCMS\Http\Controllers\ThemesController@activateTheme');
			});
		});
	}
}