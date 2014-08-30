<?php
Rhaco::import('model.Wikis');
Rhaco::import('database.DbUtil');
Rhaco::import("lang.StringUtil");
Rhaco::import("lang.DateUtil");
Rhaco::import("text.RandomString");
Rhaco::import("tag.TemplateFormatter");
Rhaco::import("diff.Diff");

/**
 * Wikiのメニューや目次、本文などをフォーマットする
 * @author SuzukiKouhei
 *
 */
class WikiFormatter
{
  /**
   * トップorメニュー
   */
  function p($pagename){
    if(in_array($pagename, array(Rhaco::constant(VAR_WIKI_TOP), Rhaco::constant(VAR_WIKI_MENU)))) return true;
    return false;
  }

  /**
   * サイドメニューの作成
   * @return unknown_type
   */
  function menu(){
    $db = new DbUtil(Wikis::connection());
    $menu = $db->get(new Wikis(), new C(Q::eq(Wikis::columnWikiName(), Rhaco::constant(VAR_WIKI_MENU))));
    return $menu->text;
  }
  /**
   * ページ一覧のリスト
   * @param $object_list
   * @return unknown_type
   */
  function pageList($object_list = array()){
    $en = false;
    $firstChar = "";
    $result = "";
    $toc = "";
    $indent = 1;
    $id = "";
    foreach($object_list as $object){
      $f = StringUtil::substring($object->wikiName, 0, 1);
      if($firstChar != $f){
        $firstChar = $f;
        $id = RandomString::ascii(8);
        if(!$en){
          $result .= "<ul>\n";
          $toc .= "<div class=\"toc\">\n<ol>\n";
        }
        if($en){
          $result .= "  </ul>\n</li>\n";
          $indent--;
        }
        $en = true;
        $result .= "<li id=\"". $id. "\">". $firstChar ."<ul>\n";
        $toc .= "<li><a href=\"#". $id. "\">". $firstChar ."</a></li>\n";
        $indent++;
      }
      $result .= "    <li><a href=\"". Rhaco::url('wiki'). "/". $object->wikiName. "\">". $object->wikiName. "</a>&nbsp;<sapn class=\"small\">". $this->passage($object->updatedAt). "</span></li>\n";
    }
    $toc .= "</ol>\n</div>\n<h3>". _("ページ一覧"). "</h3>";
    $result .= str_repeat("</ul>\n",$indent);
    return ($en) ? substr($toc. $result,0,-1) : $toc. $result;
  }
  /**
   * HTMLのタイトル
   */
  function header($wikiName){
    $wiki_name_array = explode("/", $wikiName);
    $values = "";
    $results = array();
    foreach($wiki_name_array as $key => $value){
      $values = (empty($values))? $value : implode("/", array($values, $value));
      $results[] = "<a href=\"". Rhaco::url('wiki'). "/". $values. "\">". $value. "</a>";
    }
    return implode(" :: ", $results);
  }
  /**
   * タイトル
   */
  function title($wikiName){
    return str_replace("/", " :: ", $wikiName);
  }
  /**
   * 整形後のWikiに、目次を付加する
   * @param unknown_type $src
   * @return unknown_type
   */
  function body($text){
    $toc = "";
    $result = "";
    $indent = 0;
    $en = false;
    foreach(explode("\n",$text) as $value){
      if(preg_match("/^<h(\d)>(.+)<\/h\d>$/",$value,$match)){
        if(!$en){
          $toc .= "<div class=\"toc\">\n<ol>";
        }
        $en = true;
        $anchor = "toc_". RandomString::ascii(8);
        $value = "<h". $match[1]. " id=\"". $anchor. "\">". $match[2]. "</h". $match[1]. ">";
        if($match[1] == 3){
          if($indent == 3) $toc .= "</li>";
          if($indent == 4) $toc .= "</li></ol></li>";
          if($indent == 5) $toc .= "</li></ol></li></ol></li>";
          $indent = $match[1];
          $toc .= "<li><a href=\"#". $anchor. "\">". $match[2] ."</a>";
        }
        if($match[1] == 4){
          if($indent == 4) $toc .= "</li>";
          if($indent == 3) $toc .= "<ol>";
          if($indent == 5) $toc .= "</li></ol></li>";
          $indent = $match[1];
          $toc .= "<li><a href=\"#". $anchor. "\">". $match[2] ."</a>";
        }
        if($match[1] == 5){
          if($indent == 5) $toc .= "</li>";
          if($indent == 3) $toc .= "<ol><ol>";
          if($indent == 4) $toc .= "<ol>";
          $indent = $match[1];
          $toc .= "<li><a href=\"#". $anchor. "\">". $match[2] ."</a>";
        }
      }
      $result .= $value. "\n";
    }
    if(!empty($toc)){
      $toc .= str_repeat("</li></ol>",$indent-2);
      $toc .= "\n</div>\n";
    }
    return $toc. $result;
  }
  /**
   * Wikiの整形ルールの文字を消す
   */
  function nf($src){
    return TemplateFormatter::striptags($src);
  }

