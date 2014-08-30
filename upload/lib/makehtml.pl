sub makehtml{

  my ($buff,$init,$postval,$dlkey);
  my $page = 0; my $i = 1;

  open(IN,$set{'log_file'})||&error(303);
  my $log = my @log = <IN>;
  close(IN);

  if($log == 1){ $log++; $init++;}
  my $lastpage = int(($log - 2)/$set{'pagelog'}) + 1;
  $postval = ' obj.postkey.value =  unescape(p[1]);' if($set{'post_flag'});
  my $header =<<"EOM";
$set{'html_head'}<META http-equiv="Content-Script-Type" content="text/javascript">
<script type="text/javascript">
<!--
function getCookie(obj,cookiename){
  var i,str; c = new Array(); p = new Array("",""); str = document.cookie;c = str.split(";");
  for (i = 0; i < c.length; i++) { if (c[i].indexOf(cookiename+"=") >= 0) { p = (c[i].substr(c[i].indexOf("=")+1)).split("<>"); break; }}
  if(cookiename == "SN_UPLOAD"){ obj.pass.value =  unescape(p[0]);$postval }
  else if(cookiename == "SN_DEL"){ obj.delpass.value =  unescape(p[0]);}
  return true;
}
function delnoin(no){
  document.Del.delno.value = no;
  document.Del.del.focus();
}
//-->
</script>
$set{'html_css'}</HEAD>
<body onload="getCookie(document.Form,'SN_UPLOAD');getCookie(document.Del,'SN_DEL');">
<div id="header" width="100%">
<!--夜C専用うｐろだ。用法用量を守って、正しくお使いください。-->
</div>
EOM
  my $maxsize = 'Max '.dispsize($set{'max_size'}*1024);
  my ($minsize,$total);
  if($set{'min_flag'}){ $minsize = 'Min '.dispsize($set{'min_size'}*1024).' - '; }
  if($set{'max_all_flag'}){ $total .= ' Total '.dispsize($set{'max_all_size'}*1024);}
  $header .= qq|
<table width="95%">
<FORM METHOD="POST" ENCTYPE="multipart/form-data" ACTION="$set{'base_cgi'}" name="Form">
<tr>
<td>FILE $minsize$maxsize (*$set{'max_log'}Files$total)</td>
</tr>|;
  $header .='<tr><td>FILE: <INPUT TYPE=file  SIZE="40" NAME="upfile">';
  $header .= 'DLKey: <INPUT TYPE=password SIZE="10" NAME="dlkey" maxlength="8">' if($set{'dlkey'});
  $header .= 'DELKey: <INPUT TYPE=password SIZE="10" NAME="pass" maxlength="8"></td></tr><tr><td>COMMENT: <INPUT TYPE=text SIZE="45" NAME="comment"><INPUT TYPE=hidden NAME="jcode" VALUE="漢字"> <INPUT TYPE=submit VALUE="Upload"><INPUT TYPE=reset VALUE="Cancel"></td></tr>';
  if($set{'post_flag'}){ $header .= 'PostKey<br>\n<INPUT TYPE=password SIZE="10" NAME="postkey" maxlength="10">'; }
  $header .= '</FORM></table>';

  my $allsize = 0;
  my @files = globfile("$set{'src_dir'}",".*");
  my @dir = globdir("$set{'src_dir'}",".*");
  foreach my $dir (@dir){ push(@files,globfile($dir."/",".*")); }
  foreach my $value (@files){ $allsize += (-s "$value"); }

  $allsize = dispsize($allsize);

  my $footer = "</table>\n<hr size=1>\n<div id=\"del\">Used ${allsize}<br>\n";
  if($set{'up_all'} && !$set{'ext_org'}){ $footer .= "<!--".$set{'up_ext'}.' +'."-->"; }
  elsif(!$set{'up_all'}){ $footer .= "<!--".$set{'up_ext'}."-->"; }
  $footer .= "<form method=post action=\"$set{'base_cgi'}\" name=\"Del\">\n";
  $footer .= "<input type=hidden name=mode value=delete>No.<input type=text size=8 name=delno> key<input type=password size=10 name=delpass> <input type=submit value=\"del\" name=del>\n";
  $footer .= "</form>\n";
  $footer .= "</div>\n";

  $footer .= "<!-- $set{'ver'}<a href=\"http://sugachan.dip.jp/download/\" target=\"_blank\"><small>Sn Uploader</small></a>--></div>\n";
  $footer .= "</body>\n</html>";

  my $info_title = "<table id=\"upinfo\" summary=\"upinfo\" width=\"100%\">\n<tr><td>　</td><td>NAME</td>";
  if($set{'disp_comment'}){
  $info_title .= "<td>COMMENT</td>";} if($set{'disp_size'}){
  $info_title .= "<td>SIZE</td>"; } if($set{'disp_date'}){
  $info_title .= "<td>DATE</td>"; }
  if($set{'disp_mime'}){
  $info_title .= "<td>MIME</td>"; } if($set{'disp_orgname'}){
  $info_title .= "<td>ORIG</td>"; }
  $info_title .= "</tr>\n";

  my $home_url_link;
  if($set{'home_url'}){ $home_url_link = qq|<a href="$set{'home_url'}">[HOME]</a> |;}
  if($set{'html_all'}){
    my $buff; my $no = 1; my $time = time; my $subheader;
    foreach my $value (@log){
      my ($no,$ext,$date,$comment,$mime,$orgname,$addr,$host,$pass,$dummy) = split(/<>/,$value);
      if(!$dummy){ next; }
      $buff .= makeitem($value);
    }
    $subheader .= "\n<div id=\"navigator\">[ALL] ";
    while($no <= $lastpage){
      if($no == $page) { $subheader .= "\[$no\] ";}
      else{ if($no == 1){ $subheader .= "<a href=\"$set{'http_html_path'}$set{'base_html'}?$time\">\[$no\]</a> "}
          else{$subheader .= "<a href=\"$set{'http_html_path'}$no.html?$time\">\[$no\]</a> ";}  }
      $no++;
    }
    $subheader .= "</div>";
    $subheader .= $info_title;
    open(OUT,">$set{'html_dir'}all.html")||&error(306,"$set{'html_dir'}all.html");
    print OUT $header."<hr size=1>".$home_url_link.$subheader."<hr size=1>".$buff.$footer;
    close(OUT);
    chmod($set{'per_upfile'},"$set{'html_dir'}all.html");
  }else{ unlink("$set{'html_dir'}all.html"); }

  while($log > $i){
    $buff .= makeitem($log[$i]) unless($init);
    if(($i % $set{'pagelog'}) == 0||$i == $log -1){
      $page++; my $subheader; my $no = 1; my $time = time;
      if($set{'html_all'}){ $subheader .= "\n<div id=\"navigator\"><a href=\"./all.html?$time\">[ALL]</a> "; }
      while($no <= $lastpage){
        if($no == $page) { $subheader .= "\[$no\] ";}
        else{ if($no == 1){ $subheader .= "<a href=\"$set{'http_html_path'}$set{'base_html'}?$time\">\[$no\]</a> "}
            else{$subheader .= "<a href=\"$set{'http_html_path'}$no.html?$time\">\[$no\]</a> ";}
        }
        $no++;
      }
      $subheader .= "</div>";
      $subheader .= $info_title;
      my $loghtml;
      if($page == 1){ $loghtml = "$set{'html_dir'}$set{'base_html'}"; }
      else{ $loghtml = "$set{'html_dir'}$page.html"; }

      open(OUT,">$loghtml") || &error(306,"$loghtml");
      print OUT $header."<hr size=1>".$home_url_link.$subheader."<hr size=1>".$buff.$footer;
      close(OUT);
      chmod($set{'per_upfile'},$loghtml);
      undef $buff;
    }
    $i++;
  }

  while($page < 1000){
    $page ++;
    if(-e "$set{'html_dir'}$page.html"){ unlink("$set{'html_dir'}$page.html"); }else{ last; }
  }
}

