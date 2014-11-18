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

	public function view( $view, $data = array() )
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

	public function redirect( $url, $code='302' )
	{
		header( 'Location: '. $url, $code );
		exit;
	}
}