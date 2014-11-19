<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class User extends Illuminate\Database\Eloquent\Model
{
	public $name;
	public $email;
	protected $fillable = array('username', 'email', 'password');
}