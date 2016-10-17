<?php 
namespace RevCMS\Modules\Cms\Builder;
use RevCMS\Modules\Cms\Builder\ActionBlockBuilder;
use RevCMS\Modules\Cms\Builder\ViewBuilder;

class PageDirector {
	protected $actionBlockBuilder;
	protected $viewBuilder;

	public function __construct(){
		$this->actionBlockBuilder = new ActionBlockBuilder();
		$this->viewBuilder = new ViewBuilder();
	}

	public function buildActionBlockFor($page){
		return $this->actionBlockBuilder
					->buildBlockFor($page);
	}
}