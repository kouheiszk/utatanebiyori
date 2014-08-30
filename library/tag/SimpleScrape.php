<?php
Rhaco::import('tag.model.SimpleTag');
Rhaco::import('network.http.Http');

/**
 * スクレイピング
 *
 * @author goungoun
 * @license New BSD License
 * @copyright Copyright 2006- rhaco project. All rights reserved.
 */
class SimpleScrape{

  /**
   * 処理対象のSimpleTagの配列
   *
   * @var array
   */
  var $_tags = array();

  /**
   * コンストラクタ
   *
   * @return SimpleScrape
   */
  function SimpleScrape($p1=null){
    /***
     * $html = <<< __HDOC__
     * <center>
     *   <div id="aaa1"& gt;あああ</div>
     *   <div id="aaa2">あああ</div& gt;
     *   <p>
     *     <div id="bbb"& gt;あああ</div>
     *     <p>
     *       <div id="ccc"& gt;あああ</div>
     *       <div class="c_ccc" id="01"& gt;あああ</div>
     *       <div class="c_ccc" id="02"& gt;あああ</div>
     *       あああ
     *     </p>
     *     <div class="c_ccc" id="03">
     *       <div class="c_ccc" id="04"& gt;あああ</div>
     *       <div class="c_ccc xxx" id="05"& gt;あああ</div>
     *       <div class="xxx c_ccc xxx" id="06"& gt;あああ</div>
     *       <div class="xxx
     * c_ccc
     *  xxx" id="07"& gt;あああ</div>
     *     </div>
     *     あああ
     *   </p>
     *   <div id="ddd">あああ</div>
     * </center>
     * __HDOC__;
     *
     * $scr1 = SimpleScrape::loadText($html);
     * $scr2 = SimpleScrape::loadScrape($scr1);
     * eq(count($scr1->getSimpleTags()), count($scr2->getSimpleTags()));
     *
     * // 全ての <div class="c_ccc"> を取得
     * $scr1->selectTagClass('div', 'c_ccc');
     * eq(7, count($scr1->getSimpleTags()));
     *
     * // 唯一の <div id="04"> を取得
     * $scr2->selectTagId('div', '04');
     * eq(1, count($scr2->getSimpleTags()));
     *
     * // SimpleXML と挙動が一致してるか確認
     * if(class_exists('SimpleXMLElement')){
     * $xml = new SimpleXMLElement($html);
     * $ret_xml1 = $xml->xpath('//div[contains(concat(" ",@class," ")," c_ccc ")]');
     * eq(count($ret_xml1), count($scr1->getSimpleTags()));
     * $ret_xml2 = $xml->xpath('//div[@id="04"]');
     * eq(count($ret_xml2), count($scr2->getSimpleTags()));
     * }
     *
     */
    if($p1 === null) return;

    // SimpleScrape
    if(Variable::istype("SimpleScrape",$p1)){
      $this->_tags = $p1->getSimpleTags();
      return;
    }
  }

  /**
   * SimpleScrape生成:複製する
   *
   * @static
   * @param SimpleScrape $scr
   * @return SimpleScrape
   */
  function loadScrape($scr){
    /*** #viewing */
    $var = new SimpleScrape($scr);
    return $var;
  }

  /**
   * SimpleScrape生成:文字列から生成
   *
   * @static
   * @param string $str
   * @return SimpleScrape
   */
  function loadText($str){
    /*** #viewing */
    $tag = new SimpleTag('root', '<root>'.$str.'</root>');
    $var = new SimpleScrape();
    $var->setSimpleTag($tag);
    return $var;
  }

  /**
   * SimpleScrape生成:指定URLからGETで取得したコンテンツで生成
   *
   * @static
   * @param string $url
   * @param array  $headers
   * @param int  $timeout sec
   * @return SimpleScrape
   */
  function loadUrl($url, $headers=array(), $timeout=5){
    /*** #viewing */
    $html = Http::get($url, $headers, $timeout);
    $html = StringUtil::encode($html);
    $var = SimpleScrape::loadText($html);
    return $var;
  }

  /**
   * 指定タグを抽出する。
   *
   * @param string    $tag_name    抽出するタグ名
   * @param string|null $para_name     抽出条件 パラメータ名
   * @param string|null $value       抽出条件 パラメータ値
   * @param bool    $recursive_flg   再帰抽出するか？
   * @param bool    $rex_flg     パラメータ値を正規表現で評価するか？
   * @return SimpleScrape
   */
  function selectTag($tag_name, $para_name=null, $value=null, $recursive_flg=true, $rex_flg=false){
    /*** #viewing */
    $this->_tags = $this->_select($this->_tags, $tag_name, $para_name, $value, $recursive_flg, $rex_flg);
    return $this;
  }

