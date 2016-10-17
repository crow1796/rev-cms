<?php 
namespace RevCMS\Modules\Dashboard;
use RevCMS\Modules\Dashboard\Factories\SidebarMenu as SidebarMenuFactory;
use RevCMS\Modules\Dashboard\Decorators\SidebarMenu as SidebarMenuDecorator;

class Dashboard {
	protected $sidebarMenuFactory;

	public function __construct(){
		$this->sidebarMenuFactory = new SidebarMenuFactory();
	}

	public function addSidebarMenu($uri = null, $action = null){
		return $this->sidebarMenuFactory
				->makePage($uri, $action);
	}
}