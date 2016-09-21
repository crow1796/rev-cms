<?php

namespace RevCMS\Http\Controllers;

use Illuminate\Http\Request;
use RevCMS\Http\Controllers\RevBaseController;

class SettingsController extends RevBaseController
{
    public function index(){
    	return $this->makeView('revcms.settings.index', 'Settings');
    }
}
