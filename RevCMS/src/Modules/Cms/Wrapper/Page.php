<?php 
namespace RevCMS\Modules\Cms\Wrapper;

class Page{
	protected $actionName;
	protected $viewName;
	protected $title;
	protected $actionSource;
	protected $viewSource;
	protected $controller;
	protected $layout;
	protected $isHidden;
	protected $meta;

	public function __construct($pageInfo = array(), $pageSource = array()){
		$this->actionName = $this->getPropFrom($pageInfo, 'action_name');
		$this->viewName = $this->getPropFrom($pageInfo, 'view_name');
		$this->title = $this->getPropFrom($pageInfo, 'title');
		$this->controller = $this->getPropFrom($pageInfo, 'controller');
		$this->layout = $this->getPropFrom($pageInfo, 'layout');
		$this->isHidden = $this->getPropFrom($pageInfo, 'hidden');
		$this->meta = $this->getPropFrom($pageInfo, 'meta');

		$this->actionSource = $this->getPropFrom($pageSource, 'action');
		$this->viewSource = $this->getPropFrom($pageSource, 'view');
	}

	private function getPropFrom($source, $name){
		if(!$name) return '';

		return isset($source[$name]) ? $source[$name] : '';
	}

	public function __get($name){
		return $this->$name;
	}
}