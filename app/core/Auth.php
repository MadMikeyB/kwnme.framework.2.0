<?php

class Auth 
{

	public static $user;

	/**
	 *	Attempt authentication
	 *	Used for login
	 *	@return boolean
	 **/

	public static function attempt( $username, $password, $remember )
	{
		$user = KwnUser::where( 'username', '=', $username )->get();
		dd($user);
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