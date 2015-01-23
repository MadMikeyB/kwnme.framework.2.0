<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class KwnStats extends Eloquent
{
	public static function findTopStats()
	{
		$stats = ShortUrl::where('clickcount', '>', '2')->orderBy('clickcount', 'desc')->limit('10')->get();
		if ( $stats )
		{
			return $stats;
		}
	}	

	public static function latestURL()
	{
		$url = ShortUrl::where('url', '!=', '')->orderBy('id', 'desc')->first();
		if ( $url )
		{
			return ($url->slug ? $url->slug : $url->base);
		}
	}

	public static function mostPopularURL()
	{
		$url = ShortUrl::where('clickcount', '>', '2')->orderBy('clickcount', 'desc')->first();
		if ( $url )
		{
			$pop = array();
			$pop['url'] = $url->url;
			$pop['base'] = ($url->slug ? $url->slug : $url->base);
			$pop['clicks'] = $url->clickcount;
			return $pop;
		}
	}

	public static function countUrls( $custom = false )
	{
		if ( $custom == true )
		{
			$count = ShortUrl::where('slug', '!=', '')->count();
		}
		else
		{
			$count = ShortUrl::all()->count();
		}

		if ( $count )
		{
			return $count;
		}
	}
}