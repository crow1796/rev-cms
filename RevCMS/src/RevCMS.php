<?php

namespace RevCMS;
use RevCMS\Modules\Mvc\Mvc;
use RevCMS\Modules\Mvc\Router;
class RevCMS {

	protected $mvcInstance;
	protected $routerInstance;

	public function __construct(){
		$this->mvcInstance = new Mvc();
		$this->routerInstance = new Router();
	}

	/**
	 * Get Developer's MVC Module Instance.
	 * @return RevCMS\Modules\Mvc\Mvc
	 */
	public function mvc(){
		return $this->mvcInstance;
	}

	/**
	 * Get RevCMS Router Instance.
	 * @return RevCMS\Modules\Mvc\Router 
	 */
	public function router(){
		return $this->routerInstance;
	}
}