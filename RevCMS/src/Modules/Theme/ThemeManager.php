<?php 
namespace RevCMS\Modules\Theme;

use Symfony\Component\Yaml\Yaml;
use File;

class ThemeManager {
	/**
	 * Get Installed Themes.
	 * @return collection 
	 */
	public function getInstalledThemes(){
		$themes = collect(File::directories(resource_path('views\themes')));
		$themes = $themes->map(function($theme){
		    $tmpTheme = [];
		    $tmpTheme['path'] = $theme;
		    $tmpTheme['info'] = Yaml::parse(File::get($theme . '\theme.yaml'));
		    $tmpTheme['info']['screenshot'] = $this->getScreenshotOf($theme);
		    return $tmpTheme;
		});
		return $themes;
	}

	/**
	 * Get Theme's screenshot.
	 * @param  string $theme 
	 * @return string        
	 */
	protected function getScreenshotOf($theme){
		$themeFiles = collect(\File::allFiles($theme));
		$screenshot = $themeFiles->filter(function($file){
		    return \Illuminate\Support\Str::startsWith($file->getFilename(), 'screenshot') ? $file->getFilename() : false;
		})->first();
		$screenshotPath = str_replace('\\', '/', $screenshot ? $screenshot->getPathname() : null);
		return $screenshotPath;
	}
}