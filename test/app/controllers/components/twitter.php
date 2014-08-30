<?php

/**
 * Twitter API
 * Access Token & Access Token Secret
 */
define('TWITTER_CONSUMER_KEY',        'AmGRkgdMET7Ldlhg22ZUQ');
define('TWITTER_CONSUMER_SECRET',     'qVtBMPAU7rBNYotrsHItU2O5wU46o8RhmKgQSx36E');
define('TWITTER_ACCESS_TOKEN',        '335754187-3gwt5xaHPZCrwXUGsmGpF6MGOnmhtrk5Lae7ACT5');
define('TWITTER_ACCESS_TOKEN_SECRET', 'vIPV7Zmb7UP4na2nvL7AFYRIEpBWd8lGdyQBANzYa18');

App::import('Vendor', 'Twitter', array('file'=>'OAuth'.DS.'twitter_oauth.php'));

class TwitterComponent extends Object
{
	var $components = array('Session', 'Json');

	function TwitterComponent()
	{
	}

	function tweet_owner($message)
	{
		$tw = new TwitterOauth(TWITTER_CONSUMER_KEY, TWITTER_CONSUMER_SECRET, TWITTER_ACCESS_TOKEN, TWITTER_ACCESS_TOKEN_SECRET);

		$param = array(
		    'status' => $message,
		);

		return $tw->oauth_request('statuses/update', $param, 'POST');
	}

	function tweet($message)
	{
		$param = array(
		    'status' => $message,
		);

		return $this->post('statuses/update', $param);
	}

	function get_authorize_url()
	{
		$tw = new TwitterOauth(TWITTER_CONSUMER_KEY, TWITTER_CONSUMER_SECRET);

		if($tw->get_request_token())
		{
			return $tw->get_authorize_url();
		}

		return null;
	}

	function get_authenticate_url()
	{
		$tw = new TwitterOauth(TWITTER_CONSUMER_KEY, TWITTER_CONSUMER_SECRET);

		if($tw->get_request_token())
		{
			$this->Session->write('Twitter.request_token', $tw->token);
			return $tw->get_authenticate_url();
		}

		return null;
	}

	function get_access_token($oauth_verifier = null)
	{
		$request_token = $this->Session->read('Twitter.request_token');
		$tw = new TwitterOauth(TWITTER_CONSUMER_KEY, TWITTER_CONSUMER_SECRET, $request_token['key'], $request_token['secret']);

		if($tw->get_access_token($oauth_verifier))
		{
			$this->Session->write('Twitter.access_token', $tw->token);
			return $tw->token;
		}

		return null;
	}

	function get($url, $param = array())
	{
		$access_token = $this->Session->read('Twitter.access_token');
		$tw = new TwitterOauth(TWITTER_CONSUMER_KEY, TWITTER_CONSUMER_SECRET, $access_token['key'], $access_token['secret']);

		$response = $tw->oauth_request($url, $param, 'GET');
		return $this->Json->decode($response);
	}

	function post($url, $param = array())
	{
		$access_token = $this->Session->read('Twitter.access_token');
		$tw = new TwitterOauth(TWITTER_CONSUMER_KEY, TWITTER_CONSUMER_SECRET, $access_token['key'], $access_token['secret']);

		$response = $tw->oauth_request($url, $param, 'POST');
		return $this->Json->decode($response);
	}
}
