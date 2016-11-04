<?php

namespace RevCMS\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use RevCMS\Http\Controllers\RevBaseController;

class DashboardController extends RevBaseController
{
    public function index(){
    	$this->menuOrder = 1;
    	return $this->makeView('revcms.dashboard.index', 'Dashboard');
    }

    public function mvcMenu(){
    	$this->menuOrder = 8;
    }

    public function settingsMenu(){
    	$this->menuOrder = 7;
    }
}
