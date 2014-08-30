sub error_disp{
  my ($message,$mode) = @_;
  my $url;
  if($mode eq 'init')
  {
    $url = qq|<a href="$set{'base_cgi'}">[リロード]</a>|;
  }
  else
  {
    $url = qq|<a href="$set{'http_html_path'}$set{'base_html'}">[戻る]</a>|;
  }
  my $buff =<<"EOM";
$set{'html_head'}$set{'html_css'}</HEAD>
<body bgcolor="#ffffff" text="#000000" LINK="#6060FF" VLINK="#6060FF" ALINK="#6060FF">
<div align="center">
<table summary="error">
$message
<tr><td></td></tr>
<tr><td><div align="center">$url</div></td></tr>
</table>
<br><br>
<table summary="info">
<tr>
<td>DATE</td><td>$in{'date'}</td></tr>
<tr><td>ADDR</td><td>$in{'addr'}</td></tr>
<tr><td>HOST</td><td>$in{'host'}</td></tr>
</table>
</div>
</body></html>
EOM
  print "Content-type: text/html\n\n";
  print $buff;
  exit;
}

sub error{
  my ($no,$note) = @_;
  if (length($note) > 64) { $note = substr($note,0,64).'...'; }
  $note =~ s/&/&amp;/g; $note =~ s/\"/&quot;/g; $note =~ s/</&lt;/g; $note =~ s/>/&gt;/g; $note =~ s/\r//g; $note =~ s/\n//g; $note =~ s/\t//g; $note =~ s/\0//g;
  my ($message,$dispmsg,$flag);

  if($no == 98){ $message = ""; }
  elsif($no == 99){ $message = "UpFileなし"; }
  elsif($no == 101){ $message = "投稿禁止HOST"; }
  elsif($no == 106){ $flag = 1; $message = "POSTサイズ超過"; $note = dispsize($note); $dispmsg= '<tr><td>ファイルをアップロードできませんでした</td></tr><tr><td>アップロードファイル('.$note.')は 最大容量設定('.dispsize($set{'max_size'}*1024).')を越えています</td></tr>';}
  elsif($no == 107){ $flag = 1; $message = "POSTサイズ過小"; $note = dispsize($note); $dispmsg= '<tr><td>ファイルをアップロードできませんでした</td></tr><tr><td>アップロードファイル('.$note.')は 最小容量設定('.dispsize($set{'min_size'}*1024).')未満です</td></tr>';}
  elsif($no == 108){ $flag = 1; $message = "POSTデータ不完全"; $dispmsg = '<tr><td>ファイルをアップロードできませんでした</td></tr><tr><td>POSTデータが不完全です</td></tr>';}
  elsif($no == 109){ $flag = 1; $message = "POSTKey不一致"; $dispmsg = '<tr><td>ファイルをアップロードできませんでした</td></tr><tr><td>POSTKeyが一致しません</td></tr>';}
  elsif($no == 202){ $flag = 1; $message = "拡張子合わず"; $dispmsg = '<tr><td>ファイルをアップロードできませんでした</td></tr><tr><td>投稿できる拡張子は'.$set{'up_ext'}.'です</td></tr>';}
  elsif($no == 203){ $flag = 1; $message = "投稿早すぎ"; $dispmsg = '<tr><td>ファイルをアップロードできませんでした</td></tr><tr><td>同一IPアドレスから'.$set{'interval'}.'秒以内に再投稿できません</td></tr>';}
  elsif($no == 204){ $flag = 1; $message = "一時ファイル書き込めず"; $dispmsg = '<tr><td>ファイルをアップロードできませんでした</td></tr><tr><td>一時ファイルの作成に失敗しました</td></tr>';}
  elsif($no == 205){ $flag = 1; $message = "同一ファイル存在"; $note =~ /([^\/]+)$/; my $filename = $1; $dispmsg = '<tr><td>ファイルをアップロードできませんでした</td></tr><tr><td>同一ファイルが '.$filename.' に存在します</td></tr>';}
  elsif($no == 206){ $flag = 1; $message = "禁止拡張子"; $dispmsg = '<tr><td>ファイルをアップロードできませんでした</td></tr><tr><td>拡張子 '.$note.' はアップロードできません</td></tr>';}
  elsif($no == 303){ $flag = 1; $message = "ログファイルに読み込めず"; $dispmsg = '<tr><td>メインログの読み込みに失敗しました</td></tr>';}
  elsif($no == 304){ $flag = 1; $message = "ログファイルに書き込めず"; $dispmsg = '<tr><td>メインログの書き込みに失敗しました</td></tr>';}
  elsif($no == 306){ $message = "ファイルリストHTML書き込めず";}
  elsif($no == 307){ $message = "ファイルHTMLファイル書き込めず";}
  elsif($no == 401){ $flag = 1; $message = "削除No.検出できず"; $dispmsg = '<tr><td>ファイルを削除できませんでした</td></tr><tr><td>'.$note.' から削除No.を検出できませんでした</td></tr><tr><td>'.$set{'file_pre'}.'0774.zipの場合 No.には 774 を入力します</td></tr>';}
  elsif($no == 402){ $flag = 1; $note = sprintf("%04d",int($note)); $message = "削除No.存在せず"; $dispmsg = '<tr><td>ファイルを削除できませんでした</td></tr><tr><td>'.$set{'file_pre'}.$note.'.*** はメインログに存在しません</td></tr>';}
  elsif($no == 403){ $flag = 1; $message = "削除アクセス拒否"; $dispmsg = '<tr><td>ファイルを削除できませんでした</td></tr><tr><td>ファイル削除条件は満たしていますが '.$note.' のファイルの削除が拒否されました</td></tr><tr><td>アクセスが過剰な場合等は時間を置いて再操作すると削除できることがあります</td></tr>';}
  elsif($no == 404){ $flag = 1; $message = "削除Key不一致"; $dispmsg = '<tr><td>ファイルを削除できませんでした</td></tr><tr><td>'.$note.' 削除Keyが一致しませんでした</td></tr>';}

  elsif($no == 51){ $flag = 1; $message = "[DLMode] No.見つからず";  $dispmsg = '<tr><td>[DLMode] ファイルが見つかりませんでした</td></tr><tr><td>'.$note.' からファイルNo.を検出できませんでした</td></tr>'; }
  elsif($no == 52){ $flag = 1; $message = "[DLMode] File見つからず";  $dispmsg = '<tr><td>[DLMode] ファイルが見つかりませんでした</td></tr><tr><td>'.$set{'file_pre'}.$note.'.*** はメインログに存在しません</td></tr>'; }
  elsif($no == 53){ $flag = 1; $message = "[DLMode] DLkey未設定";  $dispmsg = '<tr><td>[DLMode] orgDLkeyError</td></tr><tr><td>'.$note.' DLKeyが未設定です</td></tr>'; }
  elsif($no == 54){ $flag = 1; $message = "[DLMode] DLkey不一致";  $dispmsg = '<tr><td>[DLMode] orgDLkeyError</td></tr><tr><td>'.$note.' DLKeyが一致しませんでした</td></tr>'; }
  elsif($no == 55){ $flag = 1; $message = "[DLMode] File Oepn Error";  $dispmsg = '<tr><td>[DLMode] Open Error</td></tr><tr><td>'.$note.' ファイルの読み込みに失敗しました</td></tr>'; }
  elsif($no == 56){ $flag = 1; $message = "[DLMode] File Not Found";  $dispmsg = '<tr><td>[DLMode] Not Found</td></tr><tr><td>'.$note.' ファイルが存在しません</td></tr>'; }

  elsif($no == 61){ $flag = 1; $message = "DLkey未設定";  $dispmsg = '<tr><td>DLKeyが未設定です</td></tr>'; }

  unlink($in{'tmpfile'});
  if($note){$message .= ' ';}
  if($set{'error_level'} && $no > 100){
    unless(-e $set{'error_log'}){
      open(OUT,">$set{'error_log'}");
      close(OUT);
      chmod($set{'per_logfile'},$set{'error_log'});
    }
    if($set{'error_size'} && ((-s $set{'error_log'}) > $set{'error_size'} * 1024)){
      my $err_bkup = "$set{'error_log'}.bak.cgi";
      unlink($err_bkup);
      rename($set{'error_log'},$err_bkup);
      open(OUT,">$set{'error_log'}");
      close(OUT);
      chmod($set{'per_logfile'},$set{'error_log'});
    }
    open(OUT,">>$set{'error_log'}");
    print OUT "$in{'date'}<>$no<>$message$note<>$in{'addr'}<>$in{'host'}<>1\n";
    close(OUT);
  }
  &error_disp($dispmsg) if($flag && $set{'disp_error'});
  &quit($set{'message_upload'});
}

1;