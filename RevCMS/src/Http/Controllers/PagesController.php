<?php

namespace RevCMS\Http\Controllers;

use Illuminate\Http\Request;
use RevCMS\Http\Controllers\RevBaseController;

class PagesController extends RevBaseController
{
    public function index(){
    	return $this->makeView('revcms.pages.index', 'Pages');
    }

    public function create(){
    	return $this->makeView('revcms.pages.create', 'New Page');
    }
}
