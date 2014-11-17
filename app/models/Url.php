<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class Url extends Eloquent
{
	public $timestamps = false;
	protected $table = 'shortenurl';
	protected $fillable = array('url', 'slug');	
}