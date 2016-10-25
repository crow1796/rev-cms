<?php 
namespace RevCMS\Traits\Cms\Builder;

trait PermalinkValidatorTrait{
	/**
	 * Validate if permalink already exists, generate new if exists.
	 * @param  string $permalink 
	 * @return string            
	 */
	private function validatePermalink($permalink){
	    $routeCollection = \Route::getRoutes()->get('GET');
	    $webRoutes = array();
	    foreach($routeCollection as $route){
	        array_push($webRoutes, $this->getWebRoute($route));
	    }

	    $webRoutes = $this->removeEmptyRoutesFrom($webRoutes);
	    $webRoutes = $this->removeRevCMSRoutesFrom($webRoutes);
	    
	    return $this->tryAndGeneratePermalink($webRoutes, $permalink);
	}

	/**
	 * Generate new permalink if already exists
	 * @param  RouteCollection  $webRoutes  
	 * @param  string  $permalink  
	 * @param  integer $startCount 
	 * @return string              
	 */
	private function tryAndGeneratePermalink($webRoutes, $permalink, $startCount = 0){
	    $permalink = trim($permalink, '/');
	    foreach($webRoutes as $route){
	        if(strcasecmp(trim($route->getPath(), '/'), $permalink) !== 0) continue;
	        $startCount++;
	        $permalink = preg_replace('/^(.+)\-' . ($startCount - 1) . '$/', '\\1', $permalink);
	        $permalink = $this->tryAndGeneratePermalink($webRoutes, $permalink . '-' . $startCount, $startCount);
	    }
	    return $permalink;
	}

	/**
	 * Get only web routes.
	 * @param  mixed $route 
	 * @return mixed        
	 */
	private function getWebRoute($route){
	    if(is_array($route->getAction()['middleware']) && in_array('web', $route->getAction()['middleware'])){
	        return $route;
	    }

	    if($route->getAction()['middleware'] == 'web'){
	        return $route;
	    }

	    return false;
	}

	/**
	 * Remove empty routes.
	 * @param  RouteCollection $webRoutes 
	 * @return array            
	 */
	private function removeEmptyRoutesFrom($webRoutes){
	    $filteredWebRoutes = array();
	    foreach($webRoutes as $route){
	        if(!$route) continue;

	        array_push($filteredWebRoutes, $route);
	    }
	    return $filteredWebRoutes;
	}

	/**
	 * Remove RevCMS' default routes.
	 * @param  RouteCollection $webRoutes 
	 * @return array            
	 */
	private function removeRevCMSRoutesFrom($webRoutes){
	    $filteredWebRoutes = array();
	    foreach($webRoutes as $route){
	        if(strpos($route->getAction()['uses'], 'RevCMS')) continue;

	        array_push($filteredWebRoutes, $route);
	    }
	    return $filteredWebRoutes;
	}
}