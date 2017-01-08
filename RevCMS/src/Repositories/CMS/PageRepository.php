<?php 
namespace RevCMS\Repositories\CMS;
use RevCMS\Repositories\Contracts\AbstractRepository;

class PageRepository extends AbstractRepository{
	protected function model(){
		return config('revcms.page_model');
	}

	/**
	 * Get all pages for display.
	 * @return array 
	 */
	public function allForDisplay(){
		$pages = $this->model
						->orderBy('title')
						->get();

		$pages = $pages->map(function($page){
			$action = explode('@', $page->action);
			return array(
					'id' => $page->id,
					'title' => $page->title,
					'url' => $page->slug,
					'controller' => $action[0],
					'action' => $action[1],
				);
		});
		return $pages;
	}
}