<?php
if($_GET["module"] == 'delete'){
	if($_GET["filename"] != ""){
		if(!unlink("./file/".$_GET["filename"])){
			$info = "ふぁいるのさくじょにしっぱいしました。";
		}
	}
	header("Location: http://utatanebiyori.uzusionet.com/risa/");
}
	
if($_REQUEST["up"] != ""){
	$file_name    = $_FILES["file_path"]["name"];
	$file_size    = $_FILES["file_path"]["size"];
	$file_tmp     = $_FILES["file_path"]["tmp_name"];
	
	if($file_tmp != ""){
		if($file_size <= (1024*1024*5)){
			//保存ファイルパスの決定
			$file_name = mb_convert_encoding($file_name, "UTF-8", "AUTO");
			//保存パスにファイルを移動
			move_uploaded_file($file_tmp,"./file/".$file_name);
			$info = "アップロード完了しました。";
			header("Location: http://utatanebiyori.uzusionet.com/risa/");
		}else{
			$error = "サイズが大きすぎます。ファイルサイズは5MByte以下です。";
		}
	}else{
		$error = "ちょ。";
	}
} 

function get_fileList($trget_dir){
  $a = array();
  if ($dir = opendir($trget_dir)) {
    while (($file = readdir($dir)) !== false) {
      if ($file != "." && $file != ".." && $file != "index.php" && $file != ".htaccess" && $file != ".htpasswd") {
        if(is_file($trget_dir.$file)){
          array_push($a, $file);
        }
      }
    }
  closedir($dir);
  return $a;
  }
}
header('Content-type:text/html; charset=UTF-8');
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>りさにあげるもの置き場</title>
<style type="text/css">
table {
  border-collapse:collapse;
  border-spacing:0;
  border-collapse: collapse;
  border: solid 1px #ccc;
  margin: 0 0 20px;
  width:500px;
}

td,th{
  border-collapse: collapse;
  border: solid 1px #ccc;
  padding: 5px;
}
th {
  background: #f0f0f0;
  text-align: center;
  font-weight: bold;
}
form{
	margin:0;
	padding:0;
}
.warning {
  padding: 10px;
  margin: 10px 0;
  border: solid 1px #ccccff;
  background: #ffa500;
}
</style>
<script type="text/javascript">
	function delete_file(filename){
		if(confirm("削除しますか?") == true ) location.href='./?module=delete&filename='+filename;
	}
</script>
</head>
<body>
<h1>for りさ</h1>
	
<?php if(isset($info)){ ?><div class="warning"><?php echo $info; ?></div><?php } ?>
	
<table>
<tr><th>ふぁいるいちらん</th><th style="width:50px;">さくじょー</th></tr>
<?php
// ディレクトリの一覧を取得
$file_list = get_fileList("./file/");
foreach( $file_list as $file ){
?>
<tr><td><a href="./file/<?php echo $file; ?>"><?php echo $file; ?></td>
<td><input type="button" onclick="delete_file('<?php echo $file; ?>');" value="さくじょー"></td></tr>
<?php } ?>
</table>

<?php if(isset($error)){ ?><div class="warning"><?php echo $error; ?></div><?php } ?>

<form name="form" action="./" method="post" enctype="multipart/form-data">
	<table>
		<tr>
			<th>あっぷろーど</th>
		</tr>
		<tr>
			<td>
				<input name="file_path" type="file" size="64" style="margin-bottom:2px;" />
				<input name="up" type="submit" value="あっぷろーど">
			</td>
		</tr>
	</table>
</form>
</body>
</html>