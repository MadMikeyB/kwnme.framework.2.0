<?php

class User extends Controller
{
	//protected $user;

	public function index()
	{
		# Redirect to login
		self::login();
	}

	public function login()
	{
		$this->view('User/Login');
	}

	public function create()
	{
		$input = $_POST; // gotta be a better way
		if ( $input )
		{
			User::create(
					array(
							'username' 	=> $input['username'],
							'email'		=> $input['email'],
							'password'	=> $input['password'],
					)
			);

			$this->redirect('/login');
		}
		else
		{
			$this->view('User/Register');
		}
	}

	public function admin()
	{
		User::all(); // User:: not working here. :(
		$this->view('User/Admin/Index', $users);
	}
}