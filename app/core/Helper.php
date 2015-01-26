<?php

class Helper extends Controller
{
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