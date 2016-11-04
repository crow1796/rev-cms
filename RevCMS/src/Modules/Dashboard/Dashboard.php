<?php 
namespace RevCMS\Modules\Dashboard;
use RevCMS\Modules\Abstracts\RevCMSModule;

class Dashboard extends RevCMSModule {

	public function __construct(){
	}

	public function render($partialName = '', $title = '', $menuOrder = null){
		$viewData = array(
			'title' => $title,
			'partialName' => $partialName,
			'revActiveMenu' => $menuOrder ? 'custom-menu-' . $menuOrder : 0
			);
		return view('revcms.layout.custommenu.master', $viewData);
	}
}