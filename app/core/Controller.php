<?php

class Controller
{
	public function __construct()
	{

	}

	protected function model( $model )
	{
		if ( file_exists( '../app/models/' . $model . '.php' ) )
		{
			require_once '../app/models/' . $model . '.php';
			return new $model();
		}
		else
		{
			# Error Handler
		}
	}

	public function view( $view, $data = array() )
	{
		if ( file_exists( '../app/views/' . $view . '.php' ) )
		{
			require_once '../app/views/' . $view . '.php';
		}
		else
		{
			# Error Handler
		}
	}
}