<?php 
namespace RevCMS\Traits\Router;
trait RouteRegistrarTrait {
	/**
	 * Register Custom Route.
	 * @param  string $routeType 
	 * @param  array  $routeData 
	 * @return mixed            
	 */
	public function register($routeType = 'web', $routeData = array()){
		if(!$routeData || empty($routeData) || !$routeType) return false;

		$route = $routeType . 'Routes';

		return array_push($this->$route, $routeData);
	}
	
	/**
	 * Fetches all custom web routes.
	 * @return array 
	 */
	public function customWebRoutes(){
		return $this->webRoutes;
	}

	/**
	 * Fetches all custom api routes.
	 * @return array 
	 */
	public function customApiRoutes(){
		return $this->apiRoutes;
	}
}