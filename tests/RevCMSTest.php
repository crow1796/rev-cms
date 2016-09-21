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
                        })
                        ->pipe(function($collection){
                            return $collection->splice(0, $collection->count() - 1);
                        })
                        ->pipe(function($collection){
                            $temp = $collection->map(function($item){
                                $tmp = [];
                                $controllerFile = str_replace('\\', '/', (new \ReflectionClass($item))->getFileName());
                                $basePath = str_replace('\\', '/', base_path());
                                $tmp['name'] = $item;
                                $tmp['path'] = str_replace($basePath, '', $controllerFile);
                                return $tmp;
                            });
                            return $temp;
                        })
                        ->toArray();
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
        $themes = collect(\File::directories(resource_path('views\themes')));
        $themes = $themes->map(function($theme){
            $tmpTheme = [];
            $tmpTheme['path'] = $theme;
            $tmpTheme['info'] = Yaml::parse(\File::get($theme . '\theme.yaml'));
            $themeFiles = collect(\File::allFiles($theme));
            $screenshot = $themeFiles->filter(function($file){
                return \Illuminate\Support\Str::startsWith($file->getFilename(), 'screenshot') ? $file->getFilename() : false;
            })->first();
            $tmpTheme['info']['screenshot'] = str_replace('\\', '/', $screenshot ? $screenshot->getPathname() : null);
            return $tmpTheme;
        });
        // dd($themes);
    }

    public function testPageCodeTrimmer(){
        $codeSample1 = '// Action Start
                // Uses: App\User, Illuminate\Http\Request, Illuminate\Http\Response, RevCMS\RevCMS, Carbon\Carbon
                // Inject: $id, \Request $request, Rev $rev

                if(!$request->ajax()) return response("Access Denied.", 402);

                $user = User::findOrFail($id);
                $age = $this->getAgeOf($user);
                $viewData["user"] = $user;

                // Action End
                // Helpers Start

                // Public Start
                function getAgeOf($user = null){
                    if(!$user) return false;

                    return $user->birth_date
                                ->diffInYears(Carbon::now()->format("Y"));
                }
                // Public End

                // Helpers End';
        $codeSample2 = '// Uses: App\Post, Illuminate\Http\Request, Illuminate\Http\Response, File, Carbon\Carbon
                // Inject: $slug, Request $request
                // Action Start

                $post = Post::findBySlugOrFail($slug);
                $viewData["post"] = $post;

                // Action End
                // Helpers Start
                // Protected Start
                function getAuthorOf($post = null){
                    if(!$post) return false;

                    return $post->author->full_name;
                }
                // Protected End
                // Helpers End';
        // $reg = '/\/\/\s?Action Start(.*)\/\/\s?Action End/';
        $actionReg = '~\/\/\s*action\s*start(.*)\/\/\s*action\s*end~si';
        $helpersReg = '~\/\/\s*helpers\s*start(.*)\/\/\s*helpers\s*end~si';
        $publicHelpersReg = '~\/\/\s*public\s*start(.*)\/\/\s*public\s*end~si';
        $protectedHelpersReg = '~\/\/\s*protected\s*start(.*)\/\/\s*protected\s*end~si';
        $privateHelpersReg = '~\/\/\s*private\s*start(.*)\/\/\s*private\s*end~si';
        $usesReg = '~\/\/\s*uses\s*\:\s*(.*)~i';
        $injectReg = '~\/\/\s*inject\s*\:\s*(.*)~i';
        preg_match_all($helpersReg, $codeSample2, $matches);
        $content = isset($matches[1]) ? isset($matches[1][0]) ? $matches[1][0] : null : $matches[1];
        dd($content);
    }

    
}
