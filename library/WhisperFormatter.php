<?php
Rhaco::import("lang.StringUtil");
Rhaco::import("lang.DateUtil");
Rhaco::import("text.RandomString");

/**
 * Whisperのフォーマッタ
 *
 * @author SuzukiKouhei
 */
class WhisperFormatter
{
  /**
   * コメントの整形
   *
   * @param $status
   * @return unknown_type
   */
  function f($status, $users = array()){
    $replied_users = array();
    $result = "";
    while($status{0} == '@' && preg_match('/^@([A-Za-z0-9]+)\s(.*)$/', $status, $match)){
      $user_id = $match[1];
      $user = $users[$match[1]];
      if(Variable::istype('Users', $user)){
        $result .= "@<a class=\"whisp-url username\" href=\"". Rhaco::url('whisper/user'). "/". $user_id. "\" rel=\"nofollow\">". $users[$user_id]->userName . "</a>&nbsp;";
      }
      $status = preg_replace('/^@([A-Za-z0-9]+)\s/', '', $status);
    }
    $result .= $status;
    return $result;
  }

  function datef($time){
    return date("Y/m/d H:i:s", $time);
  }

  /**
   * 更新時刻
   * @param $time
   * @return unknown_type
   */
  function modified($time){
    $fresh_time = 5; // 5min
    $default = date("Y/m/d H:i:s", $time);
    $passage = ($time != 0) ? $this->passage($time) : '';

    static $units = array('分'=>60, '時間'=>24, '日'=>1);
    $time = max(0, (time() - $time) / 60); // minutes
    foreach ($units as $unit=>$card) {
      if ($time < $card) break;
      $time /= $card;
    }
    $time = floor($time);
    if($card == 60){
      if($time <= $fresh_time){
        return "今さっき";
      }else{
        return $passage;
      }
    }elseif($card == 24){
      return $passage;
    }
    return $default;
  }

  /**
   * 経過時間を取得する
   * @param $time
   * @param $paren
   * @return unknown_type
   */
  function passage($time, $paren = TRUE)
  {
    $units = array('分'=>60, '時間'=>24, '日'=>1);
    $time = max(0, (time() - $time) / 60); // minutes

    foreach($units as $unit => $card){
      if ($time < $card) break;
      $time /= $card;
    }
    $time = floor($time). $unit;

    return $paren ? $time. '前' : $time;
  }
}