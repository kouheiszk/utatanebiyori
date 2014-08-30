<?php

/*
  TwitterOauth

  PHP Version: 4 ～ 5

  [用語定義]

    Service Provider
        OAuth 経由でユーザーリソースを提供するウェブアプリケーション

    Consumer
        User の同意のもと Service Provider の持つユーザーリソースへアクセスする
        Web サイトもしくはクライアントアプリケーション

    User
        Service Provider 上にアカウントを持っているエンドユーザー

    Consumer Key
        Service Provider 側で識別するための、Consumer の識別子

    Consumer Secret
        Consumer 自身が、その Consumer Key の所有者であることを証明するための秘密鍵

    Request Token
        Consumer が User からリソースへアクセスする同意を得るための値。Access Token と交換される。

    Access Token
        Consumer が User の同意のもと、Service Provider 上のリソースへアクセスする際に利用する値。
        Service Provider 上の ID・パスワードの代わりに使われる。

    Token Secret
        Consumer が与えられた Token の所有者であることを証明するための秘密鍵

  [処理フロー]

    1. Consumer         --> Request Tokenの取得               --> Service Provider (get_request_token)
    2. Service Provider --> Request Tokenの発行               --> Consumer
    3. Consumer         --> アクセス認可要求                  --> User             (getAuthorizeURL)
    4. User             --> アクセス認可によるPINコードの返却 --> Consumer
    5. Consumer         --> Access  Tokenの取得               --> Service Provider (getAccessToken)
    6. Service Provider --> Access  Tokenの発行               --> Consumer
    7. Consumer         --> APIリクエスト                     --> Twitter          (oauth_request)

  ※参考：http://oauth.net/core/1.0a

*/

class TwitterOauth {
	/* Twitter Consumer key */
	var $consumer = null;

	/* Twitter Consumer secret */
	var $token    = null;

	/* Twitter PinCode */
	var $verifier     = '';

	/* Set up the API root URL. */
	var $host = 'https://api.twitter.com/1/';

	/* Respons format. */
	var $format = 'json';

	/* CURL setopt Proxy */
	var $proxy_host   = '';
	var $proxy_port   = '';

	/* Contains the last HTTP status code returned */
	var $http_code;

	/* Contains the last API call */
	var $last_api_call;

	/* Set timeout default */
	var $timeout = 30;

	/* Set connect timeout */
	var $connect_timeout = 30;

	/* Verify SSL Cert */
	var $ssl_verifypeer = FALSE;

	/**
	 * Constructor
	 *
	 * @param unknown_type $consumer_key
	 * @param unknown_type $consumer_secret
	 * @param unknown_type $oauth_token
	 * @param unknown_type $oauth_token_secret
	 */
	function TwitterOauth($consumer_key, $consumer_secret, $oauth_token = null, $oauth_token_secret = null)
	{
		/* Consumer keyとConsumer secretを格納 */
		$this->consumer = array('key' => $consumer_key, 'secret' => $consumer_secret);

		/* oauth_tokenとoauth_token_secretの指定があれば格納 */
		if(! empty($oauth_token) && ! empty($oauth_token_secret))
		{
			$this->token = array('key' => $oauth_token, 'secret' => $oauth_token_secret);
		}
	}

	/**
	 * Proxy Hostの設定
	 *
	 * @param unknown_type $host
	 */
	function set_proxy_host($host)
	{
		$this->proxy_host = '';
		if(is_scalar($host))
		{
			$this->proxy_host = $host;
		}
	}

	/**
	 * Proxy Portの設定
	 *
	 * @param $port
	 */
	function set_proxy_port($port)
	{
		$this->proxy_port ='';
		if(is_scalar($port)){
			$this->proxy_port = $port;
		}
	}

	/**
	 * Request Tokenの取得
	 *
	 * @param $oauth_callback
	 */
	function get_request_token($oauth_callback = null)
	{
		$params = array();

		/*
		    PINコード入手時のCallBack URLの設定
		    ※Twitter Applicationの登録ページにて、
		   「Twitter Application Type」を"Client"に設定しないと駄目?
		    "Browser"に設定されている場合は、当パラメータは無視。
		    Application登録時に設定されたcallback URLが優先される。
		*/
		if(! empty($oauth_callback))
		{
			$params['oauth_callback'] = $oauth_callback;
		}

		/* Request token URLの取得 */
		$url = $this->request_token_url();

		/* Request Tokenの取得 */
		$url  = $this->oauth_sign_get($url, $params);
		$bits = $this->url_to_hash($url);

		/* oauth_tokenの取得結果を格納 */
		$this->token['key']    = isset($bits['oauth_token'])? $bits['oauth_token'] : '';
		$this->token['secret'] = isset($bits['oauth_token_secret'])? $bits['oauth_token_secret'] : '';

		/* 取得成功 */
		if($this->token['key'] && $this->token['secret'])
		{
			return TRUE;
		}

		/* 取得失敗 */
		return FALSE;
	}

