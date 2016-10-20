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


	public function aboutUs($id, Request $request){
		$viewData = array();
		$viewData['title'] = 'About Us';
		//revpageblock:
		$viewData['meta_title'] = '';
		$viewData['meta_description'] = '';
		$viewData['meta_keywords'] = '';		
		$viewData['user'] = User::findOrFail($id);
		$viewData['title'] = $user->fullname;
		//endrevpageblock
		 return view('test.test.about-us', $viewData);
	}


	public function contactus($id, Request $request){
		$viewData = array();
		$viewData['title'] = 'ContactUs';
		//revpageblock:
		$viewData['meta_title'] = '';
		$viewData['meta_description'] = '';
		$viewData['meta_keywords'] = '';		
		$viewData['user'] = User::findOrFail($id);
		$viewData['title'] = $user->fullname;
		//endrevpageblock
		 return view('test.test.contactus', $viewData);
	}
}