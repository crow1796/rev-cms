<?php 
namespace RevCMS\Modules\Abstracts;
use Illuminate\Container\Container as App;

abstract class RevCMSModule{

	protected $app;

	public function __construct(App $app){
		$this->app = $app;
	}
}