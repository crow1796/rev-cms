<?php
namespace App\Http\Controllers\Test;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TestController1 extends Controller
{

	public function homepage(){
		$viewData = array();
		$viewData['title'] = 'Homepage';
		//revpageblock:
		$viewData['meta_title'] = '';
		$viewData['meta_description'] = '';
		$viewData['meta_keywords'] = '';		
		//endrevpageblock
		 return view('test.test.homepage', $viewData);
	}


	public function index(){
		$viewData = array();
		$viewData['title'] = 'Index';
		//revpageblock:
		$viewData['meta_title'] = '';
		$viewData['meta_description'] = '';
		$viewData['meta_keywords'] = '';		
		//endrevpageblock
		 return view('test.test.index', $viewData);
	}
}