  /**
   * 検索結果をハイライトして、見つかった単語の前後$span文字だけを表示する。
   *
   * @param string $text 検索結果文字列
   * @param string $query 検索クエリ。スペースを挟んで複数でもOK。
   * @param int $span 単語の前後$span文字を抜き出す
   * @return string ハイライト済みHTML
   */
  function hilight($text, $query, $span = 45) {
    $hilighted = false;
    if ($query) {
      $colors = array('#FFFF75', '#75FFFF', '#FFA4C6');
      $query = str_replace('　', ' ', $query);
      $q = preg_split('/[\s,]+/', $query, -1, PREG_SPLIT_NO_EMPTY);

      $text = str_replace('&amp;', '&', htmlspecialchars($text, ENT_QUOTES));
      $orig = $text;
      foreach ($q as $index => $value) {
        $color = $colors[$index % 3];
        $value = str_replace('&amp;', '&', htmlspecialchars($value, ENT_QUOTES));
        $pattern = '/(' . preg_quote($value, '/') . ')/i';
        $text = preg_replace($pattern, '<span style="background-color:' . $color . '">$1</span>', $text);
      }
      $hilighted = ($orig != $text);
    }
    if (!$hilighted) {
      return str_replace('&amp;', '&', htmlspecialchars(mb_strimwidth($text, 0, $span * 2, '…'), ENT_QUOTES));
    }else{
      // spanとspanの間を抜く
      $text = preg_replace('/(<\/span>[^<>]{' . $span . '})[^<>]+([^<>]{' . $span . '}<span)/', '$1…$2', $text);
      // 頭を抜く
      $text = preg_replace('/^[^<>]+([^<>]{' . $span . '}<span)/', '…$1', $text);
      // 後ろを抜く
      $text = preg_replace('/(<\/span>[^<>]{' . $span . '})[^<>]+$/', '$1…', $text);
      return $text;
    }
  }

  /**
   * バックアップ一覧のリスト
   * @param $object_list
   * @return unknown_type
   */
  function backupList($object_list = array()){
    $en = false;
    $first_char = "";
    $backup_array = array();
    $result = "<ul>\n";
    $toc = "<div class=\"toc\">\n<ol>\n";
    $indent = 1;
    $id = "";
    foreach($object_list as $object){
      if(empty($backup_array[$object->factWikiId->wikiName])){
        $backup_array[$object->factWikiId->wikiName] = 1;
      }else{
        $backup_array[$object->factWikiId->wikiName]++;
      }
    }
    foreach($backup_array as $key => $value){
      $f = StringUtil::substring($key, 0, 1);
      if($first_char != $f){
        $first_char = $f;
        $id = RandomString::ascii(8);
        if($en){
          $result .= "  </ul>\n</li>\n";
          $indent--;
        }
        $en = true;
        $result .= "<li id=\"". $id. "\">". $first_char ."<ul>\n";
        $toc .= "<li><a href=\"#". $id. "\">". $first_char ."</a></li>\n";
        $indent++;
      }
      $result .= "    <li><a href=\"". Rhaco::url('wiki/backup/'). $key. "\">". $key. "</a>&nbsp;<sapn class=\"small\">". $value. "件のバックアップ</span></li>\n";
    }
    $toc .= "</ol>\n</div>\n<h3>". _("バックアップ一覧"). "</h3>";
    $result .= str_repeat("</ul>\n",$indent);
    return ($en) ? substr($toc. $result,0,-1) : $toc. $result;
  }

