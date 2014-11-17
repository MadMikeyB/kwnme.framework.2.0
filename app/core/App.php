<?php

class App
{
	# Set defaults
	protected $controller = 'home';
	protected $method = 'index';
	protected $params = []; // array(); ? 

	# Constructor
	public function __construct()
	{
		$url = self::parseUrl();
	}

	# Router
	public function parseUrl()
	{
		if ( isset( $_GET['url'] ) )
		{
			return $url = explode( '/', filter_var( rtrim( $_GET['url'], '/'), FILTER_SANITIZE_URL ) );
		}
	}
}