<?php

namespace App\Http\Controllers\RevCMS;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\RevCMS\RevBaseController;

class PagesController extends RevBaseController
{
    public function index(){
    	return $this->makeView('revcms.pages.index', 'Pages');
    }

    public function create(){
    	return $this->makeView('revcms.pages.create', 'New Page');
    }
}