sub makeitem{
  my ($src,$mode) = @_; my ($buff,$check,$target);
  my ($no,$ext,$date,$comment,$mime,$orgname,$addr,$host,$pass,$filepre,$note,$dummy) = split(/<>/,$src);
  if(!$dummy){ $filepre = $set{'file_pre'}; }
  my $orgno = $no;
  $no = sprintf("%04d",$no);
  my $size = 0;
  my $dlpath = 0;

  if($note =~ /DLpath:(.+)\s/){
    $dlpath = $1;
    $size = dispsize(-s "$set{'src_dir'}$filepre$no.${ext}_$dlpath/$filepre$no.$ext");
  }else{
    $size = dispsize(-s "$set{'src_dir'}$filepre$no.$ext");
  }

  my $path = $set{'http_src_path'} || $set{'src_dir'};
  if($set{'link_target'}){ $target = qq| target="$set{'link_target'}"|; }
  if($mode eq 'admin'){
    if($dlpath){ $path .= "$filepre$no.${ext}_$dlpath/"; }
    if($addr eq $host){ undef $host; }
    if($in{'checkmode'} eq 'allcheck'){$check = ' checked';}
    $buff = "<tr> <td><INPUT TYPE=checkbox NAME=\"admin_delno\" VALUE=\"$no\"$check></td>\n <td><a href=\"$path$filepre$no.$ext\"$target>$filepre$no.$ext</a></td>\n <td>$comment</td>\n <td>$size</td>\n <td>$addr</td>\n <td>$host</td>\n <td>$date</td>\n <td>$note</td>\n <td>$mime</td>\n <td>$orgname</td>\n</tr>\n";
  }else{
    my($d_com,$d_date,$d_size,$d_mime,$d_org);
    if($set{'disp_comment'}){ $d_com = "<td>$comment</td>\n"; } if($set{'disp_size'}){ $d_size = "<td>$size</td>\n"; } if($set{'disp_date'}){ $d_date= "<td>$date</td>\n"; }
    if($set{'disp_mime'}){ $d_mime = "<td>$mime</td>\n"; } if($set{'disp_orgname'}){ $d_org = "<td>$orgname</td>\n"; }
    if(-e "$set{'src_dir'}$filepre$no.$ext.html"){$buff = "
    <tr>\n<td><SCRIPT type=\"text/javascript\" Language=\"JavaScript\"><!--\ndocument.write(\"<a href=\\\"javascript:delnoin($orgno)\\\">$set{'char_delname'}<\\/a>\");\n// --></SCRIPT></td>\n<td><a href=\"$path$filepre$no.$ext.html\"$target>$filepre$no.$ext</a></td>$d_com$d_size$d_date$d_mime$d_org</tr>\n";}
    elsif($dlpath){$buff = "<tr>\n<td><SCRIPT type=\"text/javascript\" Language=\"JavaScript\"><!--\ndocument.write(\"<a href=\\\"javascript:delnoin($orgno)\\\">$set{'char_delname'}<\\/a>\");\n// --></SCRIPT></td>\n<td><a href=\"$set{'base_cgi'}?mode=dl&file=$orgno\">$filepre$no.$ext</a></td>$d_com$d_size$d_date$d_mime$d_org</tr>\n";}
    else{ $buff = "<tr>\n<td><SCRIPT type=\"text/javascript\" Language=\"JavaScript\"><!--\ndocument.write(\"<a href=\\\"javascript:delnoin($orgno)\\\">$set{'char_delname'}<\\/a>\");\n// --></SCRIPT></td>\n<td><a href=\"$path$filepre$no.$ext\"$target>$filepre$no.$ext</a></td>\n$d_com$d_size$d_date$d_mime$d_org</tr>\n";}
  }
  return $buff;
}

sub makedummyhtml{
  my ($filename,$com,$file,$orgdlpath,$date,$mime,$orgname,$no) = @_;
  my $buff;

  if(!$no){
    $buff = "<html><head><title>$filename</title></head><body>";
    $buff .= qq|Download <a href="./$filename">$filename</a>|;
    $buff .= '</body></html>';
  }else{
    $buff = cryptfiledl($com,$file,$orgdlpath,$date,$mime,$orgname,$no);
  }

  open(OUT,">$set{'src_dir'}$filename.html")||&error(307,"$set{'src_dir'}$filename.html");
  print OUT $buff;
  close(OUT);
  chmod($set{'per_upfile'},"$set{'src_dir'}$filename.html");
  return 1;
}

1;