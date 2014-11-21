<?php

class Auth 
{

	public static $user;
	public static $password;

	/**
	 *	Constructor
	 *	@return null
	 **/

	public function __construct()
	{
		//$this->user = User::where( 'auth_token', '=', $_SESSION['auth_token'] );
	}

	/**
	 *	Attempt authentication
	 *	Used for login
	 *	@return boolean
	 **/

	public static function attempt( $email, $password, $remember )
	{
		$user = KwnUser::where( 'email', '=', $email )->first();

		if ( password_verify( $password, $user->password ) )
		{
			$_SESSION['loggedin'] = '1';
			$_SESSION['auth_token']	= $user->auth_token;
			setcookie('user', $user, time()+60*60*24*30);
			setcookie('loggedin', '1', time()+60*60*24*30);
			setcookie('auth_token', $user->auth_token, time()+60*60*24*30);
			return true;
		}
		else
		{
			return false;
			//Controller::view('Error/Error', 'The email address or password does not match what we have. Remember that passwords are case sensitive. <br /><br /><a href="user/login">Go back</a>');
		}

	}

	/**
	 *	Check if user is authenticated
	 *	@return boolean
	 **/

	public static function check( $user )
	{
		$user = json_decode($user); // Objectify!

		if ( @$_COOKIE['loggedin'] == '1' )
		{
			$check_user = KwnUser::where( 'auth_token', '=', $user->auth_token )->first();
			if ( empty( $check_user ) )
			{
				$check_user = KwnUser::where( 'auth_token', '=', $_SESSION['auth_token'] )->first();
				
				if ( $check_user )
				{
					return $check_user;
				}
				else
				{
					return false;
				}
			}
			else
			{
				return $check_user;
			}
		}
		else
		{
			// destroy session, unset cookies, throw error.
			self::destroy();
			// Controller::view('Error/Error', "Auth token mismatch. You have been logged out. Please <a href='user/login'>re log in.</a>")
			return false;
		}
	}

	/**
	 *	Destroy user session
	 *	@return null
	 **/

	public static function destroy()
	{
		if ( $_SESSION )
		{
			unset($_SESSION['loggedin']);
			unset($_SESSION['auth_token']);
			session_destroy();
			setcookie('loggedin', '', time()+60*60*24*30);
			setcookie('auth_token', '', time()+60*60*24*30);
		}
	}


}