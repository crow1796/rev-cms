<?php 
namespace RevCMS\Modules\Mvc\Helpers;
use RevCMS\Modules\Mvc\Helpers\AbstractMVCHelper;
use File;
use Artisan;

class Controller extends AbstractMVCHelper {

	/**
	 * Make a controller
	 * @param  string  $name     
	 * @param  boolean $resource 
	 * @return mixed            
	 */
	public function make($name, $resource = false){
		$params = [
			'name' => $name,
		];
		if($resource){
			$params['--resource'] = true;
		}
		return Artisan::call('make:controller', $params);
	}

	public function all(){
		$baseDir = base_path(trim(config('revcms.controller_base_path'), '/'));
		$directories = File::directories($baseDir);
		array_push($directories, $baseDir);

		// Get all controllers
		$controllers = $this->getFrom($directories);
		// Format fetched controllers
		$controllers = $this->format($controllers);

		return $controllers;
	}

	/**
	 * Get controllers from specified directories.
	 * @param  array $directories 
	 * @return Illuminate\Support\Collection              
	 */
	public function getFrom($directories = array()){
		if(!$directories) return false;
		$directories = collect($directories);
		$controllers = $directories->map(function($dir){
			if(strpos($dir, 'RevCMS')) return false;

			return collect(File::files($dir))->map(function($file) use ($dir){
				$file = trim($file, base_path());
				return (trim(\App::getNamespace(), '\\') . (ucfirst(preg_replace('/\//', '\\', trim($file, '.php')))));
			});
		});
		return $controllers;
	}

	/**
	 * Format specified controller files.
	 * @param  array  $controllers 
	 * @return array              
	 */
	public function format($controllers = array()){
		if(!$controllers) return false;

		$controllers = collect($controllers)
		                ->flatten()
		                ->filter(function($item){
		                    return $tmp['name'] = $item;
		                })
		                ->map(function($item){
		                    $tmp = [];
		                    $controllerFile = str_replace('\\', '/', (new \ReflectionClass($item))->getFileName());
		                    $basePath = str_replace('\\', '/', base_path());
		                    $tmp['name'] = $item;
		                    $tmp['path'] = str_replace($basePath, '', $controllerFile);
		                    return $tmp;
		                })
		                ->toArray();
		return $controllers;
	}

	/**
	 * Get controllers content.
	 * @param  string $controller 
	 * @return string             
	 */
	public function getContent($controller = null){
		if(!$controller) return false;
		$content = File::get(str_replace('\\', '/', base_path(trim(str_replace('/', '\\', $controller), '\\'))));
		return $content;
	}

	/**
	 * Delete controller(s).
	 * @param  mixed  $controllers 
	 * @return mixed              
	 */
	public function deleteSubject($controllers = array()){
		if(!is_array($controllers)){
			$controller = $controllers;
			return File::delete(base_path($controller));
		}

		foreach($controllers as $controller){
			File::delete(base_path($controller));
		}
		return true;
	}
}