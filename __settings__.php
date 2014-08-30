<?php
include_once("/home/utatanebiyori/public_html/rhaco/Rhaco.php");
/** Site Name */
define("VAR_SITE_NAME","SITE_NAME");
/** Site Mailaddress */
define("VAR_SITE_MAIL_ADDRESS","SITE_MAIL_ADDRESS");
/** System Mailaddress */
define("VAR_MAIL_ADDRESS","MAIL_ADDRESS");
/** Counter Mailaddress */
define("VAR_COUNTER_MAIL_ADDRESS","COUNTER_MAIL_ADDRESS");
/** WIki Backup Mailaddress */
define("VAR_WIKI_BACKUP_MAIL_ADDRESS","WIKI_BACKUP_MAIL_ADDRESS");
/** NOreply Mailaddress */
define("VAR_NOREPLY_MAIL_ADDRESS","NOREPLY_MAIL_ADDRESS");
/** URIの前のサーバー部分 */
define("VAR_BEFOR_URI","BEFOR_URI");
/** 電気通信大学休講情報のURL */
define("VAR_KYUUKOU_URL","KYUUKOU_URL");
/** 【Wiki】トップページ */
define("VAR_WIKI_TOP","WIKI_TOP");
/** 【Wiki】メニュー */
define("VAR_WIKI_MENU","WIKI_MENU");
/** 【Wiki】システムユーザーID */
define("VAR_SYSTEM_USER_ID","SYSTEM_USER_ID");
/** 【Wiki】ゲストユーザーID */
define("VAR_GUEST_USER_ID","GUEST_USER_ID");
/** 【Uploader】アップロードファイルの場所 */
define("VAR_UPLOAD_URL","UPLOAD_URL");
/** 【Uploader】アップロード間隔（秒） */
define("VAR_UPLOAD_INTERVAL","UPLOAD_INTERVAL");
/** 【Uploader】ダウンロードのパスワード */
define("VAR_DOWNLOAD_PASSWORD","DOWNLOAD_PASSWORD");
/** 【Uploader】ゲストのアップロードサイズ（Byte） */
define("VAR_UPLOAD_SIZE_GUEST","UPLOAD_SIZE_GUEST");
/** 【Uploader】ユーザーのアップロードサイズ（Byte） */
define("VAR_UPLOAD_SIZE_USER","UPLOAD_SIZE_USER");
Rhaco::constant("PROJECT_VERSION","0.6.0");
Rhaco::constant("CONTEXT_PATH",Rhaco::filepath(dirname(__FILE__)));
Rhaco::constant("CONTEXT_URL","http://utatanebiyori.uzusionet.com/");
Rhaco::constant("PROJECT_PATH",Rhaco::filepath("/home/utatanebiyori/public_html/"));
Rhaco::constant("TEMPLATE_URL","http://utatanebiyori.uzusionet.com/resources/templates");
Rhaco::constant("TEMPLATE_PATH",Rhaco::filepath("/home/utatanebiyori/public_html/resources/templates/"));
Rhaco::constant("CACHE_PATH",Rhaco::filepath("/home/utatanebiyori/public_html/cache/"));
Rhaco::constant("TEMPLATE_CACHE",false);
Rhaco::constant("TEMPLATE_CACHE_TIME","86400");
Rhaco::constant("FEED_CACHE",false);
Rhaco::constant("FEED_CACHE_TIME","10800");
Rhaco::constant("LOG_FILE_LEVEL","error");
Rhaco::constant("LOG_FILE_PATH",Rhaco::filepath("/home/utatanebiyori/public_html/log/"));
Rhaco::constant("LOG_DISP_LEVEL","none");
Rhaco::constant("LOG_DISP_HTML",false);
Rhaco::constant("SESSION_CACHE_LIMITER","nocache");
Rhaco::constant(VAR_SITE_NAME,"Dentsu Underground");
Rhaco::constant(VAR_SITE_MAIL_ADDRESS,"utatanebiyori@uzusionet.com");
Rhaco::constant(VAR_MAIL_ADDRESS,"b.utatane+system@gmail.com");
Rhaco::constant(VAR_COUNTER_MAIL_ADDRESS,"b.utatane+counter@gmail.com");
Rhaco::constant(VAR_WIKI_BACKUP_MAIL_ADDRESS,"b.utatane+wikibackup@gmail.com");
Rhaco::constant(VAR_NOREPLY_MAIL_ADDRESS,"b.utatane+noreply@gmail.com");
Rhaco::constant(VAR_BEFOR_URI,"http://utatanebiyori.uzusionet.com");
Rhaco::constant(VAR_KYUUKOU_URL,"http://kyoumu.office.uec.ac.jp/kyuukou/kyuukou.html");
Rhaco::constant(VAR_WIKI_TOP,"トップ");
Rhaco::constant(VAR_WIKI_MENU,"メニュー");
Rhaco::constant(VAR_SYSTEM_USER_ID,"1");
Rhaco::constant(VAR_GUEST_USER_ID,"2");
Rhaco::constant(VAR_UPLOAD_URL,"resources/uploader/");
Rhaco::constant(VAR_UPLOAD_INTERVAL,"60");
Rhaco::constant(VAR_DOWNLOAD_PASSWORD,"PASSWORD");
Rhaco::constant(VAR_UPLOAD_SIZE_GUEST,"5242880");
Rhaco::constant(VAR_UPLOAD_SIZE_USER,"20971520");
Rhaco::constant("DATABASE_utatanebiyori_HOST","localhost");
Rhaco::constant("DATABASE_utatanebiyori_USER","utatanebiyori");
Rhaco::constant("DATABASE_utatanebiyori_PASSWORD","utatanebiyori");
Rhaco::constant("DATABASE_utatanebiyori_NAME","utatanebiyori");
Rhaco::constant("DATABASE_utatanebiyori_PORT","");
Rhaco::constant("DATABASE_utatanebiyori_ENCODE","UTF8");
Rhaco::constant("DATABASE_utatanebiyori_TYPE","database.controller.DbUtilMySQL");
Rhaco::constant("DATABASE_utatanebiyori_PREFIX","uta_");
Rhaco::constant("APPLICATION_ID",strtoupper(preg_replace("/[\/\:\.]/","",Rhaco::constant("CONTEXT_URL"))));
Rhaco::import("resources.Message");
Rhaco::import("abbr.L");
?>
