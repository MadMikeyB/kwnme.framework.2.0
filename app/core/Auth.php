<?php

class Auth 
{

	//public static $user;
	public static $password;

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
			$_SESSION['userid'] = $user->id;
			# @todo AUTH TOKEN
			dd($_SESSION);
		}

	}

	/**
	 *	Check if user is authenticated
	 *	@return boolean
	 **/

	public static function check( $user )
	{

	}

	/**
	 *	Destroy user session
	 *	@return null
	 **/

	public static function destroy( $user='' )
	{

	}


}