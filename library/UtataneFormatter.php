<?php
Rhaco::import('model.Users');
Rhaco::import('database.DbUtil');
Rhaco::import('view.UtataneCounter');

class UtataneFormatter
{
  function comment($str, $id){
    if($str{0} == '>' && preg_match('/^>>(.+?)\s/', $str, $match ) && $id){
      $user_name = $this->getUserNamefromUserId($match[1]);
      $str = preg_replace('/^&gt;&gt;([A-Za-z0-9]+)/', '<a href="'.Rhaco::url().'$1">&gt;&gt;'. $user_name. '</a>', htmlspecialchars($str, ENT_QUOTES));
    }
    return $str;
  }

  /**
   * 変換時間を取得する
   */
  function getCovertTime(){
    $time = microtime(true) - (float)Rhaco::getVariable("RHACO_CORE_LOGGER_START_TIME");
    return sprintf("%5fsec", $time);
  }

  /**
   * 画像の縮小サイズを得る
   */
  function xLength($x, $y, $order){
    return ($x > $y) ? $order : ($x / ($y / $order));
  }
  function yLength($x, $y, $order){
    return ($y > $x) ? $order : ($y / ($x / $order));
  }

  /**
   * 拡張子からファイルの種類を判別しクラスを返す
   */
  function fileClass($str){
    $file = pathinfo($str);
    $type = "";
    $extension = strtolower($file['extension']); //拡張子
    switch($extension){
      case "jpg": $type = "image"; break;
      case "gif": $type = "image"; break;
      case "png": $type = "image"; break;
      case "bmp": $type = "image"; break;
      case "doc": $type = "word"; break;
      case "docx": $type = "word"; break;
      case "xls": $type = "excel"; break;
      case "xlsx": $type = "excel"; break;
      case "zip": $type = "archive"; break;
      case "tar": $type = "archive"; break;
      case "tar": $type = "archive"; break;
      case "gz": $type = "archive"; break;
      case "pdf": $type = "pdf"; break;
    }
    return (!empty($type))? 'extension-'. $type : 'extension';
  }


  function counter(){
    $counter = UtataneCounter::counter();
    $result  = "<h3>カウンター</h3>";
    $result .= "Today&nbsp;:&nbsp;<span class=\"green\">". $counter['today']. "</span><br />";
    $result .= "Yesterday&nbsp;:&nbsp;<span class=\"green\">". $counter['yesterday']. "</span><br />";
    $result .= "Total&nbsp;:&nbsp;<span class=\"green\">". $counter['total']. "</span>";
    return $result;
  }

  function date($time, $br = false){
    return ($br)? date("Y/m/d", $time). "<br />". date("H:i:s", $time) : date("Y/m/d H:i:s", $time);
  }

  /**
   * 時刻の日本表記
   * @param $time
   * @return unknown_type
   */
  function jdate($time){
    $week_array = array("日","月","火","水","木","金","土");
    return date("Y/m/d", $time). " (". $week_array[DateUtil::weekday(date("Ymd", $time))]. ") ". date("H:i:s", $time);
  }

}