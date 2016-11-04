<?php 
namespace RevCMS\Modules\CMS\Builder;
use RevCMS\Modules\CMS\Builder\Abstracts\PageBuilder;

class ActionBlockBuilder extends PageBuilder{
	/**
	 * Start Building action block for page.
	 * @param  array  $page 
	 * @return mixed       
	 */
	public function buildFor($page = array()){
	    parent::buildFor($page);

	    $source = isset($page['action_source']) ? $page['action_source'] : '';

	    $extractedUses = $this->extract('uses', $source);
	    $extractedInjections = $this->extract('injections', $source);
	    $trimmedSource = $this->trimSource($source);
	    $explodedSource = explode("\n", $trimmedSource);
	    $newSource = '';

	    foreach($explodedSource as $sourceLine){
	        $newSource .= "\t\t$sourceLine\n";
	    }

	    $page['view_names'] = $this->generateViewNameFor($page);
	    
	    $data = array(
	    		'page' => $page,
	    		'extractedUses' => $extractedUses,
	    		'extractedInjections' => $extractedInjections,
	    		'trimmedSource' => $trimmedSource,
	    		'explodedSource' => $explodedSource,
	    		'newSource' => $newSource,
	    	);
	   	return $this->buildAndWriteMethod($data);
	}

	/**
	 * Build, format and write function to controller.
	 * @param  array  $data 
	 * @return string       
	 */
	private function buildAndWriteMethod($data = array()){
		if(!is_array($data)) return '';

		extract($data);
		// Generate action-returnable view name.
		$viewName = $data['page']['view_names']['response'];
		$params = isset($extractedInjections['inline']) ? $extractedInjections['inline'] : '';

		$block = '';
		$block .= "\tpublic function {$page['action_name']}({$params}){\n";
		$block .= "\t\t" . '$viewData = array();' . "\n";
		$block .= "\t\t" . '$viewData[\'title\'] = ' . '\'' . $page['title'] . '\';' . "\n";
		$block .= "\t\t" . '$viewData[\'meta_title\'] = ' . '\'' . (isset($page['meta']['title']) ? $page['meta']['title'] : '') . '\';' . "\n";
		$block .= "\t\t" . '$viewData[\'meta_description\'] = ' . '\'' . (isset($page['meta']['description']) ? $page['meta']['description'] : '') . '\';' . "\n";
		$block .= "\t\t" . '$viewData[\'meta_keywords\'] = ' . '\'' . (isset($page['meta']['keywords']) ? $page['meta']['keywords'] : '') . '\';' . "\n";
		$block .="\t\t//revpageblock:\n";
		$block .= $newSource;
		$block .="\t\t//endrevpageblock";
		$block .= "\n\t\t return view('{$viewName}', " . '$viewData' . ");";
		$block .= "\n\t}";

		$this->writeActionToController($page, $block);

		return $page;
	}

	/**
	 * Generate View Name.
	 * @param  array $page 
	 * @return mixed       
	 */
	private function generateViewNameFor($page){
		// $fileName = str_slug($page['title']);
		$fileName = str_slug($page['action_name']);
		preg_match('~http\\\controllers\\\(.*)~i', $page['controller'], $matches);
		$viewDir = strtolower(preg_replace('~controller.*~i', '', str_replace('\\', '/', $matches[1])));

		$viewPath = $viewDir . '/' . $fileName;
		// Actual Blade File Path
		$actualBladePath = 'pages/' . $viewPath . '.blade.php';
		// Returned by actions
		$actionResponseView = 'pages.' . str_replace('/', '.', $viewPath);

		$viewNames['filePath'] = $actualBladePath;
		$viewNames['response'] = $actionResponseView;

		return $viewNames;
	}

	/**
	 * Extract inline and exploded data from source.
	 * @param  array  $matches 
	 * @param  string $source  
	 * @return array          
	 */
	private function extract($line = '', $source = ''){
	    if(!$source || !$line) return array();
	    $matches = $this->findInSource($line, $source);
	    $extracts = array();
	    if(isset($matches[1]) && isset($matches[1][0])){
	        $extracts['inline'] = $matches[1][0];
	        $extracts['exploded'] = explode(',', $matches[1][0]);
	    }

	    if(!isset($extracts['exploded']) && !isset($extracts['inline'])){
	        return $extracts;
	    }

	    for($counter = 0; $counter < count($extracts['exploded']); $counter++){
	        $extracts['exploded'][$counter] = trim($extracts['exploded'][$counter]);
	    }

	    return $extracts;
	}

	/**
	 * Find data in source.
	 * @param  string $line   
	 * @param  string $source 
	 * @return array         
	 */
	private function findInSource($line = '', $source = ''){
	    if(!$source) return array();
	    $regexes = [
	        'uses' => '~\/\/\s*uses\s*\:\s*(.*)~i',
	        'injections' => '~\/\/\s*inject\s*\:\s*(.*)~i',
	    ];
	    if(!array_key_exists($line, $regexes)) return array();

	    preg_match_all($regexes[$line], $source, $matches);

	    return $matches;
	}

	/**
	 * Removes uses and injects lines from source.
	 * @param  string $source 
	 * @return string         
	 */
	private function trimSource($source = ''){
	    if(!$source) return '';
	    $regexes = [
	        '~\/\/\s*uses\s*\:\s*(.*)\\n~i',
	        '~\/\/\s*inject\s*\:\s*(.*)\\n~i',
	    ];
	    foreach($regexes as $regex){
	        $source = preg_replace($regex, '', $source);
	    }
	    return $source;
	}

	/**
	 * Write action block to controller.
	 * @param  array $pageInfo   
	 * @param  array $pageSource 
	 * @return mixed             
	 */
	private function writeActionToController($pageInfo, $pageSource){
	    if(!isset($pageInfo['controller'])) return false;

	    $controller = new \ReflectionClass($pageInfo['controller']);

	    if($controller->hasMethod($pageInfo['action_name'])) return false;
	    
	    $controllerContent = \File::get($controller->getFileName());
	    $explodedContent = preg_replace('~^(.*)}$~s', '$1', $controllerContent);
	    // $explodedContent = explode("\n", $controllerContent);
	    // array_pop($explodedContent);

	    $openContent = $explodedContent;
	    $openContent .= "\n\n" . $pageSource;
	    $newContent = $openContent . "\n}";

	    return \File::put($controller->getFileName(), $newContent);
	}
}