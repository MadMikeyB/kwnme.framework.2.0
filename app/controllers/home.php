<?php

class Home extends Controller
{

	public function index()
	{
		$user = User::all();
		$this->view('Home/Index', $user);
	}

	

}