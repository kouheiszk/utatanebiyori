<?php

class AppController extends Controller
{
	var $components = array('Auth', 'Session', 'Twitter');
	var $uses = null;

	/** User */
	var $current_user;

	function beforeFilter()
	{
		$this->Auth->fields = array(
			'username' => 'access_token',
			'password' => 'access_token_secret'
		);
		$this->Auth->loginError = 'This message shows up when the wrong credentials are used';
		$this->Auth->authError = 'This error shows up with the user tries to access a part of the website that is protected.';

		$this->silent_login();
	}

	function beforeRender()
	{
		$this->set('current_user', $this->current_user);
	}

	function silent_login()
	{
		if($this->Auth->user())
		{
			$this->current_user = $this->Auth->user();
			return true;
		}
		else
		{
			if($this->Session->read('Twitter.id'))
			{
				$user_record = $this->User->find('first', array(
					'conditions' => array(
						'twitter_id' => $this->Session->read('Twitter.id')
					),
					'fields' => array(
						'User.access_token',
						'User.access_token_secret'
					)
				));

				if($user_record)
				{
					$this->Auth->login($user_record);
					$this->current_user = $this->Auth->user();
					return true;
				}
			}
		}

		return false;
	}

	function twitter_login()
	{
		$url = $this->Twitter->get_authenticate_url();
		$this->redirect($url);
	}

	function twitter_logout()
	{
		$this->Session->destroy();
		$this->redirect('/');
	}
}


