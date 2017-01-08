<?php
namespace App\Http\Controllers\Test;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TestController1 extends Controller
{

	public function home(){
		$viewData = array();
		$viewData['title'] = 'Home';
		$viewData['meta_title'] = '';
		$viewData['meta_description'] = '';
		$viewData['meta_keywords'] = '';
		//revpageblock:
		
		//endrevpageblock
		 return view('pages.test.test.home', $viewData);
	}


	public function aimer(){
		$viewData = array();
		$viewData['title'] = 'Products Page';
		$viewData['meta_title'] = 'Simple Product Page';
		$viewData['meta_description'] = 'Simple Product Page';
		$viewData['meta_keywords'] = 'product, simple, page';
		//revpageblock:
		dd('Aimer');
		//endrevpageblock
		 return view('pages.test.test.aimer', $viewData);
	}


	public function test(){
		$viewData = array();
		$viewData['title'] = 'Test';
		$viewData['meta_title'] = '';
		$viewData['meta_description'] = '';
		$viewData['meta_keywords'] = '';
		//revpageblock:
		
		//endrevpageblock
		 return view('pages.test.test.test', $viewData);
	}


	public function test1(){
		$viewData = array();
		$viewData['title'] = 'Test';
		$viewData['meta_title'] = '';
		$viewData['meta_description'] = '';
		$viewData['meta_keywords'] = '';
		//revpageblock:
		
		//endrevpageblock
		 return view('pages.test.test.test1', $viewData);
	}


	public function test2(){
		$viewData = array();
		$viewData['title'] = 'Test';
		$viewData['meta_title'] = '';
		$viewData['meta_description'] = '';
		$viewData['meta_keywords'] = '';
		//revpageblock:
		
		//endrevpageblock
		 return view('pages.test.test.test2', $viewData);
	}


	public function aimer1(){
		$viewData = array();
		$viewData['title'] = 'aimer';
		$viewData['meta_title'] = '';
		$viewData['meta_description'] = '';
		$viewData['meta_keywords'] = '';
		//revpageblock:
		
		//endrevpageblock
		 return view('pages.test.test.aimer1', $viewData);
	}


	public function user(){
		$viewData = array();
		$viewData['title'] = 'User';
		$viewData['meta_title'] = '';
		$viewData['meta_description'] = '';
		$viewData['meta_keywords'] = '';
		//revpageblock:
		
		//endrevpageblock
		 return view('pages.test.test.user', $viewData);
	}


	public function test3(){
		$viewData = array();
		$viewData['title'] = 'Test';
		$viewData['meta_title'] = '';
		$viewData['meta_description'] = '';
		$viewData['meta_keywords'] = '';
		//revpageblock:
		
		//endrevpageblock
		 return view('pages.test.test.test3', $viewData);
	}


	public function reFarLyrics(){
		$viewData = array();
		$viewData['title'] = 'Re: Far Lyrics';
		$viewData['meta_title'] = '';
		$viewData['meta_description'] = '';
		$viewData['meta_keywords'] = '';
		//revpageblock:
		
		//endrevpageblock
		 return view('pages.test.test.refarlyrics', $viewData);
	}
}