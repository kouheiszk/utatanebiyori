<?php
require dirname(__FILE__). '/__init__.php';
Rhaco::import('generic.Urls');
Rhaco::import('model.Users');
Rhaco::import('model.Wikis');
Rhaco::import('model.LoginCondition');
Rhaco::import('UtataneFormatter');
Rhaco::import('UploaderFormatter');
Rhaco::import('WhisperFormatter');
Rhaco::import('WikiFormatter');
Rhaco::import('text.WikiCode');

$db = new DbUtil(Users::connection());
RequestLogin::silent(new LoginCondition($db, new Users()));

$parser = Urls::parser(array(
    '^(?:index\.html)?$' => array('class' => 'view.Utatane', 'method' => 'index'),
    
	'^api' => array('class' => 'view.UtataneApi', 'method' => 'index'),

    '^home$' => array('class' => 'view.UtataneStatus', 'method' => 'index'),
    '^friends$' => array('class' => 'view.UtataneFriend', 'method' => 'following'),
    '^followers$' => array('class' => 'view.UtataneFriend', 'method' => 'followers'),

    '^status\/update$' => array('class' => 'view.UtataneStatus', 'method' => 'update'),
    '^status\/update\/ajax$' => array('class' => 'view.UtataneStatus', 'method' => 'update_ajax'),
    '^status\/destroy\/(\d+)$' => array('class' => 'view.UtataneStatus', 'method' => 'destroy'),

    '^public_timeline$' => array('class' => 'view.UtataneStatus', 'method' => 'public_timeline'),

    '^delete\/(\d+)$' => array('class' => 'view.UtataneStatus', 'method' => 'delete'),
    '^reply\/(\d+)$' => array('class' => 'view.UtataneStatus', 'method' => 'reply'),

    '^signup$' => array('class' => 'view.UtataneUser', 'method' => 'signup'),
    '^account\/create$' => array('class' => 'view.UtataneUser', 'method' => 'create'),
    '^activate\/(.+?)$' => array('class' => 'view.UtataneUser', 'method' => 'activate'),

    '^user\/archive$' => array('class' => 'view.UtataneStatus', 'method' => 'archive'),
    '^user\/reply$' => array('class' => 'view.UtataneStatus', 'method' => 'reply'),
    '^user\/replies$' => array('class' => 'view.UtataneStatus', 'method' => 'replies'),

    '^account\/settings$' => array('class' => 'view.UtataneUser', 'method' => 'settings'),
    '^account\/account$' => array('class' => 'view.UtataneUser', 'method' => 'account'),
    '^account\/picture$' => array('class' => 'view.UtataneUser', 'method' => 'picture'),


    '^friendships\/create\/(\d+)$' => array('class' => 'view.UtataneFriend', 'method' => 'create'),
    '^friendships\/destroy\/(\d+)$' => array('class' => 'view.UtataneFriend', 'method' => 'destroy'),

    '^friend_requests$' => array('class' => 'view.UtataneFriend', 'method' => 'requests'),
    '^friend_requests\/accept\/(\d+)$' => array('class' => 'view.UtataneFriend', 'method' => 'accept'),
    '^friend_requests\/deny\/(\d+)$' => array('class' => 'view.UtataneFriend', 'method' => 'deny'),

    '^login$' => array('class' => 'view.UtataneUser', 'method' => 'login'),
    '^sessions$' => array('class' => 'view.UtataneUser', 'method' => 'login'),
    '^logout$' => array('class' => 'view.UtataneUser', 'method' => 'logout'),

    '^kyuukou$' => array('class' => 'view.UtataneKyuukou', 'method' => 'index'),

    '^user\/([a-zA-Z0-9]+)$'            => array('class' => 'view.UtataneUser', 'method' => 'user'),
    '^user\/([a-zA-Z0-9]+)\/friends$'   => array('class' => 'view.UtataneFriend', 'method' => 'following'),
    '^user\/([a-zA-Z0-9]+)\/followers$' => array('class' => 'view.UtataneFriend', 'method' => 'followers'),

    //WHISPER
    '^whisper(?:\/)?$'                  => array('class' => 'view.UtataneWhisper', 'method' => 'index'),
    '^whisper\/public_timeline$'        => array('class' => 'view.UtataneWhisper', 'method' => 'public_timeline'),
    '^whisper\/status\/update$'         => array('class' => 'view.UtataneWhisper', 'method' => 'update'),
    '^whisper\/status\/reply\/(\d+)$'   => array('class' => 'view.UtataneWhisper', 'method' => 'reply'),
    '^whisper\/status\/delete\/(\d+)$'  => array('class' => 'view.UtataneWhisper', 'method' => 'delete'),

    //WIKI
    '^wiki(?:\/)?$'             => array('class' => 'view.UtataneWiki', 'method' => 'index'),
    '^wiki\/list$'              => array('class' => 'view.UtataneWiki', 'method' => '_list'),
    '^wiki\/search$'            => array('class' => 'view.UtataneWiki', 'method' => 'search'),
    '^wiki\/attach/(.+?)$'      => array('class' => 'view.UtataneWiki', 'method' => 'attach'),
    '^wiki\/backuplist$'        => array('class' => 'view.UtataneWiki', 'method' => 'backuplist'),
    '^wiki\/backup/(.+?)$'      => array('class' => 'view.UtataneWiki', 'method' => 'backup'),
    '^wiki\/diff/(\d+)$'        => array('class' => 'view.UtataneWiki', 'method' => 'diff'),
    '^wiki\/nowdiff/(\d+)$'     => array('class' => 'view.UtataneWiki', 'method' => 'nowdiff'),
    '^wiki\/source/(\d+)$'      => array('class' => 'view.UtataneWiki', 'method' => 'source'),
    '^wiki\/history$'           => array('class' => 'view.UtataneWiki', 'method' => 'history'),
    '^wiki\/new(?:\/(.+?))?$'   => array('class' => 'view.UtataneWiki', 'method' => 'create'),
    '^wiki\/edit(?:\/(.+?))?$'  => array('class' => 'view.UtataneWiki', 'method' => 'update'),
    '^wiki\/(.+?)$'             => array('class' => 'view.UtataneWiki', 'method' => 'page'),

    //UPLOADER
    '^uploader(?:\/)?$'           => array('class' => 'view.UtataneUploader', 'method' => 'index'),
    '^uploader\/upload$'          => array('class' => 'view.UtataneUploader', 'method' => 'create'),
    '^uploader\/upload_success$'  => array('class' => 'view.UtataneUploader', 'method' => 'uploadSuccess'),
    '^uploader\/detail\/(.+?)$'   => array('class' => 'view.UtataneUploader', 'method' => 'detail'),
    '^uploader\/download\/(.+?)$' => array('class' => 'view.UtataneUploader', 'method' => 'download'),
), $db, 'filter.HtmlCsrfFilter', 'filter.HtmlOneTimeTicketFilter');

if(RequestLogin::isLoginSession()){
  $parser->setVariable('login', RequestLogin::getLoginSession());
}else{
  $parser->setVariable('login', Users::getGuestUser($db));
}

if(isset($_SESSION['_csrfid'])) $parser->setVariable('_csrfid', $_SESSION['_csrfid']);
if(isset($_SESSION['_onetimeticket'])) $parser->setVariable('_onetimeticket', $_SESSION['_onetimeticket']);

$parser->setVariable('uf', new UtataneFormatter);
$parser->setVariable('upf', new UploaderFormatter);
$parser->setVariable('wf', new WikiFormatter);
$parser->setVariable('whf', new WhisperFormatter);
$parser->setVariable('wc', new WikiCode);
$parser->write();