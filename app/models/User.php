<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class User extends Eloquent
{
	public $name;
	public $email;

	protected $fillable = array('username', 'email');

}