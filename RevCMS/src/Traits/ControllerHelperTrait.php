<?php

namespace RevCMS\Traits;
use Artisan;
trait ControllerHelperTrait {
	/**
	 * Make a controller
	 * @param  string  $name     
	 * @param  boolean $resource 
	 * @return mixed            
	 */
	public function makeController($name, $resource = false){
		return Artisan::call('make:controller', [
			'name' => $name,
			'--resource' => $resource,
			]);
	}

	/**
	 * Get All Controllers from "base path" specified in the config.
	 * @return array
	 */
	public function allControllers(){
		$baseDir = base_path(trim(config('revcms.controller_base_path'), '/'));
		$directories = \File::directories($baseDir);
		array_push($directories, $baseDir);

		$controllers = array_map(function($dir){
		    if(strpos($dir, 'RevCMS')) return false;
		    return array_map(function($file) use ($dir){
		        $file = trim($file, base_path());
		        return (trim(\App::getNamespace(), '\\') . (ucfirst(preg_replace('/\//', '\\', trim($file, '.php')))));
		    }, \File::files($dir));
		}, $directories);

		$controllers = collect($controllers)
		                ->flatten()
		                ->filter(function($item){
		                    return $item;
		                })
		                ->pipe(function($collection){
		                    return $collection->splice(0, $collection->count() - 1);
		                })
		                ->toArray();
		return $controllers;
	}
}