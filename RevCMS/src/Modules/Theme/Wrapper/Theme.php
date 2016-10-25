<?php 
namespace RevCMS\Modules\Theme\Wrapper;

class Theme {

	protected $info;

	public function __construct($themeInfo = array()){
		$this->info = $themeInfo;
	}

	/**
	 * Get theme's path.
	 * @return string 
	 */
	public function getPath(){
		return $this->info['path'];
	}

	/**
	 * Check if the theme is currently used.
	 * @return boolean 
	 */
	public function isActive(){
		return $this->info['active'];
	}

	/**
	 * Get theme's information yaml.
	 * @return array 
	 */
	public function getYaml(){
		return $this->info['info'];
	}

	/**
	 * Get theme's screenshot.
	 * @return string 
	 */
	public function getScreenshot(){
		return $this->info['info']['screenshot'];
	}
}