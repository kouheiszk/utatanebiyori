<?php
Rhaco::import('view.Utatane');
Rhaco::import('model.Counter');
Rhaco::import('network.mail.Mail');

class UtataneCounter extends Utatane
{
  /**
   * カウンタ
   *
   */
  function counter(){
    $ip = $_SERVER["REMOTE_ADDR"];
    $now = time();
    $year = date('Y', $now);
    $month = date('m', $now);
    $day = date('d', $now);

    $result = array();
    $result['today'] = 0;
    $result['yesterday'] = 0;
    $result['total'] = 0;

    if(UtataneCounter::isRobot()){
      return $result;
    }

    $find = false;

    $db = new DbUtil(Counter::connection());
    $criteria = new C(Q::orderDesc(Counter::columnId()));
    $counter = $db->get(new Counter(), $criteria);
    if(Variable::istype('Counter', $counter)){
      if($counter->year == $year && $counter->month == $month && $counter->day == $day){
        //最終アクセスが今日だった場合
        if(strpos($counter->host, "\n")){
          $ips = explode("\n", $counter->host);
        }else{
          $ips = array($counter->host);
        }
        foreach($ips as $key => $registed_ip){
          if($registed_ip == $ip) $find = true;
        }
        if(!$find){
          $ips[] = $ip;
          $counter->setHost(implode("\n", $ips));
          $counter->setToday($counter->today + 1);
          $counter->setTotal($counter->total + 1);
          $counter->save();
        }
      }else{
        //履歴のメール送信
        UtataneCounter::sendmail($counter->year.$counter->month.$counter->day, $counter->host);
        if($counter->year == date('Y', DateUtil::addDay($now,-1)) && $counter->month == date('m', DateUtil::addDay($now,-1)) && $counter->day == date('d', DateUtil::addDay($now,-1))){
          //最終アクセスが昨日だった場合
          $today = $counter->today;
          $total = $counter->total;
          $counter = new Counter();
          $counter->setYear($year);
          $counter->setMonth($month);
          $counter->setDay($day);
          $counter->setYesterday($today);
          $counter->setToday(1);
          $counter->setTotal($total + 1);
          $counter->setHost($ip);
          $counter->save();
        }else{
          //最終アクセスが二日以上前だった場合
          $total = $counter->total;
          $counter = new Counter();
          $counter->setYear($year);
          $counter->setMonth($month);
          $counter->setDay($day);
          $counter->setYesterday(0);
          $counter->setToday(1);
          $counter->setTotal($total + 1);
          $counter->setHost($ip);
          $counter->save();
        }
      }
      $result['today'] = $counter->today;
      $result['yesterday'] = $counter->yesterday;
      $result['total'] = $counter->total;
    }
    return $result;
  }

  /**
   * 履歴メールの送信
   */
  function sendmail($date = "", $hosts = ""){
    // メールを送る
    $mail  = new Mail(Rhaco::constant('SITE_MAIL_ADDRESS'), Rhaco::constant('SITE_NAME'));
    $mail->to(Rhaco::constant('COUNTER_MAIL_ADDRESS'));
    $mail->subject($date);
    $mail->message($hosts);
    $mail->send();
  }

  /**
   * 検索エンジンのロボットかどうか
   */
  function isRobot($ua = null){
    if(empty($ua)){
        $ua = $_SERVER['HTTP_USER_AGENT'];
    }
    $robot="/(ICC-Crawler|Teoma|Y!J-BSC|Pluggd\/Nutch|psbot|CazoodleBot|
        Googlebot|Antenna|BlogPeople|AppleWebKitOpenbot|NaverBot|PlantyNet|livedoor|
        msnbot|FlashGet|WebBooster|MIDown|moget|InternetLinkAgent|Wget|InterGet|WebFetch|
        WebCrawler|ArchitextSpider|Scooter|WebAuto|InfoNaviRobot|httpdown|Inetdown|Slurp|
        Spider|^Iron33|^fetch|^PageDown|^BMChecker|^Jerky|^Nutscrape|Baiduspider|TMCrawler)/m";
    if(preg_match($robot,$ua)){
        return true;
    }else{
        return false;
    }
  }
}
