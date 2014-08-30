<?php
class User extends AppModel
{
	var $name = 'User';
	var $useTable = 'users';

	function update($user_data)
	{
		$user = $this->find('first', array(
			'conditions' => array(
				'twitter_id' => $user_data['twitter_id']
			)
		));

		if(! $user)
		{
			$this->create();
		}
		else
		{
			$user_data['id'] = $user['User']['id'];
		}

		$this->save($user_data);
	}
}
