<?php

namespace App\Http\Controllers\RevCMS;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\RevCMS\RevBaseController;

class SettingsController extends RevBaseController
{
    public function index(){
    	return $this->makeView('revcms.settings.index', 'Settings');
    }
}