	/**
	 * アクセス認可ページのURL取得
	 *
	 */
	function get_authorize_url()
	{
		/* ユーザー側にアクセスさせるリダイレクト先のURL */
		return sprintf("%s?oauth_token=%s", $this->authorize_url(), $this->token['key']);
	}

	/**
	 * アクセス認可ページのURL取得
	 *
	 */
	function get_authenticate_url()
	{
		/* ユーザー側にアクセスさせるリダイレクト先のURL */
		return sprintf("%s?oauth_token=%s", $this->authenticate_url(), $this->token['key']);
	}

	/**
	 * Access Tokenの取得
	 *
	 * @param $oauth_verifier
	 */
	function get_access_token($oauth_verifier = null)
	{
		$params = array();

		if(! empty($oauth_verifier))
		{
			$this->verifier = $oauth_verifier;
		}

		/* Access Token URLの取得 */
		$url = $this->access_token_url();

		/* Access Tokenの取得 */
		$url  = $this->oauth_sign_get($url, $params);

		$bits = $this->url_to_hash($url);

		/* oauth_tokenの取得結果を格納 */
		$this->token['key']    = isset( $bits['oauth_token'] ) ? $bits['oauth_token'] : '';
		$this->token['secret'] = isset( $bits['oauth_token_secret'] ) ? $bits['oauth_token_secret'] : '';

		/* 取得成功 */
		if($this->token['key'] && $this->token['secret'])
		{
			return TRUE;
		}

		/* 取得失敗 */
		return FALSE;
	}

	function get_access_token_and_access_token_secret()
	{
		return $this->token;
	}

	/**
	 * oauth APIパラメータの作成
	 *
	 * @param unknown_type $url
	 * @param unknown_type $params
	 * @param unknown_type $method
	 */
	function oauth_sign($url, $params = array(), $method='GET')
	{
		$url_parsed = parse_url($url);

		/* URLのQUERY_STRINGを分解し、パラメータ値を取得する。*/
		if(isset($url_parsed['query']))
		{
			parse_str($url_parsed['query'], $url_params);
			$params = array_merge($params , $url_params);
		}

		/* OAuthパラメータの組み立て */
		$oauth_params = $params;

		/* 基本情報 */
		$oauth_params['oauth_version']      = '1.0';
		$oauth_params['oauth_nonce']        = $this->generate_nonce();
		$oauth_params['oauth_timestamp']    = $this->generate_timestamp();
		$oauth_params['oauth_consumer_key'] = $this->consumer['key'];

		/* oauth tokenが存在するなら設定 */
		if(isset($this->token['key']))
		{
			$oauth_params['oauth_token'] = $this->token['key'];
		}

		/* PINコードが存在するなら設定 */
		if($this->verifier)
		{
			$oauth_params['oauth_verifier'] = $this->verifier;
		}

		/* 署名 */
		$oauth_params['oauth_signature_method'] = 'HMAC-SHA1';
		$oauth_params['oauth_signature']        = $this->build_signature($url, $oauth_params, $method);

		return $oauth_params;
	}

