<?php 
namespace RevCMS\Modules\CMS\Builder;

class ActionBlockBuilder {
	public function buildBlockFor($page = array()){
	    if(!is_array($page) || empty($page)) return '';

	    $source = isset($page['source']) ? $page['source'] : '';

	    if(!$source) return '';

	    $block = '';

	    $extractedUses = $this->extract('uses', $source);
	    $extractedInjections = $this->extract('injections', $source);
	    $trimmedSource = $this->trimSource($source);
	    $explodedSource = explode("\n", $trimmedSource);
	    $newSource = '';

	    foreach($explodedSource as $sourceLine){
	        $newSource .= "\t\t$sourceLine\n";
	    }

	    $block .= "\tpublic function {$page['action']}({$extractedInjections['inline']}){\n";
	    $block .= "\t\t" . '$viewData[\'title\'] = ' . '\'' . $page['title'] . '\';';
	    $block .="\n\t\t//pageblock:";
	    $block .= $newSource;
	    $block .="\t\t//endpageblock";
	    $block .= "\n\t\t return view('{$page['view']}', " . '$viewData' . ");";
	    $block .= "\n\t}";

	    $this->writeActionToController($page, $block);

	    return $block;
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

	    if($controller->hasMethod($pageInfo['action'])) return false;
	    
	    $controllerContent = \File::get($controller->getFileName());
	    $explodedContent = explode("\n", $controllerContent);
	    array_pop($explodedContent);

	    $openContent = implode($explodedContent, "\n");
	    $openContent .= "\n\n" . $pageSource;
	    $newContent = $openContent . "\n}";

	    return \File::put($controller->getFileName(), $newContent);
	}
}