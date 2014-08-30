<?php

class UsersController extends AppController
{
	var $name = 'Users';
	var $uses = array('User');

	function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->allow('login', 'logout');
	}

	function home()
	{
	}

	function login()
	{
		$this->twitter_login();
	}

	function logout()
	{
		$this->twitter_logout();
	}
}