<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PagesController extends Controller
{
    //



	public function aboutUs(){
		$viewData = array();
		$viewData['title'] = 'About Us';
		//revpageblock:
		$viewData['meta_title'] = '';
		$viewData['meta_description'] = '';
		$viewData['meta_keywords'] = '';		
		//endrevpageblock
		 return view('pages.pages.about-us', $viewData);
	}
}