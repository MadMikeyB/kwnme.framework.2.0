<?php

class App
{
	# Set defaults
	protected $controller = 'url';
	protected $method = 'index';
	protected $params = array();

	# Constructor
	public function __construct()
	{
		$url = self::parseUrl();

		if ( file_exists( '../app/controllers/' . ucfirst( $url[0] ) . '.php' ) ) # Can we use class_exists?
		{
			$this->controller = $url[0];
			unset($url[0]);
		}

		require_once '../app/controllers/' . ucfirst( $this->controller ). '.php';

		$this->controller = new $this->controller(); # Objectify

		if ( isset( $url[1] ) )
		{
			if ( method_exists( $this->controller, $url[1] ) )
			{
				$this->method = $url[1];
				unset($url[1]);
			}
		}

		$this->params = $url ? array_values($url) : array();

		call_user_func_array( array( $this->controller, $this->method ), $this->params );
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