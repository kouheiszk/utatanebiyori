#!/usr/bin/perl
use vars qw(%set %in);
use strict;
$set{'log_file'} = './log.cgi';    #ログファイル名
$set{'max_log'} = 100;    #保持件数
$set{'max_size'} = 20*1024;    #最大投稿容量(KB)
$set{'min_flag'} = 0;    #最小容量制限を使用する=1
$set{'min_size'} = 100;    #最小投稿容量(KB)
$set{'max_all_flag'} = 1;    #総容量制限を使用する=1
$set{'max_all_size'} = 500*1024;    #総制限容量(KB)
$set{'file_pre'} = 'up';    #ファイル接頭辞
$set{'pagelog'} = 10;    #1ページに表示するファイル数
$set{'base_html'} = 'index.html';    #1ページ目のファイル名
$set{'interval'} = 30;    #同一IP投稿間隔秒数
$set{'deny_host'} = '';    #投稿禁止IP/HOST ,で区切る ex.(bbtec.net,219.119.66,ac.jp)
$set{'admin_name'} = 'nagi';    #管理者ログインID
$set{'admin_pass'} = 'passwdupload';    #管理者パスワード

# 以下5項目を再設定する際にはPATH，ディレクトリは / で終わること
# $set{'html_dir'},$set{'base_cgi'}を ./ 以外に設定する場合,
# またはDLkeyを使用し なおかつHTMLキャッシュ($set{'dummy_html'} = 2 or 3)を使用する場合は
# $set{'base_cgi'} , $set{'http_html_path'} , $set{'http_src_path'} をフルパス(http://～～ or /～～)で記述する
$set{'html_dir'} = './';    # 内部HTML保存ディレクトリ
$set{'src_dir'} = '../data/upload/';    # 内部ファイル保存ディレクトリ
$set{'base_cgi'} = './index.cgi'; # このスクリプト名 http://～の指定可能
$set{'http_html_path'} = './';    # html参照 httpPATH http://～の指定可能
$set{'http_src_path'} = '../data/upload/';    # file参照 httpPATH http://～の指定可能

$set{'dlkey'} = 2;    # DLKeyを使用する=1,DLkey必須=2
$set{'up_ext'} = 'txt,lzh,zip,rar,gca,tar,gz,mpg,mp3,avi,swf,bmp,jpg,gif,png'; #アップロードできる基本拡張子 半角英数小文字 ,で区切る
$set{'up_all'} = 0;    #登録以外のものもUPさせられるようにする=1
$set{'ext_org'} = 1;  #$set{'up_all'}が1の時オリジナルの拡張子にする=1
$set{'deny_ext'} = 'php,php3,phtml,rb,sh,bat,dll';   #投稿禁止の拡張子 半角英数小文字 ,で区切る
$set{'change_ext'} = 'cgi->txt,pl->txt,log->txt,jpeg->jpg,mpeg->mpg';    #拡張子変換 前->後 半角英数小文字 ,で区切る

$set{'home_url'} = '';    #[HOME]のリンク先 相対パス又は http://から始まる絶対パス
$set{'html_all'} = 1;    #[ALL]を出す=1
$set{'dummy_html'} = 1;    #ファイル個別HTMLを作成する 通常ファイルのみ=1,DLKey設定ファイルのみ=2,すべて=3
$set{'find_crypt'} = 1;    #暗号化ZIPを検出する=1
$set{'binary_compare'} = 0;    #既存ファイルとバイナリ比較する=1
$set{'post_flag'} = 0;    #PostKeyを使用する=1
$set{'post_key'} = 'postkey';    #PostKey ,で区切ると複数指定 ex.(postkey1,postkey2)
$set{'disp_error'} = 1;    #ユーザーにエラーを表示する=1
$set{'error_level'} = 1;    #エラーログを記録する=1
$set{'error_log'} = './error.log';    #エラーログファイル名
$set{'error_size'} = 1024;  # エラーログ最大容量(KB) 制限なし=0
$set{'zero_clear'} = 1;    #ファイルが見つからない場合ログから削除する=1

