<?php 
namespace RevCMS\Modules\Cms\Builder;
use RevCMS\Modules\Cms\Builder\Abstracts\PageBuilder;

class PageRecordBuilder extends PageBuilder {

	/**
	 * Create new row for page in database.
	 * @param  array  $page 
	 * @return mixed       
	 */
	public function buildFor($page = array()){
		parent::buildFor($page);

		$model = $this->app
						->make(config('revcms.page_model'));
		$page['action'] = $page['controller'] . '@' . $page['action_name'];
		try {
			$model->create($page);
		} catch (\Illuminate\Database\QueryException $e) {
			return false;
		}

		return $page;
	}
}