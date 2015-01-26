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
			exit;
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


	public static function limit( $string, $length, $start=0, $end="&#133;" )
	{
		if ( strlen( $string ) > $length ) 
		{ 
			return substr( $string , $start, $length ) . $end; 
		}
		else
		{
			return $string;
		}
	}

	public static function slugify( $string )
	{
		$string = preg_replace('#[^a-zA-Z0-9]#', '-', $string);
		$string = preg_replace('#\-{2,}#', '-', $string); // remove  double dashes
		$string = preg_replace('#^\-+#', '', $string); // remove leading dashes
		$string = preg_replace('#\-+$#', '', $string); // remove trailing dashes
		$string = strtolower($string);
		
		// strip single dashes
		$array = explode('-', $string);
		
		if ( $array )
		{
			foreach ( $array as $k => $a )
			{				
				if ( strlen($a) < 2 )
				{						
					unset($array[$k]);
				}
			}
		}
		
		$string = implode('-', $array);
			
		if ( KwnPage::findBySlug($string) )
		{
			$string .= '-' . rand(1,999999);
			return $string;
		}
		else
		{
			return $string;
		}
	}
	
}