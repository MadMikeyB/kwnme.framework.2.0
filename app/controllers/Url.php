<?php

class Url extends Controller
{
	public function index()
	{
		$input = $_POST;
		if ( $input )
		{
			//$base = base_convert($maxId, 12, 32);

			$shortUrl = Url::create(
							array(
									'url'	=> $input['url'],
									'slug'	=> isset( $input['slug'] ) ? $input['slug'] : NULL,
							)
						);
			$this->view('Url/Result', $input);
		}
		else
		{		
			$this->view('Url/Index');
		}
	}

}