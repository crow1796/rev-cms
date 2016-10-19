<?php

namespace RevCMS\Http\Controllers;

use Illuminate\Http\Request;
use RevCMS\Http\Controllers\RevBaseController;

class PagesController extends RevBaseController
{
    public function index(){
    	return $this->makeView('revcms.pages.index', 'Pages');
    }

    public function store(Request $request){
    	$this->checkAjaxRequest($request);
    	dd($request->all());
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
