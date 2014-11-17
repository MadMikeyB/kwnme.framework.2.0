<?php

class Home extends Controller
{
	public function index( $name = '' )
	{
		$user = $this->model('User');
		$user->name = $name;
		echo 'Hello ' . $user->name;
	}

}