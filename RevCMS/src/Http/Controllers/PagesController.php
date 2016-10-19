<?php

namespace RevCMS\Http\Controllers;

use Illuminate\Http\Request;
use RevCMS\Http\Controllers\RevBaseController;
use RevCMS\Modules\Cms\Wrapper\Page;

class PagesController extends RevBaseController
{

    public function index(){
    	return $this->makeView('revcms.pages.index', 'Pages');
    }

    public function store(Request $request){
    	$this->checkAjaxRequest($request);

    	$page = $this->rev
    			->cms()
    			->createPage($request->all());

    	if(!$page instanceof Page) {
    		return $page->fails() ? $page->errors()->all() + ['failed' => true] : $page;
    	}

    	dd($page);
    }

    public function create(){
    	return $this->makeView('revcms.pages.create', 'New Page');
    }

    public function generateFields(Request $request){
    	$this->checkAjaxRequest($request);

    	return $this->rev
    				->cms()
    				->generateFieldsFor($request->page_title);
    }
}
