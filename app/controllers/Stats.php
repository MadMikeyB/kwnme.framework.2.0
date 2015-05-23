<?php

class Stats extends Controller
{
	public function index( $base=null )
	{
		$url = ShortUrl::findByBase( $base );
		
		if ( !$url )
		{
			$url = ShortUrl::findBySlug($base);
		}

		if ( !$url )
		{
			$stats = KwnStats::findTopStats();
			$this->view('Stats/IdxStats', $stats);
		}
		else
		{
			$this->view('Stats/Stats', array( $base, $url ) );
		}
	}
}