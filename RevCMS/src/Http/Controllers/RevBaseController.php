<?php

namespace RevCMS\Http\Controllers;

use Illuminate\Http\Request;
use RevCMS\RevCMS;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class RevBaseController extends BaseController
{
	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	protected $rev;
	protected $menuOrder;

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
			'revActiveMenu' => $this->menuOrder,
		];
		
		if(!empty($data)){
			$viewData = array_merge($viewData, $data);
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
