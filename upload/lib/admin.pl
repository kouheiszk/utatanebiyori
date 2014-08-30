sub admin_mode{
  &errorclear() if($in{'mode'} eq 'errorclear');
  &delete('admin',$in{'admin_delno'}) if($in{'mode'} eq 'delete');

  open(IN,$set{'log_file'})||error(303);
  my @log = <IN>;
  close(IN);

  my ($header,$buff,$footer,$value);
  $buff =<<"EOM";
$set{'html_head'}$set{'html_css'}</HEAD>
<body bgcolor="#ffffff" text="#000000" LINK="#6060FF" VLINK="#6060FF" ALINK="#6060FF">
EOM

  $buff .= leaddisp(0,1,1).'<a name="up"></a><table summary="title" width="100%"><tr><td bgcolor="#caccff"><strong><font size="4" color="#3366cc">Upload Info</font></strong></td></tr></table>';
  $buff .= qq|<table summary="check"><tr>
  <td><form action="$set{'base_cgi'}" method="POST"><input type=hidden name="checkmode" value="allcheck"><input type=hidden name=delno value="$in{'delno'}"><input type=hidden name=delpass value="$in{'delpass'}"><input type=submit value="すべてチェック"></form></td>
  <td><form action="$set{'base_cgi'}" method="POST"><input type=hidden name="checkmode" value="nocheck"><input type=hidden name=delno value="$in{'delno'}"><input type=hidden name=delpass value="$in{'delpass'}"><input type=submit value="すべて外す"></form></td>
  <td><form action="$set{'base_cgi'}" method="POST"><input type=hidden name=delpass value="$set{'admin_pass'}"><input type=submit value="HTMLを更新する/ログアウト"></form></td>
  </tr></table>\n
  <form action="$set{'base_cgi'}" method="POST"><input type=hidden name="mode" value="delete"><input type=hidden name=delno value="$in{'delno'}"><input type=hidden name=delpass value="$in{'delpass'}"><input type=submit value="チェックしたものを削除"><br>\n|;
  $buff .= "<table summary=\"upinfo\" width=\"100%\">\n<tr><td>DEL</td><td>NAME</td><td>COMMENT</td><td>SIZE</td><td>ADDR</td><td>HOST</td><td>DATE</td><td>NOTE</td><td>MIME</td><td>ORIG</td></tr>\n";
  shift(@log);
  foreach (@log){  $buff .= makeitem($_,'admin'); }
  $buff .= '</table></form><br><br>';

  if($set{'error_level'}){
    $buff .= leaddisp(-1,0,1).'<a name="error"></a><table summary="errortitle" width="100%"><tr><td bgcolor="#caccff"><strong><font size="4" color="#3366cc">Error Info</font></strong></td></tr></table>';
    $buff .= qq|<form action="$set{'base_cgi'}" method="POST"><input type=hidden name=mode value="errorclear"><input type=hidden name=delno value="$in{'delno'}"><input type=hidden name=delpass value="$in{'delpass'}"><input type=submit value="エラーログクリア"></form>|;
    $buff .= "<table summary=\"errorinfo\" width=\"100%\">\n<tr><td>DATE</td><td>ADDR</td><td>HOST</td><td>NOTE</td></tr>\n";
    if(open(IN,$set{'error_log'})){  @log = reverse(<IN>); close(IN); foreach (@log){ my ($date,$no,$note,$addr,$host) = split(/<>/); $buff .= "<tr><td>$date</td><td>$addr</td><td>$host</td><td>$note</td></tr>\n"; }}
    $buff .= "</table><br><br>\n";
  }

  $buff .= leaddisp(-1,-1,0);
  $buff .= '<a name="set"></a><table summary="settitle" width="100%"><tr><td bgcolor="#caccff"><strong><font size="4" color="#3366cc">Setting Info</font></strong></td></tr></table>'."\n<table summary=\"setting\">\n";
  $buff .= tablestr('スクリプトVer',$set{'ver'});
  $buff .= tablestr('メインログファイル',$set{'log_file'});
  if($set{'error_level'}){
    $buff .= tablestr('エラーログファイル',$set{'error_log'});
    if($set{'error_size'}){ $buff .= tablestr('エラーログ最大容量',dispsize($set{'error_size'}*1024).' '.($set{'error_size'}*1024).'Bytes'); }
    else{ $buff .= tablestr('エラーログ最大容量制限','無'); }
  }else{ $buff .= tablestr('エラーログ記録','無'); }
  $buff .= tablestr('保持件数',$set{'max_log'});
  $buff .= tablestr('最大投稿容量',dispsize($set{'max_size'}*1024).' '.($set{'max_size'}*1024).'Bytes');

  if($set{'min_flag'}){ $buff .= tablestr('最小制限容量',dispsize($set{'min_size'}*1024).' '.($set{'min_size'}*1024).'Bytes'); }
  else{ $buff .= tablestr('最小制限容量',"無"); }
  if($set{'max_all_flag'}){ $buff .= tablestr('総容量制限',dispsize($set{'max_all_size'}*1024).' '.($set{'max_all_size'}*1024).'Bytes'); }
  else{ $buff .= tablestr('総容量制限',"無"); }

  $buff .= tablestr("ファイル接頭辞",$set{'file_pre'});
  $buff .= tablestr("HTML保存ディレクトリ",$set{'html_dir'});
  $buff .= tablestr("ファイル保存ディレクトリ",$set{'src_dir'});
  if($set{'http_html_path'} && $set{'html_dir'} ne $set{'http_html_path'}){ $buff .= "<tr><td>HTTP_HTML_PATH</td><td>$set{'http_html_path'}</td></tr>\n";}
  if($set{'http_src_path'} && $set{'src_dir'} ne $set{'http_src_path'}){ $buff .= "<tr><td>HTTP_SRC_PATH</td><td>$set{'http_src_path'}</td></tr>\n";}
  $buff .= tablestr('1ページに表示するファイル数',$set{'pagelog'});
  if($set{'interval'} > 0){ $value = $set{'interval'}.'秒'; }else{ $value = '無'; }
  $buff .= tablestr('同一IP投稿間隔秒数制限',$value);
  if($set{'up_ext'}){  $set{'up_ext'} =~ s/,/ /g; $buff .= tablestr('投稿可能基本拡張子',$set{'up_ext'}); }
  if($set{'deny_ext'}){ $set{'deny_ext'} =~ s/,/ /g; $buff .= tablestr('投稿禁止拡張子',$set{'deny_ext'}); }
  if($set{'change_ext'}){  $set{'change_ext'} =~ s/,/ /g; $set{'change_ext'} =~ s/>/&gt;/g; $buff .= tablestr('拡張子変換',$set{'change_ext'});  }

  if($set{'up_all'}){  $buff .= tablestr('指定外拡張子アップロード許可','有'); if($set{'ext_org'}){ $buff .= tablestr('指定外ファイル拡張子','オリジナル'); }else{ $buff .= tablestr('指定外ファイル拡張子','bin'); }}
  else{$buff .= tablestr('指定外拡張子アップロード許可','無');}

  if($set{'find_crypt'}){ $value = '有'; }else{ $value = '無';}
  $buff .= tablestr('暗号化アーカイブ検出(ZIP)',$value);
  if($set{'binary_compare'}){ $value = '有'; }else{ $value = '無';}
  $buff .= tablestr('バイナリ比較',$value);
  if($set{'post_flag'}){ $value = '有'; }else{ $value = '無';}
  $buff .= tablestr('PostKey投稿制限',$value);
  if($set{'dlkey'}){ if($set{'dlkey'} == 2){$value = '必須'}else{$value = '任意';}}else{ $value = '無';}
  $buff .= tablestr('DLkey',$value);
  if($set{'dummy_html'}){ if($set{'dummy_html'} == 3){$value = 'ALL'}elsif($set{'dummy_html'} == 2){$value = 'DLKeyのみ';}else{$value = '通常ファイルのみ';}}else{ $value = '無';}
  $buff .= tablestr('個別HTMLキャッシュ',$value);
  if($set{'disp_error'}){ $value = '有'; }else{ $value = '無';}
  $buff .= tablestr('ユーザエラー表示',$value);
  if($set{'zero_clear'}){ $value = '有'; }else{ $value = '無';}
  $buff .= tablestr('削除済ファイルリスト自動消去',$value);
  if($set{'home_url'}){ $buff .= "<tr><td>HOMEURL</td><td>$set{'home_url'}</td></tr>\n";}

  $buff .= '</table></body></html>';

  print "Content-type: text/html\n\n";
  print $buff;
  exit;
}

1;