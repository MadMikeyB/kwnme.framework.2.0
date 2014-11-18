<?php

class Home extends Controller
{

	public function index()
	{
		$user = User::all(); // Eloquent Works here.
		$this->view('Home/Index', $user);
	}

	

}
