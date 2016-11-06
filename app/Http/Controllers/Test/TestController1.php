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


	public function aimer($post_slug){
		$viewData = array();
		$viewData['title'] = 'Products Page';
		$viewData['meta_title'] = 'Simple Product Page';
		$viewData['meta_description'] = 'Simple Product Page';
		$viewData['meta_keywords'] = 'product, simple, page';
		//revpageblock:
		
		$post = \App\Post::findBySlugOrFail($post_slug);
		$viewData["post"] = $post;
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
}