  /**
   * 指定タグ・IDを持つタグを抽出する。
   *
   * @param string $tag_name    抽出するタグ名
   * @param string $id_name     抽出するID名
   * @param bool   $recursive_flg 再帰抽出するか？（IDはユニークなので、再帰しないがデフォルト）
   * @return SimpleScrape
   */
  function selectTagId($tag_name, $id_name, $recursive_flg=false){
    /*** #viewing */
    $this->_tags = $this->_select($this->_tags, $tag_name, 'id', $id_name, $recursive_flg, false);
    return $this;
  }

  /**
   * 指定タグ・Classを持つタグを抽出する。
   *
   * @param string $tag_name    抽出するタグ名
   * @param string $class_name  抽出するClass名
   * @param bool   $recursive_flg 再帰抽出するか？
   * @return SimpleScrape
   */
  function selectTagClass($tag_name, $class_name, $recursive_flg=true){
    /*** #viewing */
    $value = '/(^|\s)' . $class_name . '($|\s)/';
    $this->_tags = $this->_select($this->_tags, $tag_name, 'class', $value, $recursive_flg, true);
    return $this;
  }

  /**
   * 空か？
   *
   * @return bool
   */
  function isEmpty(){
    /*** #viewing */
    if(count($this->_tags) === 0) return true;
    return false;
  }

  /**
   * 値を取得する。
   *
   * @param int $idx
   * @return string|null
   */
  function getValue($idx=0){
    /*** #viewing */
    $arr = $this->getValues();
    if(isset($arr[$idx])) return $arr[$idx];
    return null;
  }

  /**
   * 全ての値を取得する。
   *
   * @return array
   */
  function getValues(){
    /*** #viewing */
    $ans = array();
    foreach($this->_tags as $tag){
      $ans[] = $tag->getValue();
    }
    return $ans;
  }

  /**
   * 保持されているタグを取得
   *
   * @return unknown
   */
  function getSimpleTags(){
    /*** #viewing */
    return $this->_tags;
  }

  /**
   * 処理対象とするタグをセット
   *
   * @param SimpleTag $tag
   */
  function setSimpleTag($tag){
    /*** #viewing */
    $this->_tags = array($tag);
  }

  /**
   * 処理対象のタグを追加する。
   *
   * @param SimpleScrape $scr
   */
  function add($scr)
  {
    /*** #viewing */
    $this->_tags = array_merge($this->_tags, $scr->getSimpleTags());
  }

  /**
   * タグ名 が $tagName で パラメータ名 が $parameterId で パラメータ値 が $value のタグを全て抽出する。
   *
   * @param SimpleTag $tag    配列でも可
   * @param string $tagName   抽出条件 タグ名
   * @param string $parameterId 抽出条件 パラメータ名
   * @param string $value     抽出条件 パラメータ値
   * @param bool   $recursive   再帰抽出するか？
   * @param bool   $value_rex   パラメータ値を正規表現で評価するか？
   * @return array        SimpleTag の配列
   */
  function _select($tag, $tagName, $parameterId=null, $value=null, $recursive=null, $value_rex=null)
  {
    /*** #viewing */
    if (is_array($tag)) {
      $ret = array();
      foreach ($tag as $item) {
        $ret = array_merge($ret, $this->_select($item, $tagName, $parameterId, $value, $recursive, $value_rex));
        if (!$recursive && count($ret) === 1) break;
      }
      return $ret;
    }
    return $this->__select($tag, $tagName, $parameterId, $value, $recursive, $value_rex);
  }

  function __select($tag, $tagName, $parameterId, $value, $recursive, $value_rex)
  {
    /*** #viewing */
    $ret = array();
    foreach ($tag->getIn($tagName) as $item) {
      if (
        ($parameterId === null) ||
        (!$value_rex && $item->getParameter($parameterId) === $value) ||
        ($value_rex  && preg_match($value, $item->getParameter($parameterId)))) {
        $ret[] = $item;
        if (!$recursive) return $ret;
      }
      $ret = array_merge($ret, $this->__select($item, $tagName, $parameterId, $value, $recursive, $value_rex));
      if (!$recursive && count($ret) === 1) return $ret;
    }
    return $ret;
  }
}

?>