$set{'disp_comment'} = 1;   #コメントを表示する=1
$set{'disp_date'} = 1;    #日付を表示する=1
$set{'disp_size'} = 1;    #サイズを表示する=1
$set{'disp_mime'} = 1;    #MIMETYPEを表示する=1
$set{'disp_orgname'} = 1;  #オリジナルファイル名を表示する=1

$set{'per_upfile'} = 0666;    #アップロードファイルのパーミッション suexec=0604,other=0666
$set{'per_dir'} = 0777;    #ソースアップディレクトリのパーミッション suexec=0701,other=0777
$set{'per_logfile'} = 0666;    #ログファイルのパーミッション suexec=0600,other=0666
$set{'link_target'} = '';    #targmdet属性

#------
$set{'message_reload'} = 'HTMLを更新しました。';
$set{'message_delete'} = '選択されたファイルを削除しました。';
$set{'message_upload'} = 'ファイルを正常にアップロードしました。';

#------
$set{'ver'} = '2005/10/10e';
$set{'char_delname'} = 'D';

#------
require './lib/makehtml.pl';
require './lib/delete.pl';
require './lib/quit.pl';
require './lib/download.pl';
require './lib/admin.pl';
require './lib/error.pl';

$in{'time'} = time(); $in{'date'} = conv_date($in{'time'});
$in{'addr'} = $ENV{'REMOTE_ADDR'};
$in{'host'} = gethostbyaddr(pack('C4',split(/\./, $in{'addr'})), 2) || $ENV{'REMOTE_HOST'} || '(none)';

if($in{'addr'} eq $in{'host'}){ $in{'host'} = '(none)'; }

$set{'html_head'} =<<"EOM";
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html lang="ja">
<HEAD>
<META name="robots" content="noindex,nofollow">
<META name="ROBOTS" content="NOINDEX,NOFOLLOW">
<META http-equiv="Content-type" content="text/html; charset=Shift_JIS">
<META http-equiv="Pragma" content="no-cache">
<META http-equiv="Cache-Control" content="no-cache">
<META http-equiv="Expires" content="0">
<TITLE>夜C専用うｐろだ</TITLE>
<link rel="SHORTCUT ICON" href="http://utatanebiyori.uzusionet.com/upload/img/favicon.ico" />
EOM

$set{'html_css'} =<<"EOM";
<link rel="stylesheet" type="text/css" href="http://utatanebiyori.uzusionet.com/upload/style.css" media="screen,print" title="default" />
EOM

unless(-e $set{'log_file'}){ &init; }
unless(-e $set{'base_html'}){ &makehtml; }

