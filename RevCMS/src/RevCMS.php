<?php

namespace RevCMS;
use RevCMS\Modules\Mvc\Mvc;
use RevCMS\Modules\Router\Router;
use RevCMS\Modules\Theme\ThemeManager;
use RevCMS\Modules\Dashboard\Dashboard;
use RevCMS\Modules\Cms\Cms;
use RevCMS\Modules\Settings\SettingsManager;
use Illuminate\Container\Container as App;

class RevCMS {

	/**
	 * RevCMS Modules.
	 * 
	 * @var $mvc RevCMS\Modules\Mvc\Mvc
	 * @var $router  RevCMS\Modules\Router\Router
	 * @var $theme  RevCMS\Modules\Theme\ThemeManager
	 * @var $dashboard  RevCMS\Modules\Dashboard\Dashboard
	 * @var $cms  RevCMS\Modules\Cms\Cms
	 */
	protected $mvc;
	protected $router;
	protected $theme;
	protected $dashboard;
	protected $cms;
	protected $settings;

	/**
	 * Instantiate Modules.
	 */
	public function __construct(
		Mvc $mvc,
		Router $router, 
		ThemeManager $theme, 
		Dashboard $dashboard, 
		Cms $cms, 
		SettingsManager $settings){

		$this->mvc = $mvc;
		$this->router = $router;
		$this->theme = $theme;
		$this->dashboard = $dashboard;
		$this->cms = $cms;
		$this->settings = $settings;
	}

	/**
	 * Get Developer's MVC Module Instance.
	 * @return RevCMS\Modules\Mvc\Mvc
	 */
	public function mvc(){
		return $this->mvc;
	}

	/**
	 * Get RevCMS Router Instance.
	 * @return RevCMS\Modules\Mvc\Router 
	 */
	public function router(){
		return $this->router;
	}

	/**
	 * Get RevCMS Theme Manager Intance.
	 * @return RevCMS\Modules\Theme\ThemeManager 
	 */
	public function theme(){
		return $this->theme;
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

	/**
	 * Get RevCMS' SettingsManager Instance.
	 * @return RevCMS\Modules\Settings\SettingsManager 
	 */
	public function settings(){
		return $this->settings;
	}
}