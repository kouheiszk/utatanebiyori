#!/usr/bin/perl
use vars qw(%set %in);
use strict;
$set{'log_file'} = './log.cgi';    #���O�t�@�C����
$set{'max_log'} = 100;    #�ێ�����
$set{'max_size'} = 20*1024;    #�ő哊�e�e��(KB)
$set{'min_flag'} = 0;    #�ŏ��e�ʐ������g�p����=1
$set{'min_size'} = 100;    #�ŏ����e�e��(KB)
$set{'max_all_flag'} = 1;    #���e�ʐ������g�p����=1
$set{'max_all_size'} = 500*1024;    #�������e��(KB)
$set{'file_pre'} = 'up';    #�t�@�C���ړ���
$set{'pagelog'} = 10;    #1�y�[�W�ɕ\������t�@�C����
$set{'base_html'} = 'index.html';    #1�y�[�W�ڂ̃t�@�C����
$set{'interval'} = 30;    #����IP���e�Ԋu�b��
$set{'deny_host'} = '';    #���e�֎~IP/HOST ,�ŋ�؂� ex.(bbtec.net,219.119.66,ac.jp)
$set{'admin_name'} = 'nagi';    #�Ǘ��҃��O�C��ID
$set{'admin_pass'} = 'passwdupload';    #�Ǘ��҃p�X���[�h

# �ȉ�5���ڂ��Đݒ肷��ۂɂ�PATH�C�f�B���N�g���� / �ŏI��邱��
# $set{'html_dir'},$set{'base_cgi'}�� ./ �ȊO�ɐݒ肷��ꍇ,
# �܂���DLkey���g�p�� �Ȃ�����HTML�L���b�V��($set{'dummy_html'} = 2 or 3)���g�p����ꍇ��
# $set{'base_cgi'} , $set{'http_html_path'} , $set{'http_src_path'} ���t���p�X(http://�`�` or /�`�`)�ŋL�q����
$set{'html_dir'} = './';    # ����HTML�ۑ��f�B���N�g��
$set{'src_dir'} = '../data/upload/';    # �����t�@�C���ۑ��f�B���N�g��
$set{'base_cgi'} = './index.cgi'; # ���̃X�N���v�g�� http://�`�̎w��\
$set{'http_html_path'} = './';    # html�Q�� httpPATH http://�`�̎w��\
$set{'http_src_path'} = '../data/upload/';    # file�Q�� httpPATH http://�`�̎w��\

$set{'dlkey'} = 2;    # DLKey���g�p����=1,DLkey�K�{=2
$set{'up_ext'} = 'txt,lzh,zip,rar,gca,tar,gz,mpg,mp3,avi,swf,bmp,jpg,gif,png'; #�A�b�v���[�h�ł����{�g���q ���p�p�������� ,�ŋ�؂�
$set{'up_all'} = 0;    #�o�^�ȊO�̂��̂�UP��������悤�ɂ���=1
$set{'ext_org'} = 1;  #$set{'up_all'}��1�̎��I���W�i���̊g���q�ɂ���=1
$set{'deny_ext'} = 'php,php3,phtml,rb,sh,bat,dll';   #���e�֎~�̊g���q ���p�p�������� ,�ŋ�؂�
$set{'change_ext'} = 'cgi->txt,pl->txt,log->txt,jpeg->jpg,mpeg->mpg';    #�g���q�ϊ� �O->�� ���p�p�������� ,�ŋ�؂�

