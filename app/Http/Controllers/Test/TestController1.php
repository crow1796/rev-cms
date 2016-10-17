<?php
namespace App\Http\Controllers\Test;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TestController1 extends Controller
{
    //

	public function show($id){
		$viewData['title'] = 'Products Page';
		//pageblock:		
		$viewData["user"] = \App\User::findOrFail($id);
		//endpageblock
		 return view('pages.products.show', $viewData);
	}

	public function index($id){
		$viewData['title'] = 'Products Page';
		//pageblock:		
		$viewData["user"] = \App\User::findOrFail($id);
		//endpageblock
		 return view('pages.products.index', $viewData);
	}

	public function delete($id){
		$viewData['title'] = 'Products Page';
		//pageblock:		
		$viewData["user"] = \App\User::findOrFail($id);
		//endpageblock
		 return view('pages.products.delete', $viewData);
	}

	public function create($id){
		$viewData['title'] = 'Products Page';
		//pageblock:		
		$viewData["user"] = \App\User::findOrFail($id);
		//endpageblock
		 return view('pages.products.create', $viewData);
	}

	public function edit($id){
		$viewData['title'] = 'Products Page';
		//pageblock:		
		$viewData["user"] = \App\User::findOrFail($id);
		//endpageblock
		 return view('pages.products.edit', $viewData);
	}

	public function update($id){
		$viewData['title'] = 'Products Page';
		//pageblock:		
		
		$viewData["user"] = \App\User::findOrFail($id);
		//endpageblock
		 return view('pages.products.update', $viewData);
	}
}