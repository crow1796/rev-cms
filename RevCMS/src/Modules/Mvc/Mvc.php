<?php 
namespace RevCMS\Modules\Mvc;
use RevCMS\Modules\Mvc\Helpers\Controller;
use RevCMS\Traits\Mvc\ControllerHelperTrait;
use RevCMS\Modules\Abstracts\RevCMSModule;

class Mvc extends RevCMSModule{
	use ControllerHelperTrait;
	protected $controllerHelper;

	public function __construct(){
		$this->controllerHelper = new Controller();
	}
}