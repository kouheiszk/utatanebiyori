<?php

class TwitterController extends AppController
{
	var $name = 'Twitter';
	var $uses = array('User');

	function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->Allow('*');
	}

	function login()
	{
		$this->twitter_login();
	}

	function logout()
	{
		$this->twitter_logout();
	}

	function cancel()
	{
		echo 'キャンセルされました。';
		exit;
	}

	function callback()
	{
		if(isset($this->params['url']['oauth_verifier']))
		{
			$access_token = $this->Twitter->get_access_token($this->params['url']['oauth_verifier']);

			$data = $this->Twitter->get('account/verify_credentials');

			if($data)
			{
				$this->Session->write('Twitter.id', $data['id_str']);

				$this->User->update(array(
					'twitter_id'          => $data['id_str'],
					'twitter_account'     => $data['screen_name'],
					'user_name'           => $data['name'],
					'access_token'        => $access_token['key'],
					'access_token_secret' => $access_token['secret'],
				));

				$user['User']['access_token'] = $access_token['key'];
				$user['User']['access_token_secret'] = $access_token['secret'];

				if ($this->Auth->login($user))
				{
					if($this->Session->read('redirect'))
					{
						$this->redirect($this->Session->read('redirect'));
					}
					$this->redirect('/user/home.html');
				}
			}
			$this->redirect('/twitter/cancel.html');
		}
		if(isset($this->params['url']['denied']))
		{
			$this->redirect('/twitter/cancel.html?denied=' . $this->params['url']['denied']);
		}

	}

}