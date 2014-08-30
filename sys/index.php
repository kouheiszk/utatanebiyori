<html>
<head>
<title>管理者メニュー</title>
</head>
<body>
<?php echo ($ip = getenv("REMOTE_ADDR")); ?><br />
<a href="../index.php">うたたね日和</a><br />
<a href="../blog/">うたたね日記</a><br />
<a href="../photo/">うたたね写真館</a><br />
<a href="./access/acc.cgi">アクセス解析</a><br />
<a href="./phpmyadmin/">phpMyAdmin</a><br />
</body>
</html>