	/**
	 * HTTP／HTTPS通信用のリクエストメソッド
	 *
	 * @param unknown_type $url
	 * @param unknown_type $method
	 * @param unknown_type $postfields
	 */
	function http_request($url, $method = 'GET', $postfields = null)
	{
		/* CURLでキュンキュン☆ */
		$r = curl_init();

		/* 接続情報 */
		curl_setopt($r, CURLOPT_CONNECTTIMEOUT , $this->connect_timeout);
		curl_setopt($r, CURLOPT_TIMEOUT        , $this->timeout);
		curl_setopt($r, CURLOPT_RETURNTRANSFER , TRUE);
		curl_setopt($r, CURLOPT_HTTPHEADER     , array('Expect:'));
		curl_setopt($r, CURLOPT_SSL_VERIFYPEER , $this->ssl_verifypeer);
		curl_setopt($r, CURLOPT_URL            , $url);

		/* DEBUG */
		#curl_setopt( $r, CURLOPT_VERBOSE, TRUE);

		/* Proxy使用設定 */
		if($this->proxy_host && $this->proxy_port)
		{
			curl_setopt($r, CURLOPT_HTTPPROXYTUNNEL, 1);
			curl_setopt($r, CURLOPT_PROXY     , $this->proxy_host);
			curl_setopt($r, CURLOPT_PROXYPORT , $this->proxy_port);
		}

		/* 通信メソッド毎のアクセス方法の設定 */
		switch(strtoupper($method))
		{
			case 'POST':
				curl_setopt($r, CURLOPT_POST, TRUE);

				/* リクエストパラメータの設定 */
				if(isset($postfields))
				{
					curl_setopt($r, CURLOPT_POSTFIELDS, $this->to_postdata($postfields));
				}

				break;

			case 'DELETE':
				curl_setopt($r, CURLOPT_CUSTOMREQUEST, 'DELETE');
		}

		/* 通信GO! */
		$response = curl_exec($r);
		$this->http_code     = curl_getinfo($r, CURLINFO_HTTP_CODE);
		$this->last_api_call = $url;

		/* 通信終了 */
		curl_close($r);

		return $response;
	}

	/**
	 * oauth requestのURL作成 (GET用)
	 *
	 * @param $url
	 * @param $params
	 */
	function oauth_sign_get($url, $params = array())
	{
		$params = $this->oauth_sign($url, $params, 'GET');
		$url= $this->normalize_http_url($url) . '?' . $this->to_postdata($params);

		return $url;
	}


	/**
	 * oauth requestのURL作成 (POST用)
	 *
	 * @param $url
	 * @param $params
	 */
	function oauth_sign_post($url, &$params)
	{
		if(! is_array($params))
		{
			$params = array();
		}

		$params = $this->oauth_sign($url, $params, 'POST');
		$url= $this->normalize_http_url($url);

		return $url;
	}


	/* oauth request 実行 */
	function oauth_request($url, $params = array(), $method = 'GET')
	{
		if (strrpos($url, 'https://') !== 0 && strrpos($url, 'http://') !== 0)
		{
			$url = "{$this->host}{$url}.{$this->format}";
		}
		/* 通信メソッドの判別 */
		switch(strtoupper($method))
		{
			case 'POST':
				$url = $this->oauth_sign_post($url, $params);
				$response = $this->http_request($url, $method, $params);
				break;

			default:
				$url = $this->oauth_sign_get($url, $params);
				$response = $this->http_request($url);
				break;
		}

		return $response;
	}


	/*
	  署名の対象となる文字列を作成する。

	  ・リクエストメソッド(GET/POST等)
	  ・リクエストを投げるURI (?以降は含まない)
	  ・リクエストに絡む情報すべて(※1)

	  すべてを、「&」で結んだあとに、一括してurlencodeします。
	  このsignature base stringに対して、指定したアルゴリズム(HMAC-SHA1 )で処理したあと、
	  base64エンコーディングします(改行コード等は取り除く)

	  (例)
	  POST&http%3A%2F%2Fexample.net%2Fapi.php&oauth_consumer_key=dpf43f3p2l4k3l03%26
	  oauth_nonce=kllo9940pd9333jh%26oauth_signature_method=HMAC-SHA1%26oauth_timestamp=1191242096%26
	  oauth_token=nnch734d00sl2jdk%26oauth_version=1.0

	  */
	function build_signature($url, $params, $method)
	{
		$sig = array($this->urlencode_rfc3986(strtoupper($method)),
		             $this->urlencode_rfc3986($this->normalize_http_url($url)),
		             $this->urlencode_rfc3986($this->get_signable_parameters($params)),
		);

		$key = $this->urlencode_rfc3986($this->consumer['secret']) . '&';

		if(isset($this->token['key']))
		{
			$key .= $this->urlencode_rfc3986($this->token['secret']);
		}

		$raw = implode('&', $sig);
		$hashed = base64_encode($this->hmac_sha1($raw, $key, TRUE));

		return $hashed;
	}

