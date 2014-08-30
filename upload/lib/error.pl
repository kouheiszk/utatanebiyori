sub error_disp{
  my ($message,$mode) = @_;
  my $url;
  if($mode eq 'init')
  {
    $url = qq|<a href="$set{'base_cgi'}">[�����[�h]</a>|;
  }
  else
  {
    $url = qq|<a href="$set{'http_html_path'}$set{'base_html'}">[�߂�]</a>|;
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
  elsif($no == 99){ $message = "UpFile�Ȃ�"; }
  elsif($no == 101){ $message = "���e�֎~HOST"; }
  elsif($no == 106){ $flag = 1; $message = "POST�T�C�Y����"; $note = dispsize($note); $dispmsg= '<tr><td>�t�@�C�����A�b�v���[�h�ł��܂���ł���</td></tr><tr><td>�A�b�v���[�h�t�@�C��('.$note.')�� �ő�e�ʐݒ�('.dispsize($set{'max_size'}*1024).')���z���Ă��܂�</td></tr>';}
  elsif($no == 107){ $flag = 1; $message = "POST�T�C�Y�ߏ�"; $note = dispsize($note); $dispmsg= '<tr><td>�t�@�C�����A�b�v���[�h�ł��܂���ł���</td></tr><tr><td>�A�b�v���[�h�t�@�C��('.$note.')�� �ŏ��e�ʐݒ�('.dispsize($set{'min_size'}*1024).')�����ł�</td></tr>';}
  elsif($no == 108){ $flag = 1; $message = "POST�f�[�^�s���S"; $dispmsg = '<tr><td>�t�@�C�����A�b�v���[�h�ł��܂���ł���</td></tr><tr><td>POST�f�[�^���s���S�ł�</td></tr>';}
  elsif($no == 109){ $flag = 1; $message = "POSTKey�s��v"; $dispmsg = '<tr><td>�t�@�C�����A�b�v���[�h�ł��܂���ł���</td></tr><tr><td>POSTKey����v���܂���</td></tr>';}
  elsif($no == 202){ $flag = 1; $message = "�g���q���킸"; $dispmsg = '<tr><td>�t�@�C�����A�b�v���[�h�ł��܂���ł���</td></tr><tr><td>���e�ł���g���q��'.$set{'up_ext'}.'�ł�</td></tr>';}
  elsif($no == 203){ $flag = 1; $message = "���e������"; $dispmsg = '<tr><td>�t�@�C�����A�b�v���[�h�ł��܂���ł���</td></tr><tr><td>����IP�A�h���X����'.$set{'interval'}.'�b�ȓ��ɍē��e�ł��܂���</td></tr>';}
  elsif($no == 204){ $flag = 1; $message = "�ꎞ�t�@�C���������߂�"; $dispmsg = '<tr><td>�t�@�C�����A�b�v���[�h�ł��܂���ł���</td></tr><tr><td>�ꎞ�t�@�C���̍쐬�Ɏ��s���܂���</td></tr>';}
  elsif($no == 205){ $flag = 1; $message = "����t�@�C������"; $note =~ /([^\/]+)$/; my $filename = $1; $dispmsg = '<tr><td>�t�@�C�����A�b�v���[�h�ł��܂���ł���</td></tr><tr><td>����t�@�C���� '.$filename.' �ɑ��݂��܂�</td></tr>';}
  elsif($no == 206){ $flag = 1; $message = "�֎~�g���q"; $dispmsg = '<tr><td>�t�@�C�����A�b�v���[�h�ł��܂���ł���</td></tr><tr><td>�g���q '.$note.' �̓A�b�v���[�h�ł��܂���</td></tr>';}
  elsif($no == 303){ $flag = 1; $message = "���O�t�@�C���ɓǂݍ��߂�"; $dispmsg = '<tr><td>���C�����O�̓ǂݍ��݂Ɏ��s���܂���</td></tr>';}
  elsif($no == 304){ $flag = 1; $message = "���O�t�@�C���ɏ������߂�"; $dispmsg = '<tr><td>���C�����O�̏������݂Ɏ��s���܂���</td></tr>';}
  elsif($no == 306){ $message = "�t�@�C�����X�gHTML�������߂�";}
  elsif($no == 307){ $message = "�t�@�C��HTML�t�@�C���������߂�";}
  elsif($no == 401){ $flag = 1; $message = "�폜No.���o�ł���"; $dispmsg = '<tr><td>�t�@�C�����폜�ł��܂���ł���</td></tr><tr><td>'.$note.' ����폜No.�����o�ł��܂���ł���</td></tr><tr><td>'.$set{'file_pre'}.'0774.zip�̏ꍇ No.�ɂ� 774 ����͂��܂�</td></tr>';}
  elsif($no == 402){ $flag = 1; $note = sprintf("%04d",int($note)); $message = "�폜No.���݂���"; $dispmsg = '<tr><td>�t�@�C�����폜�ł��܂���ł���</td></tr><tr><td>'.$set{'file_pre'}.$note.'.*** �̓��C�����O�ɑ��݂��܂���</td></tr>';}
  elsif($no == 403){ $flag = 1; $message = "�폜�A�N�Z�X����"; $dispmsg = '<tr><td>�t�@�C�����폜�ł��܂���ł���</td></tr><tr><td>�t�@�C���폜�����͖������Ă��܂��� '.$note.' �̃t�@�C���̍폜�����ۂ���܂���</td></tr><tr><td>�A�N�Z�X���ߏ�ȏꍇ���͎��Ԃ�u���čđ��삷��ƍ폜�ł��邱�Ƃ�����܂�</td></tr>';}
  elsif($no == 404){ $flag = 1; $message = "�폜Key�s��v"; $dispmsg = '<tr><td>�t�@�C�����폜�ł��܂���ł���</td></tr><tr><td>'.$note.' �폜Key����v���܂���ł���</td></tr>';}

  elsif($no == 51){ $flag = 1; $message = "[DLMode] No.�����炸";  $dispmsg = '<tr><td>[DLMode] �t�@�C����������܂���ł���</td></tr><tr><td>'.$note.' ����t�@�C��No.�����o�ł��܂���ł���</td></tr>'; }
  elsif($no == 52){ $flag = 1; $message = "[DLMode] File�����炸";  $dispmsg = '<tr><td>[DLMode] �t�@�C����������܂���ł���</td></tr><tr><td>'.$set{'file_pre'}.$note.'.*** �̓��C�����O�ɑ��݂��܂���</td></tr>'; }
  elsif($no == 53){ $flag = 1; $message = "[DLMode] DLkey���ݒ�";  $dispmsg = '<tr><td>[DLMode] orgDLkeyError</td></tr><tr><td>'.$note.' DLKey�����ݒ�ł�</td></tr>'; }
  elsif($no == 54){ $flag = 1; $message = "[DLMode] DLkey�s��v";  $dispmsg = '<tr><td>[DLMode] orgDLkeyError</td></tr><tr><td>'.$note.' DLKey����v���܂���ł���</td></tr>'; }
  elsif($no == 55){ $flag = 1; $message = "[DLMode] File Oepn Error";  $dispmsg = '<tr><td>[DLMode] Open Error</td></tr><tr><td>'.$note.' �t�@�C���̓ǂݍ��݂Ɏ��s���܂���</td></tr>'; }
  elsif($no == 56){ $flag = 1; $message = "[DLMode] File Not Found";  $dispmsg = '<tr><td>[DLMode] Not Found</td></tr><tr><td>'.$note.' �t�@�C�������݂��܂���</td></tr>'; }

  elsif($no == 61){ $flag = 1; $message = "DLkey���ݒ�";  $dispmsg = '<tr><td>DLKey�����ݒ�ł�</td></tr>'; }

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