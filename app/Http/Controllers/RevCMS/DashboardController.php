<?php

namespace App\Http\Controllers\RevCMS;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\RevCMS\RevBaseController;

class DashboardController extends RevBaseController
{
    public function index(){
    	return $this->makeView('revcms.dashboard.index', 'Dashboard');
    }
}
