<?php

namespace App;
use RevCMS\Traits\Model\PageTrait;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
	use PageTrait;
	protected $table = 'revcms_pages';
	protected $fillable = [
		'title',
		'action',
		'slug',
		'template',
		'hidden',
		'featured_image',
	];
	protected $dates = [
		'created_at',
		'updated_at',
	];
}
