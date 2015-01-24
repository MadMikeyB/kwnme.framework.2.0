<?php

	/**
 	 * SpamCheck
 	 * 	@brief - Log spammers to db table, to check upon submission. 
 	 * 	Show spammers recaptcha once detected, and log to db
 	 *	Detection - hidden form field on website which is filled by spammers autofill.  	
 	 * 	
 	 *	
 	 *	@todo implement Project Honeypot.
 	 * 	@todo implement DNSBL
 	 **/

use Illuminate\Database\Eloquent\Model as Eloquent;

class SpamCheck extends Eloquent
{
	protected $table = 'kwn_spam';

	public static function logSpammer( $info )
	{
		$spam = new SpamCheck;
		foreach ( $info as $k => $v )
		{
			$spam->$k = $v;
		}	
		$spam->save();
	}

	public static function checkSpammer( $info )
	{
		$ip_response = array();
		$url_response = array();
		$check_ip = SpamCheck::where('ip', '=', $info['ip'])->first();

		if ( $check_ip ) // IP BL
		{
			$ip_response = array("IP" => $check_ip->ip);
		}

		$check_url = SpamCheck::where('url', 'like', '%' . $info['url'] . '%')->first();
		
		if ( $check_url ) // URL BL
		{
			$url_response = array("URL" => $check_url->url);
		}

		return json_encode(array_merge($ip_response, $url_response));
	}

}