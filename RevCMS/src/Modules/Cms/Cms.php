<?php 
namespace RevCMS\Modules\Cms;
use RevCMS\Modules\Cms\Builder\PageDirector;
use RevCMS\Modules\Cms\Wrapper\Page;
use Validator;

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

		$validation = $this->validatePageCreation($pageInfo);
		if($validation->fails()){
			return $validation;
		}

		$page = $this->pageDirector
						->buildActionFor($pageInfo);
		return (new Page($page));
	}

	private function validatePageCreation($pageInfo){
		$rules = [
			'action_name' => 'required',
			'title' => 'required',
			'controller' => 'required',
			'layout' => 'required',
		];

		return Validator::make($pageInfo, $rules);
	}

	/**
	 * Generate slug and action name from page title.
	 * @param  string $title 
	 * @return array        
	 */
	public function generateFieldsFor($title = ''){
		if(!$title) return array();
		$fields = $this->pageDirector->generateFieldsFrom($title);
		return $fields;
	}
}