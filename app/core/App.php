<?php

use Whoops\Run as WhoopsRun;
use Whoops\Handler\PrettyPageHandler as WhoopsPrettyPageHandler;
use Illuminate\Database\Eloquent\Model as Eloquent;

class App
{
	# Set defaults
	protected $controller = 'url';
	protected $method = 'index';
	protected $params = array();

	# Constructor
	public function __construct()
	{
		session_start();
		$url = self::router();

		$this->initWhoopsErrorHandler();

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

	public function checkForBase( $base )
	{
		require_once '../app/controllers/Url.php';
		$url = ShortUrl::findByBase($base);

		if ( !$url )
		{
			$slug = ShortUrl::findBySlug( $base );
			if ( $slug )
			{
				Url::forward($slug);
			}
		}

		if ( $url )
		{
			Url::forward($base);
		}
	}

	# Error Handler
	public function initWhoopsErrorHandler()
	{
		$whoops = new WhoopsRun();
		$handler = new WhoopsPrettyPageHandler();

		$whoops->pushHandler($handler)->register();

		return $this;
	}

	# Router
	public function router()
	{
		if ( isset( $_GET['url'] ) )
		{
			$url = explode( '/', filter_var( rtrim( $_GET['url'], '/'), FILTER_SANITIZE_URL ) );
			if ( !$this->checkForBase( $url[0] ) )
			{
				return $url;
			}	
		}
	}
}