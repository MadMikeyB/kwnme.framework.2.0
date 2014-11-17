<?php

class Home extends Controller
{

	public function index( $name = '' )
	{
		$user = User::find(1);
		$this->view('Home/Index', $user);

	}

	

}