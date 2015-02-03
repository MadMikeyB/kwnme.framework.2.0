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

					if ( $slugCheck )
					{
						$this->view('Error/Error', 'Slug already in use.');
					}
				}

				// SPAM CHECK
				// There's a hidden div containing a text field. Spam bots will fill this in as they like to fill out as much as possible. Allowing us to detect them and block them.
				// @todo - query Project Honeypot and stuff.
				$is_spam = SpamCheck::checkSpammer(
					array(
							'url'	=> $input['url'],
							'ip'	=> $_SERVER['REMOTE_ADDR'],
						)
				);
				
				$is_spam = json_decode($is_spam, true);

				if ( isset( $is_spam['IP'] ) )
				{
					$this->view('Spam/SpamIP');
				}

				if ( isset( $is_spam['URL'] ) )
				{
					$this->view('Spam/SpamURL');
				}

				// check PhishTank
				$vars = array(
								'url'		=> $input['url'],
								'format'	=> 'json',
								'app_key' 	=> '909ec35ba0319ace3ae8f531a2ce7413bc9a831c9c2fbd7020fec6247b484dda'
							);

				$ch = curl_init();
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_USERAGENT, "kwn PhishTank API");
				curl_setopt($ch, CURLOPT_POSTFIELDS, $vars);
				curl_setopt($ch, CURLOPT_URL, 'http://checkurl.phishtank.com/checkurl/');
				$result = curl_exec($ch);
				curl_close($ch);

				$data = json_decode($result);

				if ( is_object( $data ) )
				{
					if ( property_exists( $data->results, 'phish_detail_page' ) )
					{
						$info = array(
							'url'	=> $input['url']
						);
						SpamCheck::logSpammer($info);

						$this->view('Spam/SpamURL');
					}
				}

				// end PhishTank

				if ( $input['email'] )
				{
					$info = array(
								'url'	=> $input['url'],
								'ip'	=> $_SERVER['REMOTE_ADDR']
							);
					SpamCheck::logSpammer($info);
					$this->view('Spam/Spam');
				}

	
				// END SPAM CHECK

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

	public static function forward( $base='', $stats = false )
	{
		// URL
		if ( $url = ShortUrl::findByBase($base) )
		{
			$clicks = ShortUrl::find($url->id);
			$clicks->clickcount = $url->clickcount+1;
			$clicks->createdon = $url->createdon;
			$clicks->lastvisiteddon = date('Y-m-d H:i:s');				
			$clicks->save();

			if ( $stats == true )
			{
				parent::redirect( 'http://kwn.me/stats/' . $url->base );
			}
			else
			{
				parent::redirect( $url->url );		
			}
		}
		// Slug
		else if ( isset($base->url) )
		{
			$clicks = ShortUrl::find($base->id);
			$clicks->clickcount = $base->clickcount+1;
			$clicks->createdon = $base->createdon;
			$clicks->lastvisiteddon = date('Y-m-d H:i:s');	
			$clicks->save();

			if ( $stats == true )
			{
				parent::redirect( 'http://kwn.me/stats/' . $base->slug );
			}
			else
			{
				parent::redirect( $base->url );
			}
		}
		else
		{
			parent::view('Error/Error', 'No URL to redirect to.');
		}
	}

}