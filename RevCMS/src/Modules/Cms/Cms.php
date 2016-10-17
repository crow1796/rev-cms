<?php 
namespace RevCMS\Modules\Cms;
use RevCMS\Modules\Cms\Builder\PageDirector;

class Cms{

	protected $pageDirector;

	public function __construct(){
		$this->pageDirector = new PageDirector();
	}

	/**
	 * Create New Page.
	 * @param  array  $pageInfo 
	 * @return array           
	 */
	public function createPage($pageInfo = array()){
		if(!is_array($pageInfo) || empty($pageInfo)) return array();
		$page = array();

		$page['action'] = $this->pageDirector->buildActionBlockFor($pageInfo);

		return $page;
	}
}