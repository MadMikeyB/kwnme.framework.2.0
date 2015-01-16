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

			if ( $user = Auth::attempt( $input['email'], $input['password'],  $remember ) )
			{
				$this->view('User/Dashboard', $user);
			}
			else
			{
				$this->view('Error/Error', 'The email address or password does not match what we have. Remember that passwords are case sensitive. <br /><br /><a href="user/login">Go back</a>');
			}
		}
		else
		{
			if ( $user = Auth::check( $_COOKIE['user'] ) )
			{
				$this->view('User/Dashboard', $user);
			}
			else
			{
				$this->view('User/Login');
			}
		}
	}

	public function create()
	{
		$input = $_POST; // gotta be a better way
		if ( $input )
		{
			$auth_token = base64_encode(
										join(
									        '',
									        array_map(
									            function($x){ return chr(mt_rand(1,255));},
									            range(1,15)
									        )
									    )
									);
			KwnUser::create(
					array(
							'username' 	=> $input['username'],
							'email'		=> $input['email'],
							'password'	=> password_hash($input['password'], PASSWORD_BCRYPT ),
							'group_id'	=> 1,
							'auth_token'=> $auth_token,
					)
			);

			$this->redirect('login');
		}
		else
		{
			$this->view('User/Register');
		}
	}

	public function logout()
	{
		Auth::destroy();
		$this->redirect('/');
	}

	public function admin()
	{
		if ( $user = Auth::check( $_COOKIE['user'] ) )
		{
			if ( $user->group_id >= '2' )
			{
				$users = KwnUser::all(); 
				$this->view('User/Admin/Index', $users);
			}
			else
			{
				$this->view('Error/Error', '<b>Whoops!</b><br /> Your permission level is not high enough to see this page.');
			}
		}
		else
		{
			$this->redirect('user/login');
		}
	}
}