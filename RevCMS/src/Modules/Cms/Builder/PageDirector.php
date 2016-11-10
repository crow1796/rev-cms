<?php 
namespace RevCMS\Modules\Cms\Builder;
use RevCMS\Modules\Cms\Builder\ActionBlockBuilder;
use RevCMS\Modules\Cms\Builder\ViewBuilder;
use RevCMS\Modules\Cms\Builder\PageRecordBuilder;
use RevCMS\Traits\Cms\Builder\PermalinkValidatorTrait;
use Illuminate\Support\Str;
use File;
use Illuminate\Container\Container as App;

class PageDirector {

	use PermalinkValidatorTrait;

	protected $actionBlockBuilder;
	protected $viewBuilder;
	protected $pageRecordBuilder;

	public function __construct(App $app){
		$this->actionBlockBuilder = new ActionBlockBuilder($app);
		$this->viewBuilder = new ViewBuilder($app);
		$this->pageRecordBuilder = new PageRecordBuilder($app);
		$this->routeBuilder = new RouteBuilder($app);
	}

	/**
	 * Build method for page.
	 * @param  array $page 
	 * @return mixed       
	 */
	public function buildActionFor($page){
		if(!$this->pageRecordBuilder->buildFor($page)){
			return false;
		}
		$page = $this->actionBlockBuilder
			->buildFor($page);
		$page = $this->viewBuilder
			->buildFor($page);
		$page = $this->routeBuilder
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

	    $slug = $this->validatePermalink(str_slug($title));
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