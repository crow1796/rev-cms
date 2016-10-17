<?php

namespace RevCMS;
use RevCMS\Modules\Mvc\Mvc;
use RevCMS\Modules\Router\Router;
use RevCMS\Modules\Theme\ThemeManager;
use RevCMS\Modules\Dashboard\Dashboard;
use RevCMS\Modules\Cms\Cms;

class RevCMS {

	/**
	 * RevCMS Modules.
	 * 
	 * @var $mvcInstance RevCMS\Modules\Mvc\Mvc
	 * @var $routerInstance  RevCMS\Modules\Router\Router
	 * @var $themeInstance  RevCMS\Modules\Theme\ThemeManager
	 * @var $dashboard  RevCMS\Modules\Dashboard\Dashboard
	 * @var $cms  RevCMS\Modules\Cms\Cms
	 */
	protected $mvcInstance;
	protected $routerInstance;
	protected $themeInstance;
	protected $dashboard;
	protected $cms;

	/**
	 * Instantiate Modules.
	 */
	public function __construct(){
		$this->mvcInstance = new Mvc();
		$this->routerInstance = new Router();
		$this->themeInstance = new ThemeManager();
		$this->dashboard = new Dashboard();
		$this->cms = new Cms();
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

	/**
	 * Get RevCMS Dashboard Instance.
	 * @return RevCMS\Modules\Dashboard\Dashboard 
	 */
	public function dashboard(){
		return $this->dashboard;
	}

	/**
	 * Get RevCMS' CMS Instance.
	 * @return RevCMS\Modules\Cms\Cms 
	 */
	public function cms(){
		return $this->cms;
	}
}