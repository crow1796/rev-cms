<?php

namespace App\Http\Controllers\RevCMS;

use Illuminate\Http\Request;
use RevCMS\RevCMS;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class RevBaseController extends Controller
{
	protected $rev;

	public function __construct(RevCMS $rev){
		$this->rev = $rev;
	}
	/**
	 * Create view.
	 * @param  string $viewPath 
	 * @param  string $title    
	 * @param  array  $data     
	 * @return Illuminate\Contracts\View\View
	 */
	protected function makeView($viewPath, $title, $data = array()){
		$viewData = [
			'title' => $title,
		];
		
		if(!empty($data)){
			array_merge($viewData, $data);
		}
		return view($viewPath, $viewData);
	}
	
	protected function checkAjaxRequest($request){
		if(!$request->ajax()){
			throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException();
		}
		return true;
	}
}
