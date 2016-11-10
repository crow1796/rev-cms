<?php 
namespace RevCMS\Modules\Settings;
use Larapack\ConfigWriter\Repository as LarapackRepository;
use RevCMS\Modules\Abstracts\RevCMSModule;

class SettingsManager extends RevCMSModule{

	/**
	 * Update site's general settings
	 * @param  array  $settings 
	 * @return array           
	 */
	public function updateGeneralSettings($settings = array()){
		if(!$settings) return false;

		$checkboxSettings = [
			'sticky_header',
			'developer_mode',
		];

		$config = new LarapackRepository('revcms');
		foreach($settings as $configKey => $configValue){
			$config->set($configKey, $configValue);
		}

		foreach($checkboxSettings as $checkbox){
			$config->set($checkbox, (!array_key_exists($checkbox, $settings) ? false : true));
		}

		$config->save();

		return true;
	}
}