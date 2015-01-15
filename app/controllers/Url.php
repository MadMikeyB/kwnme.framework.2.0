<?php

class Url extends Controller
{

	public function index()
	{
		$input = $_POST;
		if ( $input )
		{
			if( filter_var( $input['url'], FILTER_VALIDATE_URL ) === FALSE )
			{
				$error = 'Please enter a valid URL.';
				$this->view('Error/Error', $error);
			}
			else
			{
				if ( !empty( $input['slug'] ) )
				{
					$slug = $input['slug'];
				}
				else
				{
					$slug = NULL;
				}

				$maxId = ShortUrl::max('id');
				$base = base_convert($maxId+1, 12, 32);

				if ( $slug !== NULL )
				{
					$slugCheck = ShortUrl::findBySlug( $slug );
					//echo '<xmp>'; print_r($slugCheck->slug); exit;
					if ( $slugCheck )
					{
						$this->view('Error/Error', 'Slug already in use.');
					}
				}

				$shortUrl = new ShortUrl;
				$shortUrl->url = $input['url'];
				$shortUrl->slug = $slug;
				$shortUrl->base = $base;
				$shortUrl->userIP = $_SERVER['REMOTE_ADDR'];
				$shortUrl->clickcount = '1';
				$shortUrl->save();
				
				$this->view('Url/Result', $shortUrl);
			
			}

		}
		else
		{		
			$this->view('Url/Index', '');
		}
	}

	# Bookmarklet
	public function shorten( $url )
	{

	}

	public static function forward( $base='' )
	{
		// URL
		if ( $url = ShortUrl::findByBase($base) )
		{
			$clicks = ShortUrl::find($url->id);
			$clicks->clickcount = $url->clickcount+1;
			$clicks->createdon = $url->createdon;
			$clicks->lastvisiteddon = date('Y-m-d H:i:s');				
			$clicks->save();

			parent::redirect( $url->url );		
		}
		// Slug
		else if ( $base->url )
		{
			$clicks = ShortUrl::find($base->id);
			$clicks->clickcount = $base->clickcount+1;
			$clicks->createdon = $base->createdon;
			$clicks->lastvisiteddon = date('Y-m-d H:i:s');				
			$clicks->save();

			parent::redirect( $base->url );
		}
		else
		{
			parent::view('Error/Error', 'No URL to redirect to.');
		}
	}

}