$set{'home_url'} = '';    #[HOME]�̃����N�� ���΃p�X���� http://����n�܂��΃p�X
$set{'html_all'} = 1;    #[ALL]���o��=1
$set{'dummy_html'} = 1;    #�t�@�C����HTML���쐬���� �ʏ�t�@�C���̂�=1,DLKey�ݒ�t�@�C���̂�=2,���ׂ�=3
$set{'find_crypt'} = 1;    #�Í���ZIP�����o����=1
$set{'binary_compare'} = 0;    #�����t�@�C���ƃo�C�i����r����=1
$set{'post_flag'} = 0;    #PostKey���g�p����=1
$set{'post_key'} = 'postkey';    #PostKey ,�ŋ�؂�ƕ����w�� ex.(postkey1,postkey2)
$set{'disp_error'} = 1;    #���[�U�[�ɃG���[��\������=1
$set{'error_level'} = 1;    #�G���[���O���L�^����=1
$set{'error_log'} = './error.log';    #�G���[���O�t�@�C����
$set{'error_size'} = 1024;  # �G���[���O�ő�e��(KB) �����Ȃ�=0
$set{'zero_clear'} = 1;    #�t�@�C����������Ȃ��ꍇ���O����폜����=1

$set{'disp_comment'} = 1;   #�R�����g��\������=1
$set{'disp_date'} = 1;    #���t��\������=1
$set{'disp_size'} = 1;    #�T�C�Y��\������=1
$set{'disp_mime'} = 1;    #MIMETYPE��\������=1
$set{'disp_orgname'} = 1;  #�I���W�i���t�@�C������\������=1

$set{'per_upfile'} = 0666;    #�A�b�v���[�h�t�@�C���̃p�[�~�b�V���� suexec=0604,other=0666
$set{'per_dir'} = 0777;    #�\�[�X�A�b�v�f�B���N�g���̃p�[�~�b�V���� suexec=0701,other=0777
$set{'per_logfile'} = 0666;    #���O�t�@�C���̃p�[�~�b�V���� suexec=0600,other=0666
$set{'link_target'} = '';    #targmdet����

#------
$set{'message_reload'} = 'HTML���X�V���܂����B';
$set{'message_delete'} = '�I�����ꂽ�t�@�C�����폜���܂����B';
$set{'message_upload'} = '�t�@�C���𐳏�ɃA�b�v���[�h���܂����B';

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
<TITLE>��C��p�����낾</TITLE>
<link rel="SHORTCUT ICON" href="http://utatanebiyori.uzusionet.com/upload/img/favicon.ico" />
EOM

$set{'html_css'} =<<"EOM";
<link rel="stylesheet" type="text/css" href="http://utatanebiyori.uzusionet.com/upload/style.css" media="screen,print" title="default" />
EOM

unless(-e $set{'log_file'}){ &init; }
unless(-e $set{'base_html'}){ &makehtml; }

{#------ �f�R�[�h ------
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

{#------ ���C������ ------

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
    my @str = ('Upload:','�b');
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
    $buff = "<tr><td>���C�����O�̍쐬�Ɏ��s���܂���</td></tr>";
  }

  unless (-d "$set{'src_dir'}"){
    if(mkdir("$set{'src_dir'}",$set{'per_dir'})){
      chmod($set{'per_dir'},"$set{'src_dir'}");
      open(OUT,">$set{'src_dir'}index.html");
      close(OUT);
      chmod($set{'per_upfile'},"$set{'src_dir'}index.html");
    }else{
      $buff .= "<tr><td>Source�ۑ��f�B���N�g���̍쐬�Ɏ��s���܂���</td></tr>";
    }
  }

  unless (-d "$set{'html_dir'}"){
    if(mkdir("$set{'html_dir'}",$set{'per_dir'})){
      chmod($set{'per_dir'},"$set{'html_dir'}");
    }else{
      $buff .= "<tr><td>HTML�ۑ��f�B���N�g���̍쐬�Ɏ��s���܂���</td></tr>";
    }
  }

  if($buff){
    $buff .= "<tr><td>�f�B���N�g���ɏ������݌��������邩�m�F���Ă�������</td></tr>";
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
    if($value){ if($value > 0){ $mark = '��'; }else{ $mark = '��'; } $str .= qq|<a href="#$link">${mark}${name}</a> |; }
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