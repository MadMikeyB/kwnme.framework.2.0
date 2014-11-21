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
		$input = $_POST;
		$remember = false;		
		if ( $input )
		{
			if ( isset( $input['rememberme'] ) )
			{
				$remember = true;
			}


			Auth::attempt( $input['email'], $input['password'],  $remember );
		}
		else
		{
			$this->view('User/Login');
		}
	}

	public function create()
	{
		$input = $_POST; // gotta be a better way
		if ( $input )
		{
			KwnUser::create(
					array(
							'username' 	=> $input['username'],
							'email'		=> $input['email'],
							'password'	=> password_hash($input['password'], PASSWORD_BCRYPT ),
							'group_id'	=> '1',
					)
			);

			$this->redirect('login');
		}
		else
		{
			$this->view('User/Register');
		}
	}

	public function admin()
	{
		KwnUser::all(); 
		$this->view('User/Admin/Index', $users);
	}
}