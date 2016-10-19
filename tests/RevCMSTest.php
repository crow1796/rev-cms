<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Symfony\Component\Yaml\Yaml;

class RevCMSTest extends TestCase
{
	public function tearDown(){
		Mockery::close();
	}
    /**
     * Get All Controllers
     * @return Illuminate\Support\Collection 
     */
    public function testGetAllControllers(){
        $baseDir = base_path(trim(config('revcms.controller_base_path'), '/'));
        $directories = \File::directories($baseDir);
        array_push($directories, $baseDir);

        $controllers = array_map(function($dir){
            if(strpos($dir, 'RevCMS')) return false;
            return array_map(function($file) use ($dir){
                $file = trim($file, base_path());
                return (trim(\App::getNamespace(), '\\') . (ucfirst(preg_replace('/\//', '\\', trim($file, '.php')))));
            }, \File::files($dir));
        }, $directories);
        
        $controllers = collect($controllers)
                        ->flatten()
                        ->filter(function($item){
                            return $tmp['name'] = $item;
                        })->map(function($item){
                            $tmp = [];
                            $controllerFile = str_replace('\\', '/', (new \ReflectionClass($item))->getFileName());
                            $basePath = str_replace('\\', '/', base_path());
                            $tmp['name'] = $item;
                            $tmp['path'] = str_replace($basePath, '', $controllerFile);
                            return $tmp;
                        })
                        ->toArray();
        // dd($controllers);
        // return $controllers;
        // dump(trim((new \ReflectionClass($controllers[0]))->getFileName(), $base));
        // $this->assertTrue(is_array($controllers));
    }

    public function testMethodReader(){
        $re = "~^\\s*[\\w\\s]+\\(.*\\)\\s*\\K({((?>\"(?:[^\"\\\\]*+|\\\\.)*\"|'(?:[^'\\\\]*+|\\\\.)*'|//.*$|/\\*[\\s\\S]*?\\*/|#.*$|<<<\\s*[\"']?(\\w+)[\"']?[^;]+\\3;$|[^{}<'\"/#]++|[^{}]++|(?1))*)})~m"; 
        $block = \File::get('app/Http/Controllers/Controller.php');
        preg_match_all($re, $block, $matches);
        // dd(trim(trim($matches[0][0], '}'), '{'));
    }

    public function testThemesInfoReader(){
        $themes = collect(File::directories(resource_path('views\themes')));
        $themes = $themes->map(function($theme){
            $tmpTheme = [];
            $tmpTheme['path'] = $theme;
            $tmpTheme['info'] = Yaml::parse(File::get($theme . '\theme.yaml'));
            $tmpTheme['info']['screenshot'] = $this->getScreenshotOf($theme);
            return $tmpTheme;
        });
        // return $themes;
        // dd($themes);
    }

    protected function getScreenshotOf($theme){
        preg_match('~(themes.*)~', $theme, $matches);
        $theme = public_path($matches[1]);
        if(!File::isDirectory($theme)){
            return null;
        }
        $themeFiles = collect(File::allFiles($theme));
        $screenshot = $themeFiles->filter(function($file){
            return \Illuminate\Support\Str::startsWith($file->getFilename(), 'screenshot') ? $file->getFilename() : false;
        })->first();
        if($screenshot){
            return url(str_replace('\\', '/', $matches[1] . '/' . $screenshot->getFilename()));
        }
        return null;
    }

    public function testPageCodeTrimmer(){
        $codeSample1 = '// Inject: $post_slug

$post = \App\Post::findBySlugOrFail($post_slug);
$viewData["post"] = $post;';
        $actionReg = '~\/\/\s*action\s*start(.*)\/\/\s*action\s*end~si';
        $helpersReg = '~\/\/\s*helpers\s*start(.*)\/\/\s*helpers\s*end~si';
        $publicHelpersReg = '~\/\/\s*public\s*start(.*)\/\/\s*public\s*end~si';
        $protectedHelpersReg = '~\/\/\s*protected\s*start(.*)\/\/\s*protected\s*end~si';
        $privateHelpersReg = '~\/\/\s*private\s*start(.*)\/\/\s*private\s*end~si';

        $usesReg = '~\/\/\s*uses\s*\:\s*(.*)~i';
        $injectReg = '~\/\/\s*inject\s*\:\s*(.*)~i';
        preg_match_all($usesReg, $codeSample1, $matches);
        $content = isset($matches[1]) ? isset($matches[1][0]) ? $matches[1][0] : null : $matches[1];

        $pageInfo = array(
                'action' => 'post',
                'view' => 'pages.products.post',
                'title' => 'Products Page',
                'controller' => 'App\Http\Controllers\Test\TestController1',
                'template' => 'default',
                'hidden' => false,
                'source' => $codeSample1,
                'meta' => array(
                        'title' => 'Simple Product Page',
                        'description' => 'Simple Product Page',
                        'keywords' => 'product, simple, page',
                    ),
            );
        $pageSource = \RevCMS::cms()->createPage($pageInfo);
        // dd($this->buildBlockFor($page, $codeSample1));
    }

    public function testGenerateSlugAndActionNameFromTitle(){
        $title = 'About Us';
        // dd($this->generateSlugFrom($title));
        // dd($this->generateActionNameFrom($title));
    }

    public function testDashboardSidebarFactory(){
        (\RevCMS::dashboard()->addSidebarMenu('test/menu', 'MyTestController@index'));
    }
}
