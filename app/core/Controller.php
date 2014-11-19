<?php

class Controller
{
	public function __construct()
	{
		
	}

	protected function model( $model )
	{
		if ( file_exists( '../app/models/' . ucfirst( $model ) . '.php' ) )
		{
			require_once '../app/models/' . ucfirst( $model ) . '.php';
			return new $model();
		}
		else
		{
			# Error Handler
			self::view('Error/Error', 'An Error Ocurred [#NOMODEL]');
		}
	}

	public static function view( $view, $data = array() )
	{
		if ( file_exists( '../app/views/' . ucfirst( $view ) . '.php' ) )
		{
			require_once '../app/views/Layout/Header.php';
			require_once '../app/views/' . ucfirst( $view ) . '.php';
			require_once '../app/views/Layout/Footer.php';
		}
		else
		{
			# Error Handler
			self::view('Error/Error', 'An Error Ocurred [#NOVIEW]');
		}
	}

	public static function redirect( $url, $code='307' ) // Using http response code 307 as URL Redirect may be altered for spam purposes. 302 is lending too much credence to the redirect. @see http://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html
	{
		header( 'Location: '. $url, $code );
		exit;
	}
}