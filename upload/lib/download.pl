sub dlfile{
  my $msg;
  my ($orgdlkey,$orgdlpath);
  my ($dlext,$dlfilepre);
  my ($dl_date,$dl_comment,$dl_size,$dl_mime,,$dl_orgname);
  my $dlno = 0;
  my $findflag;

  open(IN,$set{'log_file'})||&error(303);
  my @log = <IN>;
  close(IN);
  shift(@log);

  if($in{'file'} =~ /(\d+)/){ $dlno = $1; }
  if($dlno == 0) { &error(51,$in{'file'}); }

  foreach my $value (@log){
    my ($no,$ext,$date,$comment,$mime,$orgname,$addr,$host,$pass,$filepre,$note,$dummy) = split(/<>/,$value);
      my @note = split(/,/,$note);
      if(int($dlno) == $no){
        $dl_comment = $comment;
        $dl_mime = $mime;
        $dl_date = $date;
        $dl_orgname = $orgname;
        $dlext = $ext;
        $dlfilepre = $filepre;
        foreach my $tmpnote (@note){
          if($tmpnote =~ /\!--\sDLKey:(.+)\s--.*\!--\sDLpath:(.+)\s--/){
            $orgdlkey = $1;
            $orgdlpath = $2;
            last;
          }
        }
        $findflag = 1;
        last;
      }
  }

  my $dlfile = $dlfilepre.sprintf("%04d",int($dlno)).'.'.$dlext;
  if(!(-e "$set{'src_dir'}${dlfile}_$orgdlpath/$dlfile")){ &error(56,"$dlfile----$set{'src_dir'}${dlfile}_$orgdlpath/$dlfile"); }

  if($in{'dlkey'}){
    my $dlsalt = substr($orgdlkey,0,2);
    my $dlkey = crypt($in{'dlkey'},$dlsalt);

    if($findflag == 0){ &error(52,$dlfile); }
    elsif(!$orgdlkey){ &error(53,$dlfile); }
    elsif($orgdlkey ne $dlkey && $set{'admin_pass'} ne $in{'dlkey'}){ &error(54,$dlfile); }
    #print "Location: $set{'http_src_path'}${dlfile}_$orgdlpath/$dlfile\n\n";
    my $buff =<<"EOM";
$set{'html_head'}$set{'html_css'}
<META HTTP-EQUIV="Refresh" CONTENT="1;URL=$set{'http_src_path'}${dlfile}_$orgdlpath/$dlfile">
</HEAD>
<body bgcolor="#ffffff" text="#000000" LINK="#6060FF" VLINK="#6060FF" ALINK="#6060FF">
<div align="center">
<br>
<table summary="dlfrom">
<tr><td>îÚÇŒÇ»Ç¢èÍçáÇÕ <a href="$set{'http_src_path'}${dlfile}_$orgdlpath/$dlfile">Ç±ÇøÇÁ</a> Ç©ÇÁ</td></tr>
</table>
</div>
</body></html>
EOM
    print "Content-type: text/html\n\n";
    print $buff;
  }else{
    my $buff = cryptfiledl($dl_comment,$dlfile,$orgdlpath,$dl_date,$dl_mime,$dl_orgname,$dlno);
    print "Content-type: text/html\n\n";
    print $buff;
  }
  exit;
}

sub cryptfiledl{
    my($com,$file,$orgdlpath,$date,$mime,$orgname,$no) = @_;
    my($d_com,$d_date,$d_size,$d_mime,$d_org);

    if($set{'disp_comment'}){ $d_com = "<tr><td>COMMENT</td><td>$com</td></td>"; } if($set{'disp_size'}){ $d_size = "<tr><td>SIZE</td><td>".dispsize(-s "$set{'src_dir'}${file}_$orgdlpath/$file")." (".(-s "$set{'src_dir'}${file}_$orgdlpath/$file")."bytes)"."</td></tr>"; } if($set{'disp_date'}){ $d_date= "<tr><td>DATE</td><td>$date</td></tr>"; }
    if($set{'disp_mime'}){ $d_mime = "<tr><td>ORGMIME</td><td>$mime</td></tr>"; } if($set{'disp_orgname'}){ $d_org = "<tr><td>ORGNAME</td><td>$orgname</td></tr>"; }

    my $buff =<<"EOM";
$set{'html_head'}$set{'html_css'}</HEAD>
<body bgcolor="#ffffff" text="#000000" LINK="#6060FF" VLINK="#6060FF" ALINK="#6060FF">
<div align="center">
<br>
$file Ç…ÇÕDLKeyÇ™ê›íËÇ≥ÇÍÇƒÇ¢Ç‹Ç∑
<table summary="dlform">
<tr><td></td></tr>
<FORM METHOD=POST ACTION="$set{'base_cgi'}" name="DL">
<tr><td>
<input type=hidden name=file value=$no>
<input type=hidden name=jcode value="äøéö">
<input type=hidden name=mode value=dl></td></tr>
$d_com$d_date$d_size$d_mime$d_org
<tr><td>DLKey:<input type=text size=8 name="dlkey"></td></tr>
<tr><td><input type=submit value="DownLoad"></td></tr>
</FORM>
</table>
</div>
</body></html>
EOM

  return $buff;
}

1;