{#------ デコード ------
  my $readbuffsize = 1024*8;
  if ($ENV{'REQUEST_METHOD'} eq "POST" && $ENV{'CONTENT_TYPE'} =~ /multipart\/form-data/i){
    if ($ENV{'CONTENT_LENGTH'} > ($set{'max_size'} * 1024 + 1024)){ if($ENV{'SERVER_SOFTWARE'} =~ /IIS/){ while(read(STDIN,my $buff,$readbuffsize)){} } &error(106,$ENV{'CONTENT_LENGTH'});}
  }else{
    if ($ENV{'CONTENT_LENGTH'} > 1024*100){ error(98); }
  }
  my %ck; foreach(split(/;/,$ENV{'HTTP_COOKIE'})){ my($key,$val) = split(/=/); $key =~ s/\s//g; $ck{$key} = $val;}
  my @ck = split(/<>/,$ck{'SN_USER'});
  if(length($ck[0]) < 5){
    my @salt = ('a'..'z', 'A'..'Z', '0'..'9', '.', '/'); srand;
    my $salt = $salt[int(rand(@salt))] . $salt[int(rand(@salt))];
    $in{'user'} = crypt($in{'addr'}.$in{'time'}, $salt);
  }else{ $in{'user'} = $ck[0]; }

  if($ENV{'REQUEST_METHOD'} eq "POST" && $ENV{'CONTENT_TYPE'} =~ /multipart\/form-data/i){
    my %FORM; my $subbuff; my $filename;  my $valuename;
    my $upflag; my $valueflag; my $bound; my $mime;
    my $readlength = 0;
    my $random = int(rand(900000)) + 100000;
    my $endflag = 0;
    binmode(STDIN);
    while(<STDIN>){ $readlength += length($_); if(/(--.*)\r\n$/){ $bound = $1; last; }}
    if(-e "$set{'src_dir'}$random.temporary"){ $random++; }
    if(-e "$set{'src_dir'}$random.temporary"){ $random++; }
    if(-e "$set{'src_dir'}$random.temporary"){ &error(204); }

    open(OUT,">$set{'src_dir'}$random.temporary");
    binmode(OUT);
    my $formbuff;
    while(my $buff = <STDIN>){
      $readlength += length($buff);
      if($upflag == 1){ if($buff =~ /Content-Type:\s(.*)\r\n$/i){ $mime = $1; } $upflag++; next;}
      if($upflag == 2){
        while(1){
          my $readblen; my $filebuff;
          if($ENV{'CONTENT_LENGTH'} - $readlength < $readbuffsize){ $readblen = $ENV{'CONTENT_LENGTH'} - $readlength; }
          else{ $readblen = $readbuffsize; }
          if(!read(STDIN,$filebuff,$readblen)){ last };
          $readlength += length($filebuff);
          if($ENV{'CONTENT_LENGTH'} - $readlength < $readbuffsize){
            my $readblen = $ENV{'CONTENT_LENGTH'} - $readlength;
            read(STDIN,my $subbuff,$readblen);
            $readlength += length($subbuff);
            $filebuff .= $subbuff;
            $endflag = 1;
          }
          my $offset = index($filebuff,$bound);
          if($offset >= 0){
            $buff = substr($filebuff,0,$offset-2); my $subbuff = substr($filebuff,$offset);
            print OUT $buff; $upflag = 0; $formbuff .= $subbuff; last;
          }else{ print OUT $filebuff; }
        }
        if($endflag){ last; }
        next;
      }
      if($buff =~ /^Content-Disposition:\sform-data;\sname=\"upfile\";\sfilename=\"(.*)\"\r\n$/i){
        $filename = $1; $upflag = 1; next;
      }
      $formbuff .= $buff;
    }
    close(OUT);
    chmod($set{'per_upfile'},"$set{'src_dir'}$random.temporary");
    { my $value;
      foreach my $buff(split(/\r\n/,$formbuff)){
        $buff .= "\r\n";
        if($buff =~ /^$bound\-\-/){ $FORM{$value} =~ s/\r\n$//; $valueflag = 0; last;}
        if($buff =~ /^$bound/){ $FORM{$value} =~ s/\r\n$//; $valueflag = 0; next;}
        if($valueflag == 1){ $valueflag++; next; }
        if($valueflag == 2){ $FORM{$value} .= $buff; }
        if($buff =~ /^Content-Disposition: form-data; name=\"(.+)\"\r\n$/){ $value = $1; $valueflag++; }
      }
    }
    if($upflag || $valueflag){ unlink("$set{'src_dir'}$random.temporary"); &error(108);}

    $in{'org_pass'} = $in{'pass'} = $FORM{'pass'};
    $in{'dlkey'} = $FORM{'dlkey'};
    $in{'comment'} = $FORM{'comment'};
    $in{'jcode'} = $FORM{'jcode'};
    $in{'postkey'} = $FORM{'postkey'};
    $in{'upfile'} = $filename;
    $in{'type'} = $mime;
    $in{'tmpfile'} = "$set{'src_dir'}$random.temporary";
    $in{'orgname'} = $in{'upfile'};
    if(-s "$in{'tmpfile'}" == 0){ unlink("$in{'tmpfile'}"); &error(99) }
    if($set{'min_flag'} && ((-s "$in{'tmpfile'}") < $set{'min_size'} * 1024)){ &error(107,(-s "$in{'tmpfile'}"));}
    if((-s "$in{'tmpfile'}") > $set{'max_size'} * 1024){ &error(106,(-s "$in{'tmpfile'}"));}
    if($set{'post_flag'} && !check_postkey($in{'postkey'})){ &error(109); }
    if($set{'dlkey'} == 2 && !$in{'dlkey'}){ unlink("$in{'tmpfile'}"); &error(61); }
  }else{
    my ($buffer,%FORM,@admin_delno);
    if ($ENV{'REQUEST_METHOD'} eq "POST") { read(STDIN, $buffer, $ENV{'CONTENT_LENGTH'});}
    else { $buffer = $ENV{'QUERY_STRING'}; }
    my @pairs = split(/&/,$buffer);
    foreach my $pair (@pairs) {
      my ($name, $value) = split(/=/, $pair);
      $value =~ tr/+/ /;
      $value =~ s/%([a-fA-F0-9][a-fA-F0-9])/pack("C", hex($1))/eg;
      if($name eq 'admin_delno'){
        push(@admin_delno,$value);
      }else{
        $FORM{$name} = $value;
      }
    }
    $in{'delpass'} = $FORM{'delpass'};
    $in{'delno'} = $FORM{'delno'};
    $in{'file'} = $FORM{'file'};
    $in{'dlkey'} = $FORM{'dlkey'};
    $in{'mode'} = $FORM{'mode'};
    $in{'checkmode'} = $FORM{'checkmode'};
    $in{'admin_delno'} = join(',',@admin_delno);
    if($in{'delno'} eq $set{'admin_name'} && $in{'delpass'} eq $set{'admin_pass'}){ &admin_mode(); }
    if(!$in{'delno'} && $in{'delpass'} eq $set{'admin_pass'}){ &makehtml(); &quit($set{'message_reload'}); }
  }

  my @denyhost = split(/,/,$set{'deny_host'});
  foreach my $value (@denyhost){
    if ($in{'addr'} =~ /$value/ || $in{'host'} =~ /$value/){ &error(101);}
  }

  my @form = ($in{'comment'},$in{'orgname'},$in{'type'},$in{'dlkey'});
  foreach my $value (@form) {
    if (length($value) > 128) { $value = substr($value,0,128).'...'; }
#   $value =~ s/&/&amp;/g;
    $value =~ s/"/&quot;/g;
    $value =~ s/</&lt;/g;
    $value =~ s/>/&gt;/g;
    $value =~ s/\r//g;
    $value =~ s/\n//g;
    $value =~ s/\t//g;
    $value =~ s/\0//g;
  }
  ($in{'comment'},$in{'orgname'},$in{'type'},$in{'dlkey'}) = @form;
}

if($in{'mode'} eq 'delete'){ &delete(); &quit($set{'message_delete'}); }
if($in{'mode'} eq 'dl'){ &dlfile;} #DL
if(!$in{'upfile'}){ &error(99); }

{#------ メイン処理 ------

  open(IN,$set{'log_file'})||&error(303);
  my @log = <IN>;
  close(IN);
  my ($no,$lastip,$lasttime) = split(/<>/,$log[0]);

  if($set{'interval'} && $in{'time'} <= ($lasttime + $set{'interval'}) && $in{'addr'} eq $lastip){ &error(203);}
  $in{'ext'} = extfind($in{'orgname'}); if(!$in{'ext'}){ &error(202); }

  my $orgname;
  if(split(/\//,$in{'orgname'}) > split(/\\/,$in{'orgname'})){  my @name = split(/\//,$in{'orgname'}); $orgname = $name[$#name]; }
  else{ my @name = split(/\\/,$in{'orgname'}); $orgname = $name[$#name];}

  my @salt = ('a'..'z', 'A'..'Z', '0'..'9', '.', '/');
  srand;
  my $salt = $salt[int(rand(@salt))] . $salt[int(rand(@salt))];
  $in{'pass'} = crypt($in{'pass'}, $salt);

  if($set{'binary_compare'}){
    my @files = globfile("$set{'src_dir'}",".*");
    my @dir = globdir("$set{'src_dir'}",".*");
    foreach my $dir (@dir){  push(@files,globfile($dir."/",".*")); }
    foreach my $value (@files){
      next if($value =~ /\.temporary$/);
      if(binarycmp($in{'tmpfile'},$value)){ unlink($in{'tmpfile'}); &error(205,$value);}
    }
  }

  if($set{'find_crypt'}){
    open(FILE,$in{'tmpfile'}); binmode(FILE); seek(FILE,0,0); read(FILE,my $buff,4); my $crypt_flag = 0;
    if($buff =~ /^\x50\x4b\x03\x04$/){ seek(FILE,6,0); read(FILE,my $buff,1); $crypt_flag = 1 if(($buff & "\x01") eq "\x01"); }
    close(FILE);
    $in{'comment'} = '<font color="#FF0000">*</font>'.$in{'comment'} if($crypt_flag);
  }

  open(IN,$set{'log_file'})||&error(303);
  @log = <IN>;
  close(IN);
  ($no,$lastip,$lasttime) = split(/<>/,$log[0]);
  shift(@log);
  $no++;
  my $tmpno = sprintf("%04d",$no);

  my $dlsalt;
  my $filedir;
  my $allsize = (-s $in{'tmpfile'});

  if($set{'dlkey'} && $in{'dlkey'}){
    my @salt = ('a'..'z', 'A'..'Z', '0'..'9'); srand;
    for (my $c = 1; $c <= 20; ++$c) { $dlsalt .= $salt[int(rand(@salt))]; }
     $filedir = "$set{'src_dir'}$set{'file_pre'}${tmpno}.$in{'ext'}_$dlsalt/";
    mkdir($filedir,$set{'per_dir'});
    rename("$in{'tmpfile'}","$filedir$set{'file_pre'}$tmpno.$in{'ext'}");
    open(OUT,">${filedir}index.html");
    close(OUT);
    chmod($set{'per_upfile'},"${filedir}index.html");
    $in{'comment'} = '<font color="#FF0000">[DLKey] </font>'.$in{'comment'};
  }else{
    undef $in{'dlkey'};
    rename("$in{'tmpfile'}","$set{'src_dir'}$set{'file_pre'}$tmpno.$in{'ext'}");
  }

  if (length($orgname) > 128) { $orgname = substr($orgname,0,128).'...'; }

  my @note;
  if($set{'post_flag'} && $set{'post_key'}){
    push(@note,'PostKey:'.$in{'postkey'});
  }
  if($ENV{'SERVER_SOFTWARE'} =~ /Apache|IIS/){
    my $disptime;
    my $time = time() - $in{'time'};
    my @str = ('Upload:','秒');
    my $disptime = $time.$str[1];
    push(@note,$str[0].$disptime);
  }
  if($in{'dlkey'}){
    my @salt = ('a'..'z', 'A'..'Z', '0'..'9', '.', '/'); srand;
    my $salt = $salt[int(rand(@salt))] . $salt[int(rand(@salt))];
    my $crypt_dlkey  = crypt($in{'dlkey'}, $salt);
    push(@note,"DLKey<!-- DLKey:".$crypt_dlkey." --><!-- DLpath:".$dlsalt." -->");
  }
  my $note = join(',',@note);
  my $usersalt = substr($in{'user'},0,2);
  my $userid = crypt($in{'user'},$usersalt);
  $in{'time'} = time();
#  $in{'date'} = conv_date(time());
  my @new;
  $new[0] = "$no<>$in{'addr'}<>$in{'time'}<>1\n";
  my $addlog = "$no<>$in{'ext'}<>$in{'date'}<>$in{'comment'}<>$in{'type'}<>$orgname<>$in{'addr'}<>$in{'host'}<>$in{'pass'},$userid<>$set{'file_pre'}<>$note<>1\n";
  $new[1] = $addlog;

#  open(OUT,">>./alllog.cgi"); print OUT $addlog; close(OUT);

  my $i = 2;

  foreach my $value (@log){
    my ($no,$ext,$date,$comment,$mime,$orgname,$addr,$host,$pass,$filepre,$note,$dummy) = split(/<>/,$value);
    if(!$dummy){ $filepre = $set{'file_pre'};}
    $no = sprintf("%04d",$no);

    my $filename;
    my $filedir;
    if($note =~ /DLpath:(.+)\s/){
      my $dlpath = $1;
      $filename = "$set{'src_dir'}$filepre$no.${ext}_$dlpath/$filepre$no.$ext";
      $filedir = "$set{'src_dir'}$filepre$no.${ext}_$dlpath/";
    }else{
      $filename = "$set{'src_dir'}$filepre$no.$ext";
    }
    $allsize += (-s $filename);

    if($i <= $set{'max_log'} && !($set{'max_all_flag'} && $set{'max_all_size'}*1024 < $allsize)){
      if((-e $filename)||!$set{'zero_clear'}){ push(@new,$value); $i++; }
    }else{
      if(unlink($filename)){
        unlink("$set{'src_dir'}$filepre$no.$ext.html"); if($filedir){ foreach(globfile($filedir,".*")){ unlink; } } rmdir($filedir);
      }elsif(unlink($filename)){
        unlink("$set{'src_dir'}$filepre$no.$ext.html"); if($filedir){ foreach(globfile($filedir,".*")){ unlink; } } rmdir($filedir);
      }elsif(-e $filename){
        push(@new,$value);
      }else{
        unlink("$set{'src_dir'}$filepre$no.$ext.html"); if($filedir){ foreach(globfile($filedir,".*")){ unlink; } } rmdir($filedir);
      }
    }
  }
  logwrite(@new);
  if($in{'dlkey'} && ( $set{'dummy_html'} == 2 || $set{'dummy_html'} == 3)){
    &makedummyhtml("$set{'file_pre'}$tmpno.$in{'ext'}",$in{'comment'},"$set{'file_pre'}$tmpno.$in{'ext'}",$dlsalt,$in{'date'},$in{'type'},$orgname,$no);
  }elsif(!$in{'dlkey'} && ($set{'dummy_html'} == 1 || $set{'dummy_html'} == 3)){
    &makedummyhtml("$set{'file_pre'}$tmpno.$in{'ext'}");
  }
  &makehtml(); &quit();
}

sub extfind{
  my $orgname = @_[0];
  my @filename = split(/\./,$orgname);
  my $ext = $filename[$#filename];
  $ext =~ tr/[A-Z]/[a-z]/;
  foreach my $value (split(/,/,$set{'change_ext'})){ my ($src,$dst) = split(/->/,$value); if($ext eq $src){ $ext = $dst; last; }}
  foreach my $value (split(/,/,$set{'deny_ext'})){ if($ext eq $value){ &error(206,$ext); }}
  foreach my $value (split(/,/,$set{'up_ext'})){ if ($ext eq $value) { return $value; } }
  if(length($ext) >= 5 || length($ext) == 0){ $ext = 'bin'; }
  unless ($ext =~ /^[A-Za-z0-9]+$/){ $ext = 'bin'; }
  if($set{'up_all'} && $set{'ext_org'}){ return $ext;}
  elsif($set{'up_all'}){ return 'bin'; }
  return 0;
}

sub conv_date{
  my @date = gmtime($_[0] + 9*60*60);
  $date[5] -= 100; $date[4]++;
  if ($date[5] < 10) { $date[5] = "0$date[5]" ; }  if ($date[4] < 10) { $date[4] = "0$date[4]" ; }
  if ($date[3] < 10) { $date[3] = "0$date[3]" ; }  if ($date[2] < 10) { $date[2] = "0$date[2]" ; }
  if ($date[1] < 10) { $date[1] = "0$date[1]" ; }  if ($date[0] < 10) { $date[0] = "0$date[0]" ; }
  my @w = ('Sun','Mon','Tue','Wed','Thu','Fri','Sat');
  return ("$date[5]/$date[4]/$date[3]($w[$date[6]]),$date[2]:$date[1]:$date[0]");
}

sub dispsize{
  my $size = $_[0];
  if($size >= 1024*1024*1024*100){ $size = int($size/1024/1024/1024).'GB';}
  elsif($size >= 1024*1024*1024*10){ $size = sprintf("%.1fGB",$size/1024/1024/1024);}
  elsif($size > 1024*1024*1024){ $size = sprintf("%.2fGB",$size/1024/1024/1024);}
  elsif($size >= 1024*1024*100){ $size = int($size/1024/1024).'MB'; }
  elsif($size > 1024*1024){ $size =  sprintf("%.1fMB",$size/1024/1024); }
  elsif($size > 1024){ $size = int($size/1024).'KB'; }
  else{ $size = int($size).'B';}
  return $size;
}

sub logwrite{
  my @log = @_;
  open(OUT,"+>$set{'log_file'}")||&error(304);
  eval{ flock(OUT, 2);};
  eval{ truncate(OUT, 0);};
  seek(OUT, 0, 0);
  print OUT @log;
  eval{ flock(OUT, 8);};
  close(OUT);
  chmod($set{'per_upfile'},$set{'log_file'});
  return 1;
}

sub binarycmp{
  my ($src,$dst) = @_;
  return 0 if (-s $src != -s $dst);
  open(SRC,$src)||return 0; open(DST,$dst)||return 0;
  my ($buff,$buff2);
  binmode(SRC); binmode(DST); seek(SRC,0,0); seek(DST,0,0);
  while(read(SRC,$buff,8192)){ read(DST,$buff2,8192); if($buff ne $buff2){ close(SRC); close(DST); return 0; } }
  close(SRC); close(DST);
  return 1;
}

sub init{
  my $buff;
  if(open(OUT,">$set{'log_file'}")){
    print OUT "0<>0<>0<>1\n";
    close(OUT);
    chmod($set{'per_logfile'},$set{'log_file'});
  }else{
    $buff = "<tr><td>メインログの作成に失敗しました</td></tr>";
  }

  unless (-d "$set{'src_dir'}"){
    if(mkdir("$set{'src_dir'}",$set{'per_dir'})){
      chmod($set{'per_dir'},"$set{'src_dir'}");
      open(OUT,">$set{'src_dir'}index.html");
      close(OUT);
      chmod($set{'per_upfile'},"$set{'src_dir'}index.html");
    }else{
      $buff .= "<tr><td>Source保存ディレクトリの作成に失敗しました</td></tr>";
    }
  }

  unless (-d "$set{'html_dir'}"){
    if(mkdir("$set{'html_dir'}",$set{'per_dir'})){
      chmod($set{'per_dir'},"$set{'html_dir'}");
    }else{
      $buff .= "<tr><td>HTML保存ディレクトリの作成に失敗しました</td></tr>";
    }
  }

  if($buff){
    $buff .= "<tr><td>ディレクトリに書き込み権限があるか確認してください</td></tr>";
    &error_disp($buff,'init');
  }
}

sub check_postkey{
  my $inputkey = @_[0];
  my @key = split(/,/,$set{'post_key'});
  foreach my $key (@key){ if($inputkey eq $key){ return 1; } }
  return 0;
}

sub leaddisp{
  my @src = @_;
  my ($str,$count);
  foreach my $value (@src){
    my ($mark,$name,$link); $count++;
    if($count == 1){ $name = 'Upload Info'; $link = 'up'; }
    elsif($count == 2){ $name = 'Error Info'; $link = 'error'; next if(!$set{'error_level'}); }
    elsif($count == 3){ $name = 'Setting Info'; $link = 'set'; }
    if($value){ if($value > 0){ $mark = '▼'; }else{ $mark = '▲'; } $str .= qq|<a href="#$link">${mark}${name}</a> |; }
    else{ $str .= qq|[$name] |; }
  }
  return $str;
}

sub errorclear{
  open(OUT,">$set{'error_log'}")||return 0;
  eval{ flock(OUT, 2);}; eval{ truncate(OUT, 0);}; seek(OUT, 0, 0); eval{ flock(OUT, 8);}; close(OUT);
  chmod($set{'per_upfile'},$set{'log_file'});
  return 1;
}

sub tablestr{
  my ($value1,$value2) = @_;
  return ("<tr><td>$value1</td><td>$value2</td></tr>\n");
}

sub globfile{
  my ($src_dir,$filename) = @_;
  opendir(DIR,$src_dir)||return 0; my @dir = readdir(DIR); closedir(DIR);
  my @new = (); foreach my $value (@dir){ push(@new,"$src_dir$value") if($value =~ /$filename/ && !(-d "$src_dir$value")); }
  return @new;
}

sub globdir{
  my ($src_dir,$dir) = @_;
  opendir(DIR,$src_dir)||return 0; my @dir = readdir(DIR); closedir(DIR);
  my @new = (); foreach my $value (@dir){ if($value eq '.' ||$value eq '..' ){ next; } push(@new,"$src_dir$value") if($value =~ /$dir/ && (-d "$src_dir$value")); }
  return @new;
}

__END__