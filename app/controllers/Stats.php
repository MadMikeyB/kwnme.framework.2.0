<?php

class Stats extends Controller
{
	public function index( $base=null )
	{
		$url = ShortUrl::findByBase( $base );
		
		if ( !$url )
		{
			$this->view('Stats/IdxStats');
		}
		else
		{
			$this->view('Stats/Stats', array( $base, $url ) );
		}
	}
}