  /**
   * 差分
   * @param $object_list
   * @param $backup_id
   * @return unknown_type
   */
  function diff($object_list = array(), $backup_id){
    $en = false;
    $result = "";
    $before = "";
    $after = "";
    foreach($object_list as $object){
      if($object->id == $backup_id){
        $diff = "<pre class=\"diff\">". Diff::diffStyleToCss($object->text). "</pre>\n";
        $en = true;
        continue;
      }
      if($en){
        $after = "<a href=\"". Rhaco::url('wiki/diff/') . $object->id. "\" title=\"". $this->jdate($object->createdAt). "\">次の差分</a>&nbsp;";
        break;
      }else{
        $before = "<a href=\"". Rhaco::url('wiki/diff/') . $object->id. "\" title=\"". $this->jdate($object->createdAt). "\">前の差分</a>&nbsp;";
      }
    }
    $result .= $before. $after;
    $result .= "<ul>\n";
    $result .= "<li>追加された行は<span class=\"diff-added\">この色</span>です。</li>\n";
    $result .= "<li>削除された行は<span class=\"diff-removed\">この色</span>です。</li>\n";
    $result .= "</ul>\n";
    $result .= $diff;
    return $result;
  }

  /**
   * 現在との差分
   * @param $object_list
   * @param $backup_id
   * @return unknown_type
   */
  function nowdiff($object_list = array(), $now, $backup_id){
    $en = false;
    $result = "";
    $before = "";
    $after = "";
    foreach($object_list as $object){
      if($object->id == $backup_id){
        $nowdiff = "<pre class=\"diff\">". Diff::diffStyleToCss(Diff::doDiff(Diff::diffMarkerRemove($object->text), $now->text)). "</pre>\n";
        $en = true;
        continue;
      }
      if($en){
        $after = "<a href=\"". Rhaco::url('wiki/nowdiff/') . $object->id. "\" title=\"". $this->jdate($object->createdAt). "\">次の現在との差分</a>&nbsp;";
        break;
      }else{
        $before = "<a href=\"". Rhaco::url('wiki/nowdiff/') . $object->id. "\" title=\"". $this->jdate($object->createdAt). "\">前の現在との差分</a>&nbsp;";
      }
    }
    $result .= $before. $after;
    $result .= "<ul>\n";
    $result .= "<li>追加された行は<span class=\"diff-added\">この色</span>です。</li>\n";
    $result .= "<li>削除された行は<span class=\"diff-removed\">この色</span>です。</li>\n";
    $result .= "</ul>\n";
    $result .= $nowdiff;
    return $result;
  }

  /**
   * バックアップのソース
   * @param $object_list
   * @param $backup_id
   * @return unknown_type
   */
  function source($object_list = array(), $backup_id){
    $en = false;
    $result = "";
    $before = "";
    $after = "";
    foreach($object_list as $object){
      if($object->id == $backup_id){
        $source = "<pre class=\"diff\">". Diff::diffMarkerRemove($object->text). "</pre>\n";
        $en = true;
        continue;
      }
      if($en){
        $after = "<a href=\"". Rhaco::url('wiki/source/') . $object->id. "\" title=\"". $this->jdate($object->createdAt). "\">次のソース</a>&nbsp;";
        break;
      }else{
        $before = "<a href=\"". Rhaco::url('wiki/source/') . $object->id. "\" title=\"". $this->jdate($object->createdAt). "\">前のソース</a>&nbsp;";
      }
    }
    $result .= $before. $after;
    $result .= $source;
    return $result;
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

  /**
   * ページ下部の更新時刻
   * @param $time
   * @return unknown_type
   */
  function modified($time){
    //$time = DateUtil::formatFull($time);
    $fresh_time = 5; // 5min
    $pg_passage = ($time != 0) ? $this->passage($time) : '';

    static $units = array('分'=>60, '時間'=>24, '日'=>1);
    $time = max(0, (time() - $time) / 60); // minutes
    foreach ($units as $unit=>$card) {
      if ($time < $card) break;
      $time /= $card;
    }
    $time = floor($time);
    if ($card == "60" && $time <= $fresh_time) {
      return "今さっき更新\n";
    }elseif ($card == "1" && $time <= "2"){
      if ($time == "1"){
        return "昨日更新\n";
      }elseif ($time == "2"){
        return "一昨日更新\n";
      }
    }else {
      if ($pg_passage){
        return "だいたい" . $pg_passage . "に更新\n";
      }else {
        return "今さっき更新\n";
      }
    }
    return $pg_passage;
  }
  /**
   * 経過時間を取得する
   * @param $time
   * @param $paren
   * @return unknown_type
   */
  function passage($time, $paren = TRUE)
  {
    static $units = array('分'=>60, '時間'=>24, '日'=>1);

    $time = max(0, (time() - $time) / 60); // minutes

    foreach ($units as $unit=>$card) {
      if ($time < $card) break;
      $time /= $card;
    }
    $time = floor($time) . $unit;

    return $paren ? $time . '前' : $time;
  }
}