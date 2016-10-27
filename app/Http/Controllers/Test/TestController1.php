<?php
namespace App\Http\Controllers\Test;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TestController1 extends Controller
{

	public function home(\Illuminate\Http\Request $request){
		$viewData = array();
		$viewData['title'] = 'home';
		//revpageblock:
		$viewData['meta_title'] = 'RevCMS First Page';
		$viewData['meta_description'] = 'RevCMS First Page';
		$viewData['meta_keywords'] = 'revcms page, revcms first page';
		
		$viewData['message'] = 'Hello, world';
		$viewData['name'] = 'Ododz Gwapodz';
		//endrevpageblock
		 return view('pages.test.test.home', $viewData);
	}

	
	public function aboutUs(\Illuminate\Http\Request $request){
		$viewData = array();
		$viewData['title'] = 'About Us';
		//revpageblock:
		$viewData['meta_title'] = 'RevCMS First Page';
		$viewData['meta_description'] = 'RevCMS First Page';
		$viewData['meta_keywords'] = 'revcms page, revcms first page';
		
		$viewData['message'] = 'Hello, world';
		$viewData['name'] = 'Ododz Gwapodz';
		//endrevpageblock
		 return view('pages.test.test.about-us', $viewData);
	}


	public function contactUs(){
		$viewData = array();
		$viewData['title'] = 'Contact Us';
		//revpageblock:
		$viewData['meta_title'] = '';
		$viewData['meta_description'] = '';
		$viewData['meta_keywords'] = '';
		
		//endrevpageblock
		 return view('pages.test.test.contact-us', $viewData);
	}


	public function reFar(\Illuminate\Http\Request $request){
		$viewData = array();
		$viewData['title'] = 'Re: far';
		//revpageblock:
		$viewData['meta_title'] = '';
		$viewData['meta_description'] = '';
		$viewData['meta_keywords'] = '';
		
		dd($request);
		//endrevpageblock
		 return view('pages.test.test.re-far', $viewData);
	}
}