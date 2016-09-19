<?php

namespace App\Http\Controllers\RevCMS;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\RevCMS\RevBaseController;

class ThemesController extends RevBaseController
{

	/**
	 * Installed Themes' page.
	 * @return view 
	 */
    public function index()
    {
        return $this->makeView('revcms.themes.index', 'Installed Themes');
    }

    public function getInstalledThemes(Request $request){
    	$this->checkAjaxRequest($request);
    	return $this->rev
    				->theme()
    				->getInstalledThemes();
    }
}
