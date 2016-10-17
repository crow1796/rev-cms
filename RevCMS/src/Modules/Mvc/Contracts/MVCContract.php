<?php 

namespace RevCMS\Modules\Mvc\Contracts;

interface MVCContract{
	public function make($name, $resource = false);
	public function all();
	public function getFrom($directories = array());
	public function format($controllers = array());
	public function getContent($controller = null);
	public function deleteSubject($subjects = array());
	public function updateContent($newData);
}