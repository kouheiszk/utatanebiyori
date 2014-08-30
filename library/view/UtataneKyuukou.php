<?php
Rhaco::import('view.Utatane');
Rhaco::import('tag.SimpleScrape');

class UtataneKyuukou extends Utatane
{
  function index(){
    //休講情報の取得
    $this->setVariable('kyuukou', $this->kyuukouLimit());
    return $this->parser('kyuukou.html');
  }

  /**
   * 休講情報をテーブルで整形して返す
   */
  function kyuukou(){
    $en = false;
    $result = "";
    $kyuukous = UtataneKyuukou::getKyuukou();
    $result .= "<table>";
    foreach($kyuukous as $kyuukou){
      $result .= "<tr>";
      if(!$en){
        foreach($kyuukou as $key_head => $value){
          $result .= "<th>". $key_head. "</th>";
        }
        $result .= "</tr>\n<tr>";
        $en = true;
      }
      foreach($kyuukou as $value){
        $result .= "<td>". $value. "</td>";
      }
      $result .= "</tr>\n";
    }
    $result .= "</table>\n";
    return $result;
  }

  /**
   * 休講情報を指定件数テーブルで整形して返す
   */
  function kyuukouLimit($limit = null){
    if(empty($limit)){
      return UtataneKyuukou::kyuukou();
    }
    $en = false;
    $more = false;
    $count = 0;
    $result = "";
    $kyuukous = UtataneKyuukou::getKyuukou();
    $result .= "<table>";
    foreach($kyuukous as $key => $kyuukou){
      $result .= "<tr>";
      if(!$en){
        foreach($kyuukou as $key_head => $value){
          $result .= "<th>". $key_head. "</th>";
        }
        $result .= "</tr>\n<tr>";
        $en = true;
      }
      if(++$count > $limit){
        $more = true;
        continue;
      }
      foreach($kyuukou as $value){
        $result .= "<td>". $value. "</td>";
      }
      $result .= "</tr>\n";
    }
    $result .= "</table>\n";

    if($more){
      $result .= "<span class=\"fright\"><a href=\"". Rhaco::url('kyuukou'). "\">もっと見る</a></span>\n";
    }
    return $result;
  }

  function getUserClass($user_id = null){
    return "";
  }

  /**
   * 休講情報を配列で取得
   */
  function getKyuukou(){
    $en = false;
    $result = array();
    $head = array();
    $url = Rhaco::constant('KYUUKOU_URL');
    // Scrape準備
    $src = SimpleScrape::loadUrl($url);
    $src->selectTag('tr');
    foreach($src->getValues() as $key_tr => $tr){
      $src_tr = SimpleScrape::loadText($tr);
      if(!$en){
        $src_tr->selectTag('b');
        //$result[$key_tr] = array();
        foreach($src_tr->getValues() as $key_td => $td){
          $head[$key_td] = $td;
          //$result[$key_tr][$key_td] = $td;
        }
        $en = true;
      }else{
        $src_tr->selectTag('td');
        $result[$key_tr] = array();
        foreach($src_tr->getValues() as $key_td => $td){
          $result[$key_tr][$head[$key_td]] = $td;
        }
      }
    }
    return $result;
  }
}

