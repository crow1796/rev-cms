<?php

namespace RevCMS\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use RevCMS\Http\Controllers\RevBaseController;

class DashboardController extends RevBaseController
{
    public function index(){
    	return $this->makeView('revcms.dashboard.index', 'Dashboard');
    }
}
