<?php

namespace RevCMS;
use RevCMS\Modules\Mvc\Mvc;
use RevCMS\Modules\Router\Router;
use RevCMS\Modules\Theme\ThemeManager;

class RevCMS {

	protected $mvcInstance;
	protected $routerInstance;

	/**
	 * Instantiate Modules.
	 */
	public function __construct(){
		$this->mvcInstance = new Mvc();
		$this->routerInstance = new Router();
		$this->themeInstance = new ThemeManager();
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

	/**
	 * Get RevCMS Theme Manager Intance.
	 * @return RevCMS\Modules\Theme\ThemeManager 
	 */
	public function theme(){
		return $this->themeInstance;
	}
}