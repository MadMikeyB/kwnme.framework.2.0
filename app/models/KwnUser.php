<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class KwnUser extends Illuminate\Database\Eloquent\Model
{
	public $name;
	public $email;

    protected $hidden = array('password');
	protected $fillable = array('username', 'email', 'password');
}