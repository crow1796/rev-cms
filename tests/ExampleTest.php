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
                            return $item;
                        })
                        ->pipe(function($collection){
                            return $collection->splice(0, $collection->count() - 1);
                        })
                        ->toArray();
        // return $controllers;
        $this->assertTrue(is_array($controllers));
    }
}