	/*
	  URLエンコード

	  RFC3986 Appendix A. Collected ABNF for URI

	  URI = scheme ":" hier-part [ "?" query ] [ "#" fragment ]

	  query = *( pchar / "/" / "?" )

	  pchar = unreserved / pct-encoded / sub-delims / ":" / "@"

	  unreserved = ALPHA / DIGIT / "-" / "." / "_" / "~"

	  pct-encoded = "%" HEXDIG HEXDIG

	  sub-delims = "!" / "$" / "&" / "'" / "(" / ")"

	  / "*" / "+" / "," / ";" / "="

	  http://www.spencernetwork.org/reference/rfc1738-ja-URL.txt

	  */
	function urlencode_rfc3986($str = '')
	{
		return str_replace(
		    '+',
		    ' ',
		    str_replace('%7E', '~', rawurlencode($str))
		);
	}

	/**
	 * URLのnormalize
	 *
	 * @param $url
	 */
	function normalize_http_url($url)
	{
		$parts = parse_url($url);
		$port = '';

		if(array_key_exists('port', $parts) && $parts['port'] != '80')
		{
			$port = ':' . $parts['port'];
		}

		return $parts['scheme'] . '://' . $parts['host'] . $port . $parts['path'];
	}

	/**
	 * 署名作成時のリクエストパラメータ連結用
	 *
	 * @param $params
	 */
	function get_signable_parameters($params)
	{
		$sorted = $params;
		ksort($sorted);

		$total = array();
		foreach ($sorted as $key => $value)
		{
			if($key == 'oauth_signature') continue;
			$total[] = $this->urlencode_rfc3986($key) . '=' . $this->urlencode_rfc3986($value);
		}

		return implode('&', $total);
	}

	/**
	 * URL作成時のリクエストパラメータ連結用
	 *
	 * @param unknown_type $params
	 */
	function to_postdata($params)
	{
		$total = array();
		foreach ($params as $key => $value)
		{
			$total[] = $this->urlencode_rfc3986($key) . '=' . $this->urlencode_rfc3986($value);
		}

		$out = implode('&', $total);
		return $out;
	}

	/**
	 * 作成時間のタイムスタンプ取得
	 *
	 */
	function generate_timestamp()
	{
		return time();
	}

	/**
	 * 一意性を表す文字列の作成用
	 *
	 */
	function generate_nonce()
	{
		$mt     = microtime();
		$rand   = mt_rand();

		return md5($mt . $rand); // md5s look nicer than numbers
	}

	/**
	 * hmac_sha1暗号化
	 *
	 * @param unknown_type $data
	 * @param unknown_type $key
	 * @param unknown_type $raw
	 */
	function hmac_sha1($data, $key, $raw=TRUE)
	{
		if (strlen($key) > 64)
		{
			$key =  pack('H40', sha1($key));
		}

		if (strlen($key) < 64)
		{
			$key = str_pad($key, 64, chr(0));
		}

		$_ipad = (substr($key, 0, 64) ^ str_repeat(chr(0x36), 64));
		$_opad = (substr($key, 0, 64) ^ str_repeat(chr(0x5C), 64));

		$hex = sha1($_opad . pack('H40', sha1($_ipad . $data)));

		if ($raw)
		{
			$bin = '';

			while (strlen($hex))
			{
				$bin .= chr(hexdec(substr($hex, 0, 2)));
				$hex = substr($hex, 2);
			}

			return $bin;
		}

		return $hex;
	}

	/**
	 * URLパラメータ → hash展開用
	 *
	 * @param unknown_type $url
	 */
	function url_to_hash($url)
	{
		$bits = explode('&', $this->http_request($url));

		$hash = array();

		foreach ($bits as $bit)
		{
			$bit = preg_replace('/\s+/i', '', $bit);
			if(empty($bit)) continue;

			list($key, $value) = explode('=', $bit, 2);
			$hash[urldecode($key)] = urldecode($value);
		}

		return $hash;
	}

	/**
	 *
	 */

	/**
	 * Request token URL
	 *
	 */
	function request_token_url()
	{
		return 'https://api.twitter.com/oauth/request_token';
	}

	/**
	 * Authorize URL
	 *
	 */
	function authorize_url()
	{
		return 'https://api.twitter.com/oauth/authorize';
	}

	/**
	 * Authenticate URL
	 *
	 */
	function authenticate_url()
	{
		return 'https://api.twitter.com/oauth/authenticate';
	}

	/**
	 * Access token URL
	 *
	 */
	function access_token_url()
	{
		return 'https://api.twitter.com/oauth/access_token';
	}


}
