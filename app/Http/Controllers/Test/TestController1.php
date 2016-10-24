<?php
namespace App\Http\Controllers\Test;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TestController1 extends Controller
{

	public function aboutUs(){
		$viewData = array();
		$viewData['title'] = 'About Us';
		//revpageblock:
		$viewData['meta_title'] = '';
		$viewData['meta_description'] = '';
		$viewData['meta_keywords'] = '';		
		//endrevpageblock
		 return view('pages.test.test.about-us', $viewData);
	}


	public function aimer($post_slug){
		$viewData = array();
		$viewData['title'] = 'Products Page';
		//revpageblock:
		$viewData['meta_title'] = 'Simple Product Page';
		$viewData['meta_description'] = 'Simple Product Page';
		$viewData['meta_keywords'] = 'product, simple, page';		
		$post = \App\Post::findBySlugOrFail($post_slug);
		$viewData["post"] = $post;
		//endrevpageblock
		 return view('pages.test.test.products-page', $viewData);
	}
}