<?php

namespace RevCMS\Http\Controllers;

use Illuminate\Http\Request;
use RevCMS\Http\Controllers\RevBaseController;

class MediaController extends RevBaseController
{
    public function index(){
    	$this->menuOrder = 4;
    	return $this->makeView('revcms.media.index', 'Media Library');
    }
}
