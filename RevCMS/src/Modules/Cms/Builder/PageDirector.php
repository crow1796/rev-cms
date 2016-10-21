<?php 
namespace RevCMS\Modules\Cms\Builder;
use RevCMS\Modules\Cms\Builder\ActionBlockBuilder;
use RevCMS\Modules\Cms\Builder\ViewBuilder;
use Illuminate\Support\Str;

class PageDirector {
	protected $actionBlockBuilder;
	protected $viewBuilder;

	public function __construct(){
		$this->actionBlockBuilder = new ActionBlockBuilder();
		$this->viewBuilder = new ViewBuilder();
	}

	/**
	 * Build method for page.
	 * @param  array $page 
	 * @return mixed       
	 */
	public function buildActionFor($page){
		$page = $this->actionBlockBuilder
						->buildFor($page);
		$page = $this->viewBuilder
						->buildFor($page);
		return $page;
	}



	/**
	 * Generate slug and action name from page title.
	 * @param  string $title 
	 * @return string        
	 */
	public function generateFieldsFrom($title = ''){
		$fields = array(
				'slug' => '',
				'action_name' => '',
			);
	    if(!$title) return $fields;

	    $slug = str_slug($title);
	    $actionName = Str::camel($slug);

	    $fields['slug'] = $slug;
	    $fields['action_name'] = $actionName;

	    return $fields;
	}

	/**
	 * Generate action name from page title.
	 * @param  string $title 
	 * @return string        
	 */
	public function generateActionNameFrom($title = ''){
	    if(!$title) return '';

	    $actionName = \Illuminate\Support\Str::camel($title);

	    return $actionName;
	}
}