<?php

$user_pass = "test";// パスワード

$tourl = $_GET["u"];

if ($tourl == "sys") {
	$tourl = "./sys/";// 認証クリア後に飛ばす相対パス。
}

$error = "./index.php";// 認証ミス後に飛ばす相対パス。
$script = "./login.php";// このファイル名

/*-----------------------------------------------------------*/
/* ログイン処理
/*-----------------------------------------------------------*/
if( isset($_POST['passwd']) ) {
	$passwd = $_POST['passwd'];
	$tourl = $_POST['tourl'];

	if( isset($tourl) ) {
		$pass = $user_pass; // パスを指定
		if($passwd == $pass) {

			$flag = false;
			$ip = $_SERVER["REMOTE_ADDR"];

			$f_array = @file("sys/.htaccess");
			$fp = @fopen("sys/.htaccess","w+");
			@flock($fp,LOCK_EX);

			foreach($f_array as $key => $value){
				if(strpos($value, $ip) !== false) $flag = true;//IPアドレスが同じだったら
			}

			foreach($f_array as $key => $value){
				if (strpos($value, "#") !== false) {//#があれば
					$t_last = substr($value, 1);
					$t_now = date("YmdHis");
					if ( $flag ) {//IPアドレスがあったなら
						$f_array[$key] = "#" . date("YmdHis");
					} elseif (($t_now - $t_last) > 120000) {//IPがなくて、時間が12時間経過してたら
						unset($f_array[$key]);
						unset($f_array[$key - 1]);
					}
				}
			}

			if (!$flag) {//IPがなかったら追加
				$key = count($f_array);
				$f_array[$key] = "\nallow from " . $ip . "\n";
				$f_array[$key + 1] = "#" . date("YmdHis");
			}

			foreach($f_array as $key => $value){
				$value = preg_replace("/^(\s)*(\r|\n|\r\n)/m", "", $value);
				if( !$value ) unset($f_array[$key]);
			}

			fwrite($fp, implode('', $f_array));

			flock($fp,LOCK_UN);
			fclose($fp);

			header("Location: $tourl"); // OKなら
		} else {
			header("Location: $error"); // NGなら
		}
	}
}
header('Content-type:text/html; charset=UTF-8');
?>
<html>
<head>
<META http-equiv="Content-Type" content="text/html; charset=UTF-8">
<META http-equiv="Content-Style-Type" content="text/css">
<link rel="stylesheet" href="stylesheet.css" type="text/css">
<title>methane - 認証画面</title>
</script>
</head>
<body>
<h2><!--パスワード入力欄-->パスワード入力欄</h2>
<form action="login.php" method="post" name="login">
<input type="password" name="passwd" size="15">
<input type="hidden" name="tourl" value="<?php echo $tourl; ?>">
<input type="submit" value="Login">
</form>
</body>
</html>
