<?php 
namespace RevCMS\Modules\Cms\Builder;
use RevCMS\Modules\Cms\Builder\Abstracts\PageBuilder;
use File;

class RouteBuilder extends PageBuilder {

	/**
	 * Create route for new page.
	 * @param  array  $page 
	 * @return mixed       
	 */
	public function buildFor($page = array()){
		parent::buildFor($page);

		$route = "Route::get('{$page['slug']}', ['uses' => '\\{$page['controller']}@{$page['action_name']}']);";
		$revWebRoutesPath = base_path('routes/revcms_web.php');
		$routeMatch = str_replace('\\', '\\\\', $route);
		$routeMatch = preg_replace('~([\(|\)|\[|\]])~si', '\\\$1', $routeMatch);
		preg_match('~' . $routeMatch . '~is', File::get($revWebRoutesPath), $matches);
		if(!count($matches)){
			$route = "\n" . $route;
			File::append($revWebRoutesPath, $route);
		}
		return $page;
	}
}