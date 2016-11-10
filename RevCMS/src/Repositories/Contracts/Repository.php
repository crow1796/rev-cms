<?php 
namespace RevCMS\Repositories\Contracts;

interface Repository {
	public function all($columns = array('*'));
}