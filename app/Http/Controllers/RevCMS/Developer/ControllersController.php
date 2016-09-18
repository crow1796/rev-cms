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
                    ->mvc()
    				->allControllers();
    }

    /**
     * Create Controller
     * @param  Request $request 
     * @return int           
     */
    public function create(Request $request){
    	$this->checkAjaxRequest($request);
    	return $this->rev
                    ->mvc()
			    	->makeController($request->name, $request->resource);
    }

    /**
     * Get content of the specified file.
     * @param  Request $request 
     * @return string           
     */
    public function getContent(Request $request){
        $this->checkAjaxRequest($request);
        return $this->rev
                    ->mvc()
                    ->getControllerContent($request->file_path);
    }

    /**
     * Delete Controllers
     * @param  Request $request 
     * @return mixed           
     */
    public function deleteControllers(Request $request){
        $this->checkAjaxRequest($request);
        return $this->rev
                    ->mvc()
                    ->deleteControllers($request->paths) ? 'success' : 'failed';
    }

    /**
     * Update controller's content.
     * @param  Request $request 
     * @return mixed
     */
    public function updateController(Request $request){
        $this->checkAjaxRequest($request);
        return $this->rev
                    ->mvc()
                    ->updateControllerContent($request->except(['_method'])) ? 'success': 'failed';
    }
}
