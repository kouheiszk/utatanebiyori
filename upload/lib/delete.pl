sub delete{
  my $mode = $_[0];
  my @delno = split(/,/,$_[1]);
  my $delno; my $flag = 0; my $tmpaddr;
  my $delnote;

  if($in{'delno'} =~ /(\d+)/){ $delno = $1; }
  if($mode ne 'admin' && !$in{'delno'}){ return; }
  elsif($mode ne 'admin' && !$delno){ &error(401,$in{'delno'}); }

  open(IN,$set{'log_file'})|| &error(303);
  my @log = <IN>;
  close(IN);

  if($in{'addr'} =~ /(\d+).(\d+).(\d+).(\d+)/){ $tmpaddr = "$1.$2.$3."; }
  my $findflag = 0;
  foreach my $value (@log){
    my ($no,$ext,$date,$comment,$mime,$orgname,$addr,$host,$pass,$filepre,$note,$dummy) = split(/<>/,$value);
    $delnote = $note;
    my $delflag = 0;
    if(!$addr){ next; }
    if($mode eq 'admin'){
      foreach my $delno (@delno){ if($no == $delno){ $delflag = 1; last; } }
    }elsif($no == $delno){
      $findflag = 1;
      unless ($addr =~ /^$tmpaddr/){
        my ($pass,$id) = split(/,/,$pass);
        my $delpass = $in{'delpass'} || $in{'addr'}.time();
        my $salt = substr($pass, 0, 2); $delpass = crypt($delpass,$salt);
        my $usersalt = substr($in{'user'},0,2); my $userid = crypt($in{'user'},$usersalt);
        if ($in{'delpass'} ne $set{'admin_pass'} && $delpass ne $pass && $userid ne $id){
          if($mode ne 'admin'){ if(!$dummy){ $filepre = $set{'file_pre'};} $no = sprintf("%04d",$no); &error(404,"$filepre$no.$ext");}
        }
      }
      $delflag = 1;
    }
    if($delflag){
#     open(OUT,">>./del.cgi"); print OUT $value; close(OUT);
      $flag = 1;
      if(!$dummy){ $filepre = $set{'file_pre'};}
      $no = sprintf("%04d",$no);
      my $filename;
      my ($dlpath,$filedir);
      if($delnote =~ /DLpath:(.+)\s/){
        $dlpath = $1;
        $filename = "$set{'src_dir'}$filepre$no.${ext}_$dlpath/$filepre$no.$ext";
        $filedir = "$set{'src_dir'}$filepre$no.${ext}_$dlpath/";
      }else{
        $filename = "$set{'src_dir'}$filepre$no.$ext";
      }

      if(unlink($filename)){
        unlink("$set{'src_dir'}$filepre$no.$ext.html"); if($filedir){ foreach(globfile($filedir,".*")){ unlink; } rmdir($filedir);} undef $value;
      }elsif(unlink($filename)){
        unlink("$set{'src_dir'}$filepre$no.$ext.html"); if($filedir){ foreach(globfile($filedir,".*")){ unlink; } rmdir($filedir);} undef $value;
      }elsif(!(-e $filename)){
        unlink("$set{'src_dir'}$filepre$no.$ext.html"); if($filedir){ foreach(globfile($filedir,".*")){ unlink; } rmdir($filedir);} undef $value;
      }else{
        if($mode ne 'admin'){ &error(403,"$filepre$no.$ext");}
      }
    }
  }
  if($mode ne 'admin' && !$findflag){ &error(402,$delno); }
  if($flag){
    logwrite(@log);
    &makehtml();
  }
}

1;