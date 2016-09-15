<?php

namespace App\Http\Controllers\RevCMS\Developer;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\RevCMS\RevBaseController;

class ControllersController extends RevBaseController
{
    public function index(){
    	return $this->makeView('revcms.developer.mvc.controllers.index', 'Controllers');
    }

    public function allControllers(){
    	return $this->rev
    				->allControllers();
    }

    /**
     * Create Controller
     * @param  Request $request 
     * @return int           
     */
    public function create(Request $request){
    	$this->checkAjaxRequest($request);
    	return $this->rev->makeController($request->name, $request->resource);
    }
}
