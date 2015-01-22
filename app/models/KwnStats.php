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
}