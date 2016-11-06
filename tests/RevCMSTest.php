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
        $re = "~^\\s*[\\w\\s]+\\(.*\\)\\s*\\K({((?>\"(?:[^\"\\\\]*+|\\\\.)*\"|'(?:[^'\\\\]*+|\\\\.)*'|//.*$|/\\*[\\s\\S]*?\\*/|#.*$|<<<\\s*[\"']?(\\w+)[\"']?[^;]+\\3;$|[^{}<'\"/#]++|[^{}]++|(?1))*)})~si"; 
        $block = \File::get('app/Http/Controllers/Controller.php');
        preg_match_all($re, $block, $matches);
        // dd(trim(trim($matches[0][0], '}'), '{'));
    }

    public function testThemesInfoReader(){
        $themes = \RevCMS::theme()
                        ->getInstalledThemes();
        // return $themes;
        // dd($themes);
    }

    public function testGetActiveThemesLayouts(){
        $layouts = \RevCMS::cms()->getActiveThemesLayouts();

        // dd($layouts);
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
                'action_name' => 'aimer',
                'view' => 'pages.products.aimer',
                'title' => 'Products Page',
                'controller' => 'App\Http\Controllers\Test\TestController1',
                'layout' => 'default',
                'hidden' => false,
                'action_source' => $codeSample1,
                'view_source' => '',
                'slug' => 'aimer',
                'meta' => array(
                        'title' => 'Simple Product Page',
                        'description' => 'Simple Product Page',
                        'keywords' => 'product, simple, page',
                    ),
                'view_names' => [
                    'filePath' => 'pages/products/aimer.blade.php',
                    'response' => 'pages.products.aimer'
                ]
            );
        // $pageSource = \RevCMS::cms()->createPage($pageInfo);

        // dd($this->buildBlockFor($page, $codeSample1));
    }

    public function testGenerateViewName(){
        $data = [
            'title' => 'About Us',
            'controller' => 'App\Http\Controllers\Test\TestController1'
        ];

        $fileName = str_slug($data['title']);
        preg_match('~http\\\controllers\\\(.*)~i', $data['controller'], $matches);
        $viewDir = strtolower(preg_replace('~controller.*~i', '', str_replace('\\', '/', $matches[1])));

        $viewPath = $viewDir . '/' . $fileName;
        // Actual Blade File Path
        $actualBladePath = $viewPath . '.blade.php';
        // Returned by actions
        $actionResponseView = str_replace('/', '.', $viewPath);

        // dd($this->generateSlugFrom($title));
        // dd($this->generateActionNameFrom($title));
    }

    public function testEditRevConfig(){
        $config = new Larapack\ConfigWriter\Repository('revcms');
        $config->set('active_theme', 'themes/Aimer');
        // $config->save();
    }

    public function testDashboardSidebarFactory(){
        (\RevCMS::dashboard()->addSidebarMenu('test/menu', 'MyTestController@index'));
    }
}
