<?php 
namespace RevCMS\Modules\Dashboard\Factories;
use Route;

class SidebarMenu{

	protected $methods;

	public function __construct(){
		$this->methods = [
			'get',
			'post',
			'patch',
			'put',
			'delete',
		];
	}

	public function makePage($uri = null, $action = null){
		return $this->makeAction('get', $uri, $action);
	}

	public function makeAction($method = null, $uri = null, $action = null){
		if(!$uri || !$action || !$method || !in_array($method, $this->methods)) return false;
		$uri = config('revcms.uri') . '/' . trim($uri, '/');
		return Route::{$method}($uri, ['uses' => $action]);
	}
}