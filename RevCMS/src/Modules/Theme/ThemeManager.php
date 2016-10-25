<?php 
namespace RevCMS\Modules\Theme;

use Symfony\Component\Yaml\Yaml;
use File;
use Illuminate\Support\Str;
use RevCMS\Modules\Theme\Wrapper\Theme;

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
            $tmpTheme['active'] = strpos($theme, str_replace('/', '\\', config('revcms.active_theme'))) ? true : false;
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
	    preg_match('~(themes.*)~', $theme, $matches);
	    $theme = public_path($matches[1]);
	    if(!File::isDirectory($theme)){
	        return null;
	    }
	    $themeFiles = collect(File::allFiles($theme));
	    $screenshot = $themeFiles->filter(function($file){
	        return Str::startsWith($file->getFilename(), 'screenshot') ? $file->getFilename() : false;
	    })->first();
	    if($screenshot){
	        return url(str_replace('\\', '/', $matches[1] . '/' . $screenshot->getFilename()));
	    }
	    return null;
	}
}