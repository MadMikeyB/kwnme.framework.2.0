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
		if ( $base )
		{
			$url = ShortUrl::findByBase($base);
			if ( $url )
			{
				$clicks = ShortUrl::find($url->id);
				$clicks->clickcount = $url->clickcount+1;
				$clicks->createdon = $url->createdon;
				$clicks->lastvisiteddon = date('Y-m-d H:i:s');
				$clicks->save();

				parent::redirect( $url->url );
			}
			else
			{
				if ( $slug = ShortUrl::findBySlug($base) )
				{
					$clicks = new ShortUrl;
					$clicks->clickcount = $slug->clickcount+1;
					$clicks->lastvisiteddon = time();
					$clicks->save();
				
					parent::redirect( $slug->url );

				}	
				else
				{
					parent::view('Error/Error', 'Invalid Slug');
				}
			}
		}
		else
		{
			parent::view('Error/Error', 'No URL to redirect to.');
		}
	}

}