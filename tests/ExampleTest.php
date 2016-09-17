<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
class ExampleTest extends TestCase
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
        $block = \File::get('app/Http/Controllers/Test/TestControll1.php');
        preg_match_all($re, $block, $matches);
        dd(trim(trim($matches[0][0], '}'), '{'));
    }
}
