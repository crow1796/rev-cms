<?php

namespace RevCMS\Http\Controllers;

use Illuminate\Http\Request;
use RevCMS\Http\Controllers\RevBaseController;
use RevCMS\RevCMS;

class SettingsController extends RevBaseController
{
	public function __construct(RevCMS $rev){
		parent::__construct($rev);
		$this->menuOrder = 8;
	}

    public function index(){
    	return $this->makeView('revcms.settings.index', 'Settings');
    }

    public function generalSettings(){
    	$data = config('revcms');
    	return $this->makeView('revcms.settings.general', 'General Settings', $data);
    }

    public function updateGeneralSettings(Request $request){
    	$updated = $this->rev
    				->settings()
    				->updateGeneralSettings($request->except(['_token']));

    	return $updated ? redirect(url($request->uri . '/settings/general'))->withMessage('General Settings has been updated.') : redirect(url($request->uri . '/settings/general'))->withError('General Settings update failed.');
    }
}
