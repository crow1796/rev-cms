<?php 
namespace RevCMS\Modules\Mvc\Helpers;
use RevCMS\Modules\Mvc\Contracts\MVCContract;
use File;

abstract class AbstractMVCHelper implements MVCContract{
	public abstract function make($name, $resource = false);
	public abstract function all();
	public abstract function getFrom($directories = array());
	public abstract function format($controllers = array());
	public abstract function getContent($controller = null);
	public abstract function deleteSubject($subjects = array());

	/**
	 * Update content.
	 * @param  array $newData 
	 * @return mixed          
	 */
	public function updateContent($newData){
		return File::put(base_path($newData['path']), $newData['content']);
	}
} 