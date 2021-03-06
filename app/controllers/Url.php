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

				$input['parsed_url'] = parse_url( $input['url'] );

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
				$is_spam = SpamCheck::checkSpammer(
					array(
							'url'	=> $input['parsed_url']['host'],
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
				// @todo move API key to config
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

				// SpamHaus
				$spamhaus = dns_get_record($input['parsed_url']['host'] . '.dbl.spamhaus.org', DNS_A);
				if ($spamhaus != NULL && count($spamhaus) > 0) 
				{
					$info = array(
								'url'	=> $input['url'],
								'ip'	=> $_SERVER['REMOTE_ADDR']
							);
					SpamCheck::logSpammer($info);
					$this->view(['Spam/SpamURL', 'Page/Terms']);
				}
				// end SpamHaus

				// Automatic Form Filling Robot Check
				if ( $input['email'] )
				{
					$info = array(
								'url'	=> $input['url'],
								'ip'	=> $_SERVER['REMOTE_ADDR']
							);
					SpamCheck::logSpammer($info);
					$this->view('Spam/Spam');
				}
				// end AFFRC

	
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

	/**
	 * @var $base obj URL object (slug) or 
	 * @var $base string URL base (base)
	 * @var $stats bool Statistics
	 */

	public static function forward( $base='', $stats = false )
	{
		// URL
		if ( $url = ShortUrl::findByBase($base) )
		{
			if ( $url->is_spam == '1' )
			{
				parent::view('Error/Error', 'kwn.me has detected that <mark>'.$url->url.'</mark> is a spam URL.<br /><br /> We care about your online safety and will not redirect you to this URL, it has been banned from our service and the IP address of the submitter has been submitted to anti-spam databases.<br /><br /> If you wish to proceed, please do so at your own risk. <br /><br /> Thanks for using kwn.me :)');
			}

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
		else if ( isset( $base ) )
		{
			$slug = ShortUrl::findBySlug($base);

			if ( $base->is_spam == '1' )
			{
				parent::view('Error/Error', 'kwn.me has detected that <mark>'.$base->url.'</mark> is a spam URL.<br /><br /> We care about your online safety and will not redirect you to this URL, it has been banned from our service and the IP address of the submitter has been submitted to anti-spam databases.<br /><br /> If you wish to proceed, please do so at your own risk. <br /><br /> Thanks for using kwn.me :)');
			}

			if ( is_object( $base ) )
			{
				$clicks = ShortUrl::find($base->id);
				$clicks->clickcount = $base->clickcount+1;
				$clicks->createdon = $base->createdon;
				$clicks->lastvisiteddon = date('Y-m-d H:i:s');	
				$clicks->save();
			}

			if ( $stats == true )
			{
				parent::redirect( 'http://kwn.me/stats/' . $slug->slug );
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