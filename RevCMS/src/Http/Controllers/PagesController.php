<?php

namespace RevCMS\Http\Controllers;

use Illuminate\Http\Request;
use RevCMS\Http\Controllers\RevBaseController;
use RevCMS\Modules\Cms\Wrapper\Page;

class PagesController extends RevBaseController
{

    public function index(){
        $this->menuOrder = 2;
    	return $this->makeView('revcms.pages.index', 'Pages');
    }

    /**
     * Create new page.
     * @param  Request $request 
     * @return mixed           
     */
    public function store(Request $request){
    	$this->checkAjaxRequest($request);

    	$page = $this->rev
    			->cms()
    			->createPage($request->all());

    	if(!$page instanceof Page) {
            // If page is not equal to false/null, then return all errors with a failed status, else return failed
            return $page ? $page->errors()->all() + ['status' => false] : [0 => 'Something went wrong. Please make sure that the permalink is unique.','status' => false];
    	}

        $response = ['status' => true];

    	return $response;
    }

    public function create(){
        $this->menuOrder = 2;
    	return $this->makeView('revcms.pages.create', 'New Page');
    }

    public function edit($id){
        dd($id);
    }

    /**
     * Retreive all pages.
     * @param  Request $request 
     * @return array           
     */
    public function allPages(Request $request){
        $this->checkAjaxRequest($request);
        
        return $this->rev
                    ->cms()
                    ->getPageArray();
    }

    /**
     * Populate controllers and layouts fields.
     * @param  Request $request 
     * @return array           
     */
    public function populateFields(Request $request){
        $fieldValues = [
            'controllers' => $this->rev->mvc()->allControllers(),
            'layouts' => $this->rev->cms()->getActiveThemesLayouts(),
        ];
        return $fieldValues;
    }

    /**
     * Generate slug and action name based on page's title.
     * @param  Request $request 
     * @return array           
     */
    public function generateFields(Request $request){
    	$this->checkAjaxRequest($request);

    	return $this->rev
    				->cms()
    				->generateFieldsFor($request->page_title);
    }
}
