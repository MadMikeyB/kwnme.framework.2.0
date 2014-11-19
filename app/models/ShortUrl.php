<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class ShortUrl extends Eloquent
{
	//public $url;
	//public $slug;

	public $timestamps = false;
	protected $table = 'shortenurl';
	protected $fillable = array('url', 'slug');

	public static function findByBase( $base='' )
	{
		$url = ShortUrl::where('base', '=', $base)->first();
		return $url;
	}

	public static function findBySlug( $slug='' )
	{
		$url = ShortUrl::where('slug', '=', $slug)->first();
		return $url;
	}
}