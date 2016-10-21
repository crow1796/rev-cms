<?php 
namespace RevCMS\Modules\Cms\Builder;
use RevCMS\Modules\CMS\Builder\Abstracts\PageBuilder;
use File;

class ViewBuilder extends PageBuilder{

	/**
	 * Start Building view block for page.
	 * @param  array  $page 
	 * @return mixed       
	 */
	public function buildFor($page = array()){
	    if(!is_array($page) || empty($page)) return '';

	    $source = $page['view_source'];
	    $exploded = explode('/', $page['view_names']['filePath']);
	    array_pop($exploded);
	    $viewDir = resource_path('views\\' . str_replace('/', '\\', implode($exploded, '/')));
	    $viewPath = resource_path('views\\' . str_replace('/', '\\', $page['view_names']['filePath']));

	    if(!File::exists($viewPath)){
	    	File::makeDirectory($viewDir, 0755, true, true);
	    	File::put($viewPath, $source);
	    }
	    return $page;
	}
}