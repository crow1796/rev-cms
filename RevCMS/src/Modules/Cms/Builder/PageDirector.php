<?php 
namespace RevCMS\Modules\Cms\Builder;
use RevCMS\Modules\Cms\Builder\ActionBlockBuilder;
use RevCMS\Modules\Cms\Builder\ViewBuilder;
use RevCMS\Traits\Cms\Builder\PermalinkValidatorTrait;
use Illuminate\Support\Str;
use File;

class PageDirector {

	use PermalinkValidatorTrait;

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
		if($page){
			$this->createRouteFor($page);
		}
		return $page;
	}

	/**
	 * Create route for page.
	 * @param  array  $page 
	 * @return mixed       
	 */
	private function createRouteFor($page = array()){
		$route = "Route::get('{$page['slug']}', ['uses' => '\\{$page['controller']}@{$page['action_name']}']);";
		$revWebRoutesPath = base_path('routes/revcms_web.php');
		$routeMatch = str_replace('\\', '\\\\', $route);
		$routeMatch = preg_replace('~([\(|\)|\[|\]])~si', '\\\$1', $routeMatch);
		preg_match('~' . $routeMatch . '~is', File::get($revWebRoutesPath), $matches);
		if(!count($matches)){
			$route = "\n" . $route;
			File::append($revWebRoutesPath, $route);
		}
		return $route;
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