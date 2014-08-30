sub quit{
  my $message = $_[0];
  my ($cookiename,$buff);
  my $flag = 0;
  my @tmpfiles = globfile("$set{'src_dir'}","\.temporary");
  foreach my $value (@tmpfiles){ if((stat($value))[10] < time - 60*60){ unlink("$value"); $flag++; } }
  &makehtml() if($flag);
  $buff =<<"EOM";
$set{'html_head'}
EOM
  if($in{'jcode'} || $in{'mode'} eq 'delete'){
    $buff .=<<"EOM";
<META HTTP-EQUIV="Set-Cookie" content="SN_USER=$in{'user'}&lt;&gt;1; path=/; expires=Tue, 31-Dec-2030 23:59:59 GMT">
<META HTTP-EQUIV="CONTENT-SCRIPT-TYPE" CONTENT="text/javascript">
<script type="text/javascript">
<!--
setCookie();
function setCookie() {
  var key1,key2;
  var tmp = "path=/; expires=Tue, 31-Dec-2030 23:59:59; ";
EOM
    if($in{'jcode'})
    {
      my %ck; foreach(split(/;/,$ENV{'HTTP_COOKIE'})){ my($key,$val) = split(/=/); $key =~ s/\s//g; $ck{$key} = $val;}
      my @ck = split(/<>/,$ck{'SN_DEL'});
      if(!$ck[0] && $in{'org_pass'})
      {
        $buff .= qq|\tdocument.cookie = "SN_DEL="+escape('$in{'org_pass'}')+"<>;"+ tmp;\n|;
      }
      $cookiename = 'SN_UPLOAD'; $buff .= "\tkey1 = escape('$in{'org_pass'}'); key2 = escape('$in{'postkey'}');\n";
    }
    else
    {
      $cookiename = 'SN_DEL'; $buff .= "\tkey1 = escape('$in{'delpass'}'); key2 = '';\n";
    }
    $buff .= qq|\tdocument.cookie = "$cookiename="+key1+"<>"+key2+"; "+ tmp;\n}\n//-->\n</script>\n|;
  }
  $buff .=<<"EOM";
<body>
<br />
<br />
<div align=center>
$message<br />
<a href="$set{'http_html_path'}$set{'base_html'}?$in{'time'}">Top‚É–ß‚é</a>
</div>
</body></html>
EOM
  print "Content-type: text/html\n\n";
  print $buff;
  exit;
}

1;