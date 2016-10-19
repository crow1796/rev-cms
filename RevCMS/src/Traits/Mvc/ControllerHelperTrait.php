<?php

namespace RevCMS\Traits\Mvc;
trait ControllerHelperTrait {
	public function makeController($name, $resource){
		return $this->controllerHelper
					->make($name, $resource);
	}

	public function allControllers(){
		return $this->controllerHelper
					->all();
	}

	public function getControllerContent($controller){
		return $this->controllerHelper
					->getContent($controller);
	}

	public function deleteControllers($controllers){
		return $this->controllerHelper
					->deleteSubject($controllers);
	}

	public function updateControllerContent($newData){
		return $this->controllerHelper
					->updateContent($newData);
	}
}