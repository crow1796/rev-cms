<?php

namespace RevCMS\Http\Controllers\Developer;

use Illuminate\Http\Request;

use App\Http\Requests;
use RevCMS\Http\Controllers\RevBaseController;

class MVCController extends RevBaseController
{
    public function index(){
    	$this->menuOrder = 9;
    	return $this->makeView('revcms.developer.mvc.index', 'MVC');
    }
}
