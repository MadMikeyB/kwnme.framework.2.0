<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class KwnPage extends Eloquent
{
	protected $table = 'kwn_page';
	protected $fillable = array('title', 'slug', 'content');

	public static function findBySlug( $slug )
	{
		$page = KwnPage::where('slug', '=', $slug)->first();
		if ( $page )
		{
			return $page;
		}
	}
}