#!/usr/local/bin/perl

print "Content-type: text/html\n";
print "\n";
print "<html>\n";
print "<head>\n";
print "<title>テスト</title>\n";
print "</head>\n";
print "<body bgcolor=\"#ffcccc\">\n";
require './resize.pl';
if(imgbbs::imgresize("./1.jpg","./2.jpg",100,200,75,1)){
	print "./2.jpg 作成しました。\n";
}else{
	print "./2.jpg 作成しませんでした。\n";
}
print "</body>\n";
print "</html>\n";
