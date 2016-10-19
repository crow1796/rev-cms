<?php
namespace App\Http\Controllers\Test;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TestController1 extends Controller
{

	public function homepage($id, Request $request){
		$viewData = array();
		$viewData['title'] = 'Homepage';
		//revpageblock:
		$viewData['meta_title'] = '';
		$viewData['meta_description'] = '';
		$viewData['meta_keywords'] = '';		
		$viewData['user'] = \App\User::findOrFail($id);
		//endrevpageblock
		 return view('test.test.homepage', $viewData);
	}


	public function index($id, Request $request){
		$viewData = array();
		$viewData['title'] = 'index';
		//revpageblock:
		$viewData['meta_title'] = '';
		$viewData['meta_description'] = '';
		$viewData['meta_keywords'] = '';		
		$viewData['user'] = \App\User::findOrFail($id);
		//endrevpageblock
		 return view('test.test.index', $viewData);
	}
}