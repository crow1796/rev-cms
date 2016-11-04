<?php 
namespace RevCMS\Modules\CMS\Builder\Abstracts;
use Illuminate\Container\Container as App;

abstract class PageBuilder {

	protected $app;

	public function __construct(App $app){
		$this->app = $app;
	}

	public function buildFor($page = array()){
		if(!is_array($page) || empty($page)) return '';
	}
}