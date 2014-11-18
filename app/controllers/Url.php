<?php

class Url extends Controller
{
	public function index()
	{
		$user = User::all(); // Eloquent works here.....
		$input = $_POST;
		if ( $input )
		{
			print_r($input);
			//$base = base_convert($maxId, 12, 32);

			$shortUrl = Url::create( // Eloquent Doesn't work here.
							array(
									'url'	=> $input['url'],
									'slug'	=> isset( $input['slug'] ) ? $input['slug'] : NULL,
							)
						);
			$this->view('Url/Result', $input);
		}
		else
		{		
			$this->view('Url/Index', $user);
		}
	}

}