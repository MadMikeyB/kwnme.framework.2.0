<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class Url extends Eloquent
{
	public $url;
	public $slug;

	public $timestamps = false;
	protected $table = 'shortenurl';
	protected $fillable = array('url', 'slug');

	public function create()
	{
		parent::create();
	}
}