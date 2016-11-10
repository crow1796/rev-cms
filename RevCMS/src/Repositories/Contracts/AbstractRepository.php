<?php 
namespace RevCMS\Repositories\Contracts;
use RevCMS\Repositories\Contracts\Repository as RepositoryContract;
use Illuminate\Container\Container as App;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository implements RepositoryContract {

	protected $app;
	protected $model;

	public function __construct(App $app){
		$this->app = $app;
		$this->model = $this->makeModel();
	}

	public function all($columns = array('*')){
		return $this->model->all($columns);
	}

	protected abstract function model();

	private function makeModel(){
		$model = $this->app->make($this->model());
		if(!$model instanceof Model){
			throw new \Exception($this->model() . ' is not an instance of Illuminate\Database\Eloquent\Model.');
		}
		return $model;
	}
}