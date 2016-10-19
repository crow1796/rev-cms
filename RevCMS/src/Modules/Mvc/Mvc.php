<?php 
namespace RevCMS\Modules\Mvc;
use RevCMS\Modules\Mvc\Helpers\Controller;
use RevCMS\Traits\Mvc\ControllerHelperTrait;

class Mvc {
	use ControllerHelperTrait;
	protected $controllerHelper;

	public function __construct(){
		$this->controllerHelper = new Controller();
	}
}