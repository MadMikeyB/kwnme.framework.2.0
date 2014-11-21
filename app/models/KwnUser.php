<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class KwnUser extends Illuminate\Database\Eloquent\Model
{
    protected $hidden = array('password');
	protected $fillable = array('username', 'email', 'password', 'auth_token');
}