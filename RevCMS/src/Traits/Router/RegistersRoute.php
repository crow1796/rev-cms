<?php 
namespace RevCMS\Traits\Router;
trait RegistersRoute {
	/**
	 * Register Custom Route.
	 * @param  array  $routeData 
	 * @return mixed            
	 */
	public function register($routeData = array()){
		if(!$routeData || empty($routeData)) return false;

		if(!isset($routeData['params'])) $routeData['params'] = array();

		return array_push($this->webRoutes, $routeData);
	}
	
	/**
	 * Fetches all custom web routes.
	 * @return array 
	 */
	public function customWebRoutes(){
		return $this->webRoutes;
	}
}