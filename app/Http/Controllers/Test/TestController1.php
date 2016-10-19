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

	public function post($post_slug){
		$viewData = array();
		$viewData['title'] = 'Products Page';
		//pageblock:
		$viewData['meta_title'] = 'Simple Product Page';
		$viewData['meta_description'] = 'Simple Product Page';
		$viewData['meta_keywords'] = 'product, simple, page';		
		$post = \App\Post::findBySlugOrFail($post_slug);
		$viewData["post"] = $post;
		//endpageblock
		 return view('pages.products.post', $viewData);
	}
}