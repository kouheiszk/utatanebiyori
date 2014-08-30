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
  <td><form action="$set{'base_cgi'}" method="POST"><input type=hidden name="checkmode" value="allcheck"><input type=hidden name=delno value="$in{'delno'}"><input type=hidden name=delpass value="$in{'delpass'}"><input type=submit value="���ׂă`�F�b�N"></form></td>
  <td><form action="$set{'base_cgi'}" method="POST"><input type=hidden name="checkmode" value="nocheck"><input type=hidden name=delno value="$in{'delno'}"><input type=hidden name=delpass value="$in{'delpass'}"><input type=submit value="���ׂĊO��"></form></td>
  <td><form action="$set{'base_cgi'}" method="POST"><input type=hidden name=delpass value="$set{'admin_pass'}"><input type=submit value="HTML���X�V����/���O�A�E�g"></form></td>
  </tr></table>\n
  <form action="$set{'base_cgi'}" method="POST"><input type=hidden name="mode" value="delete"><input type=hidden name=delno value="$in{'delno'}"><input type=hidden name=delpass value="$in{'delpass'}"><input type=submit value="�`�F�b�N�������̂��폜"><br>\n|;
  $buff .= "<table summary=\"upinfo\" width=\"100%\">\n<tr><td>DEL</td><td>NAME</td><td>COMMENT</td><td>SIZE</td><td>ADDR</td><td>HOST</td><td>DATE</td><td>NOTE</td><td>MIME</td><td>ORIG</td></tr>\n";
  shift(@log);
  foreach (@log){  $buff .= makeitem($_,'admin'); }
  $buff .= '</table></form><br><br>';

  if($set{'error_level'}){
    $buff .= leaddisp(-1,0,1).'<a name="error"></a><table summary="errortitle" width="100%"><tr><td bgcolor="#caccff"><strong><font size="4" color="#3366cc">Error Info</font></strong></td></tr></table>';
    $buff .= qq|<form action="$set{'base_cgi'}" method="POST"><input type=hidden name=mode value="errorclear"><input type=hidden name=delno value="$in{'delno'}"><input type=hidden name=delpass value="$in{'delpass'}"><input type=submit value="�G���[���O�N���A"></form>|;
    $buff .= "<table summary=\"errorinfo\" width=\"100%\">\n<tr><td>DATE</td><td>ADDR</td><td>HOST</td><td>NOTE</td></tr>\n";
    if(open(IN,$set{'error_log'})){  @log = reverse(<IN>); close(IN); foreach (@log){ my ($date,$no,$note,$addr,$host) = split(/<>/); $buff .= "<tr><td>$date</td><td>$addr</td><td>$host</td><td>$note</td></tr>\n"; }}
    $buff .= "</table><br><br>\n";
  }

  $buff .= leaddisp(-1,-1,0);
  $buff .= '<a name="set"></a><table summary="settitle" width="100%"><tr><td bgcolor="#caccff"><strong><font size="4" color="#3366cc">Setting Info</font></strong></td></tr></table>'."\n<table summary=\"setting\">\n";
  $buff .= tablestr('�X�N���v�gVer',$set{'ver'});
  $buff .= tablestr('���C�����O�t�@�C��',$set{'log_file'});
  if($set{'error_level'}){
    $buff .= tablestr('�G���[���O�t�@�C��',$set{'error_log'});
    if($set{'error_size'}){ $buff .= tablestr('�G���[���O�ő�e��',dispsize($set{'error_size'}*1024).' '.($set{'error_size'}*1024).'Bytes'); }
    else{ $buff .= tablestr('�G���[���O�ő�e�ʐ���','��'); }
  }else{ $buff .= tablestr('�G���[���O�L�^','��'); }
  $buff .= tablestr('�ێ�����',$set{'max_log'});
  $buff .= tablestr('�ő哊�e�e��',dispsize($set{'max_size'}*1024).' '.($set{'max_size'}*1024).'Bytes');

  if($set{'min_flag'}){ $buff .= tablestr('�ŏ������e��',dispsize($set{'min_size'}*1024).' '.($set{'min_size'}*1024).'Bytes'); }
  else{ $buff .= tablestr('�ŏ������e��',"��"); }
  if($set{'max_all_flag'}){ $buff .= tablestr('���e�ʐ���',dispsize($set{'max_all_size'}*1024).' '.($set{'max_all_size'}*1024).'Bytes'); }
  else{ $buff .= tablestr('���e�ʐ���',"��"); }

  $buff .= tablestr("�t�@�C���ړ���",$set{'file_pre'});
  $buff .= tablestr("HTML�ۑ��f�B���N�g��",$set{'html_dir'});
  $buff .= tablestr("�t�@�C���ۑ��f�B���N�g��",$set{'src_dir'});
  if($set{'http_html_path'} && $set{'html_dir'} ne $set{'http_html_path'}){ $buff .= "<tr><td>HTTP_HTML_PATH</td><td>$set{'http_html_path'}</td></tr>\n";}
  if($set{'http_src_path'} && $set{'src_dir'} ne $set{'http_src_path'}){ $buff .= "<tr><td>HTTP_SRC_PATH</td><td>$set{'http_src_path'}</td></tr>\n";}
  $buff .= tablestr('1�y�[�W�ɕ\������t�@�C����',$set{'pagelog'});
  if($set{'interval'} > 0){ $value = $set{'interval'}.'�b'; }else{ $value = '��'; }
  $buff .= tablestr('����IP���e�Ԋu�b������',$value);
  if($set{'up_ext'}){  $set{'up_ext'} =~ s/,/ /g; $buff .= tablestr('���e�\��{�g���q',$set{'up_ext'}); }
  if($set{'deny_ext'}){ $set{'deny_ext'} =~ s/,/ /g; $buff .= tablestr('���e�֎~�g���q',$set{'deny_ext'}); }
  if($set{'change_ext'}){  $set{'change_ext'} =~ s/,/ /g; $set{'change_ext'} =~ s/>/&gt;/g; $buff .= tablestr('�g���q�ϊ�',$set{'change_ext'});  }

  if($set{'up_all'}){  $buff .= tablestr('�w��O�g���q�A�b�v���[�h����','�L'); if($set{'ext_org'}){ $buff .= tablestr('�w��O�t�@�C���g���q','�I���W�i��'); }else{ $buff .= tablestr('�w��O�t�@�C���g���q','bin'); }}
  else{$buff .= tablestr('�w��O�g���q�A�b�v���[�h����','��');}

  if($set{'find_crypt'}){ $value = '�L'; }else{ $value = '��';}
  $buff .= tablestr('�Í����A�[�J�C�u���o(ZIP)',$value);
  if($set{'binary_compare'}){ $value = '�L'; }else{ $value = '��';}
  $buff .= tablestr('�o�C�i����r',$value);
  if($set{'post_flag'}){ $value = '�L'; }else{ $value = '��';}
  $buff .= tablestr('PostKey���e����',$value);
  if($set{'dlkey'}){ if($set{'dlkey'} == 2){$value = '�K�{'}else{$value = '�C��';}}else{ $value = '��';}
  $buff .= tablestr('DLkey',$value);
  if($set{'dummy_html'}){ if($set{'dummy_html'} == 3){$value = 'ALL'}elsif($set{'dummy_html'} == 2){$value = 'DLKey�̂�';}else{$value = '�ʏ�t�@�C���̂�';}}else{ $value = '��';}
  $buff .= tablestr('��HTML�L���b�V��',$value);
  if($set{'disp_error'}){ $value = '�L'; }else{ $value = '��';}
  $buff .= tablestr('���[�U�G���[�\��',$value);
  if($set{'zero_clear'}){ $value = '�L'; }else{ $value = '��';}
  $buff .= tablestr('�폜�σt�@�C�����X�g��������',$value);
  if($set{'home_url'}){ $buff .= "<tr><td>HOMEURL</td><td>$set{'home_url'}</td></tr>\n";}

  $buff .= '</table></body></html>';

  print "Content-type: text/html\n\n";
  print $buff;
  exit;
}

1;