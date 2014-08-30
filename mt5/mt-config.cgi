## Movable Type Configuration File
##
## This file defines system-wide
## settings for Movable Type. In 
## total, there are over a hundred 
## options, but only those 
## critical for everyone are listed 
## below.
##
## Information on all others can be 
## found at:
##  http://www.movabletype.jp/documentation/config

#======== REQUIRED SETTINGS ==========

CGIPath        /mt5/
StaticWebPath  /mt5/mt-static/
StaticFilePath /home/utatanebiyori/public_html/mt5/mt-static

#======== DATABASE SETTINGS ==========

ObjectDriver DBI::mysql
Database utatanebiyori
DBUser utatanebiyori
DBPassword utatanebiyori
DBHost localhost

#======== MAIL =======================

MailTransfer sendmail
SendMailPath /usr/lib/sendmail

#======== LANG =======================

DefaultLanguage ja
MailEncoding ISO-2022-JP
ExportEncoding Shift_JIS
DefaultTimezone 9
CategoryNameNodash 1
NewsboxURL http://www.sixapart.jp/movabletype/news/newsbox.html
LearningNewsURL http://www.movabletype.jp/newsbox.html
NewsURL http://www.sixapart.jp/movabletype/
