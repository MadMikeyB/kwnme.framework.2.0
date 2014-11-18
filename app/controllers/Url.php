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
				$shortUrl = new Url();
				$shortUrl->url = $input['url'];
				$shortUrl->slug = isset( $input['slug'] ) ? $input['slug'] : NULL;
				$shortUrl->userIP = $_SERVER['REMOTE_ADDR'];
				$shortUrl->save();

				$shortUrl->base = base_convert($shortUrl->id, 12, 32);
				$shortUrl->update();

				$this->view('Url/Result', $shortUrl);
			}

		}
		else
		{		
			$this->view('Url/Index', '');
		}
	}

	public function forward( $url='' )
	{
		$_url = Url::where( 'url', '=', $url );
		if ( $_url )
		{
			$clicks = new Url();
			$clicks->clickcount = $_url->clickount +1;
			$clicks->lastvisited = time();
			$clicks->save();

			$this->redirect( $_url->url );
		}
		else
		{
			$this->view('Error/Error', 'Invalid Slug');
		}
	}

}