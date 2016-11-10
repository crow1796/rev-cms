<?php 
namespace RevCMS\Modules\Cms;
use Illuminate\Container\Container as App;
use RevCMS\Modules\Cms\Builder\PageDirector;
use RevCMS\Modules\Cms\Wrapper\Page;
use Validator;
use RevCMS\Modules\Abstracts\RevCMSModule;
use RevCMS\Repositories\CMS\PageRepository;

class Cms extends RevCMSModule{

	protected $pageRepository;
	protected $pageDirector;

	public function __construct(App $app, PageDirector $pageDirector, PageRepository $pageRepository){
		parent::__construct($app);
		$this->pageDirector = $pageDirector;
		$this->pageRepository = $pageRepository;
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
		return $page ? (new Page($page)) : $page;
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

	/**
	 * Get current active theme's layouts.
	 * @return array 
	 */
	public function getActiveThemesLayouts(){
		$activeThemePath = str_replace('/', '\\', resource_path('views/' . config('revcms.active_theme')));
		$layouts = \File::allFiles($activeThemePath . '\\layouts');
		$layoutMaps = array();

		foreach($layouts as $layout){
		    $viewName = str_replace('.blade.php', '', $layout->getRelativePathname());
		    array_push($layoutMaps, array(
		            'view_name' => $viewName,
		            'view_returnable_path' => str_replace('/', '.', config('revcms.active_theme') . '/' . $viewName),
		            'easy_name' => \Illuminate\Support\Str::title(preg_replace('~[^\w]+~', ' ', $viewName)),
		        ));
		}
		return $layoutMaps;
	}

	public function getPageArray(){
		return $this->pageRepository->allForDisplay();
	}
}