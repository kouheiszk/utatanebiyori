<?php
Rhaco::import("lang.StringUtil");
Rhaco::import("text.RandomString");
Rhaco::import("tag.model.TemplateFormatter");
Rhaco::import("view.UtataneKyuukou");

/**
 *
 * @author Suzuki Kouhei
 */
class WikiCode{
	/**
	 * 記法一覧
	 *
	 * ヘッダ部文字(大)
	 * 記法 *
	 * 結果 <h3>〜</h3>
	 *
	 * ヘッダ部文字(中)
	 * 記法 **
	 * 結果 <h4>〜</h4>
	 *
	 * ヘッダ部文字(小)
	 * 記法 ***
	 * 結果 <h5>〜</h5>
	 *
	 * 水平線
	 * 記法 ----
	 * 結果 <hr />
	 *
	 * 強調
	 * 記法 ***文字列***
	 * 結果 <strong>文字列</strong>
	 *
	 * 斜体
	 * 記法 ///文字列///
	 * 結果 <i>文字列</i>
	 *
	 * リンク
	 * 記法 [[url]]
	 * 結果 <a href="url">url</a>
	 * 記法 [[文字列]]
	 * 結果 <a href="wiki/文字列">文字列</a>
	 * 記法 [[文字列>url]]
	 * 結果 <a href="url">文字列</a>
	 *
	 * 画像
	 * 記法 @@url@@
	 * 結果 <img src="url" />
	 *
	 * 整形済みテキスト
	 * 記法 [[[ ]]]
	 * 結果 <pre>〜</pre>
	 *
	 * ソースコード
	 * 記法 [[[[ ]]]]
	 * 結果 <pre class="prettyprint">〜</pre>
   *
   * 順序なしリスト
   * 記法 -文字列
   * 　　 -文字列
   * 結果 <ul>
   * 　　 <li>文字列</li>
   * 　　 <li>文字列</li>
   * 　　 </ul>
   *
   * 順序付きリスト
   * 記法 +文字列
   * 　　 +文字列
   * 結果 <ol>
   * 　　 <li>文字列</li>
   * 　　 <li>文字列</li>
   * 　　 </ol>
	 *
	 * テーブルデータ
	 * 記法 |aaa|bbb|ccc|
	 * 結果 <table><tr>
	 * 　　 <td>aaa</td><td>bbb</td><td>ccc</td>
	 * 　　 </tr></table>
	 *
	 * テーブルヘッダ
	 * 記法 |*aaa|*bbb|*ccc|
	 * 結果 <table><tr>
	 * 　　 <th>aaa</th><th>bbb</th><th>ccc</th>
	 * 　　 </tr></table>
	 *
	 * コメント
	 * 記法 //aaaaa
	 * 結果 <!--aaaaa-->
	 *
	 * HTML
	 * 記法 {{{HTMLを記述}}}
	 */
	function f($src,$html=true){
		$escapes = array();
		$htmls = array();

		if($html && preg_match_all("/\{\{\{(.+?)\}\}\}/ms",$src,$matches)){
			foreach($matches[0] as $key => $value){
				$name = "__HTML_ESCAPE__".uniqid($key);
				$htmls[$name] = $matches[1][$key];
				$src = str_replace($value,$name,$src);
			}
		}
		$src = "\n".StringUtil::toULD($src)."\n";
		$src = TemplateFormatter::escape($src);

		if(preg_match_all("/![pe]\{(.+?)\}/ms",$src,$matches)){
			foreach($matches[0] as $key => $value){
				$name = "__WIKI_ESCAPE__".uniqid($key);
				$escapes[$name] = $matches[1][$key];
				$src = str_replace($value,$name,$src);
			}
		}

		$src = $this->_toPre($src);

    /** //斜体// */
    $src = preg_replace("/\/\/(.+?)\/\//","<i>\\1</i>",$src);

    /** //コメント */
    $src = preg_replace("/([\n][\s\t]*)\/\/\s*([^\n]+)/", "", $src);

    $src = $this->_toHeader($src);

    $src = $this->_toOlList($src);

    $src = $this->_toUlList($src);

    $src = $this->_toTable($src);

    $src = $this->_toParagraph($src);

    /** 水平線 */
    $src = preg_replace("/([\n][\s\t]*)---[-]+[\s\t]*[\n]/","\\1<hr />\n",$src);

		/** --削除-- */
		$src = preg_replace("/--(.+?)--/","<del>\\1</del>",$src);
		/** __下線__ */
		$src = preg_replace("/__(.+?)__/","<u>\\1</u>",$src);
		/** ''強調'' */
		$src = preg_replace("/&#039;&#039;(.+?)&#039;&#039;/","<strong>\\1</strong>",$src);

    /** COLOR(色){文字} */
    $src = preg_replace("/COLOR\((.+?)\)\{(.+?)\}/","<span style=\"color:\\1\">\\2</span>",$src);

    /** MATH{数式} */
    $src = preg_replace("/MATH\{(.+?)\}/","<span style=\"color:\\1\">\\1</span>",$src);

    /** SIZE(比率){文字} */
    $src = preg_replace("/SIZE\((.+?)\)\{(.+?)\}/","<span style=\"font-size:\\1\">\\2</span>",$src);

    /** SUP{文字} */
    $src = preg_replace("/SUP\{(.+?)\}/","<span class=\"small super\">\\1</span>",$src);

    /** SUB{文字} */
    $src = preg_replace("/SUB\{(.+?)\}/","<span class=\"small sub\">\\1</span>",$src);

    $src = preg_replace("/IMG\((.+?)\)\{(.+?)\}/","<img src=\"\\2\" class=\"\\1\" />",$src);

		/** リンク */
		/** eq([[fuga>http://hogehoge.com/]], <a href="http://hogehoge.com/">fuga</a>) */
		$src = preg_replace("/\[\[(.+)&gt;(http[s]{0,1}:\/\/[\w\d_\-\.\/\~\%\#\?\:&\;,=]+)\]\]/","<a href=\"\\2\">\\1</a>",$src);
    $src = preg_replace("/\[\[(.+)&gt;(.+)\]\]/","<a href=\"". Rhaco::url("wiki/"). "\\2\">\\1</a>",$src);
		$src = preg_replace("/\[\[(http[s]{0,1}:\/\/[\w\d_\-\.\/\~\%\#\?\:&\;,=]+)\]\]/i","<a href=\"\\1\">\\1</a>",$src);
		$src = preg_replace("/\[\[([^>]+?)\]\]/","<a href=\"". Rhaco::url("wiki/"). "\\1\">\\1</a>",$src);

    /** ((注釈)) */
    $src = $this->_toNotes($src);

		$src = substr($src,1,-1);
		$src = $this->_toBr($src);

    //$src = $this->_toKyuukou($src);

		foreach($escapes as $key => $value){
			$src = str_replace($key,$value,$src);
		}
		foreach($htmls as $key => $value){
			$src = str_replace($key,$value,$src);
		}
		$src = substr(preg_replace("/([^\"\'])(http[s]{0,1}:\/\/[\w\d_\-\.\/\~\%\#\?\:&\;,=]+)/i","\\1<a href=\"\\2\">\\2</a>"," ".$src),1);
		return $src;
	}
  /**
   * 整形済み文章の中かどうか
   */
	function _isExclusion($value,$exclusion){
		if(!$exclusion && strpos($value,"<pre") !== false) $exclusion = true;
		if($exclusion && strpos($value,"</pre>") !== false) $exclusion = false;
		return $exclusion;
	}
  /**
   * 段落<p></p>の中かどうか
   */
  function _isParagraph($value,$paragraph){
    if(!$paragraph && strpos($value,"<p>") !== false) $paragraph = true;
    if($paragraph && strpos($value,"</p>") !== false) $paragraph = false;
    return $paragraph;
  }

  /**
   * 整形済み文書にする。
   * @param $src
   * @return unknown_type
   */
  function _toPre($src){
    $src = str_replace("PRE[[[","<pre class=\"no-wrapper\">",$src);
    $src = preg_replace("/CODE\(([^\n\)]+)\)\[\[\[/","<pre name=\"code\" class=\"\\1\">",$src);
    $src = str_replace("[[[","<pre>",$src);
    $src = str_replace("]]]","</pre>",$src);

    return $src;
  }

  /**
   * 見出しを作成する。
   * @param $src
   * @return unknown_type
   */
  function _toHeader($src){
    $result = "";
    $exclusion = false;
    $en = false;

    foreach(explode("\n",$src) as $value){
      $en = true;
      $exclusion = $this->_isExclusion($value,$exclusion);

      if(!$exclusion){
        if(preg_match("/^([\s\t]*)\*\*\*\s*(.+)$/",trim($value),$match)){
          $value = "<h5>". $match[2]. "</h5>";
        }elseif(preg_match("/^([\s\t]*)\*\*\s*(.+)$/",trim($value),$match)){
          $value = "<h4>". $match[2]. "</h4>";
        }elseif(preg_match("/^([\s\t]*)\*\s*(.+)$/",trim($value),$match)){
          $value = "<h3>". $match[2]. "</h3>";
        }
      }
      $result .= $value. "\n";
    }
    return ($en) ? substr($result,0,-1) : $result;
  }

  /**
   * 改行を<br />に変換
   * @param unknown_type $src
   * @return unknown_type
   */
	function _toBr($src){
		$result = "";
		$exclusion = false;
		$paragraph = false;
		$en = false;

		foreach(explode("\n",$src) as $value){
			$exclusion = $this->_isExclusion($value,$exclusion);
			$paragraph = $this->_isParagraph($value,$paragraph);
			$result .= ((!$exclusion && $paragraph) ? $value."<br />" : $value)."\n";
			$en = (!$exclusion && $paragraph) ? true : false;
		}
		return ($en) ? substr($result,0,-7) : $result;
	}

  /**
   * 注釈作成
   * @param $src
   * @return unknown_type
   */
  function _toNotes($src){
    $result = "";
    $notes = "";
    $count = 1;
    $exclusion = false;
    $en = false;

    foreach(explode("\n",$src) as $value){
      $exclusion = $this->_isExclusion($value,$exclusion);
      if(!$exclusion){
        if(preg_match("/^(.+)\(\((.+)\)\)(.+)$/",trim($value),$match)){
          if(!$en){
            $notes .= "<div id=\"note\">\n";
            $en = true;
          }
          $anchor = RandomString::ascii(8);
          $notes .= "<span id=\"notefoot_". $anchor. "\">". "*". $count. "&nbsp;".$match[2]. "</span><br />\n";
          $value = $match[1]. "<a href=\"#notefoot_". $anchor. "\" title=\"". TemplateFormatter::striptags($match[2]). "\" id=\"notetext_". $anchor. "\" class=\"notes-super small bold\">*". $count. "</a>". $match[3];
          $count++;
        }
      }
      $result .= $value. "\n";
    }
    if($en){
      $notes .= "</div>\n";
    }
    $result .= $notes;
    return ($en) ? substr($result,0,-1) : $result;
  }

  /**
   * テーブル作成
   * @param $src
   * @return unknown_type
   */
  function _toTable($src){
    $result = "";
    $exclusion = false;
    $isTable = false;
    $en = false;

    foreach(explode("\n",$src) as $value){
      $en = true;
      $exclusion = $this->_isExclusion($value,$exclusion);

      if(!$exclusion){
        if(preg_match("/^\|(.+)\|$/",trim($value),$match)){
          $value = ($isTable) ? "<tr>" : "<table><tr>";

          foreach(explode("|",$match[1]) as $column){
            if(substr($column,0,1) == "*"){
              $value .= "<th>".substr($column,1)."</th>";
            }else{
              $value .= "<td>".$column."</td>";
            }
          }
          $value .= "</tr>";
          $isTable = true;
        }else if($isTable){
          $value = "</table>".$value;
          $isTable = false;
        }
      }
      $result .= $value.((!$isTable) ? "\n" : "");
    }
    return ($en) ? substr($result,0,-1) : $result;
  }

  /**
   * 休講情報作成
   * @param $src
   * @return unknown_type
   */
  function _toKyuukou($src){
    $result = "";
    $exclusion = false;

    foreach(explode("\n",$src) as $value){
      $exclusion = $this->_isExclusion($value,$exclusion);

      if(!$exclusion){
        if(preg_match("/^(.+)KYUUKOU\((.+)\)(.+)$/",trim($value),$match)){
          $value = UtataneKyuukou::kyuukouLimit($match[2]);
        }
        $result .= $value. "\n";
      }
    }
    return $result;
  }

  /**
   * 順序なしリスト作成
   * @param unknown_type $src
   * @return unknown_type
   */
  function _toOlList($src){
    $result = "";
    $exclusion = false;
    $indent = 0;
    $isListLevel1 = false;
    $isListLevel2 = false;
    $en = false;

    foreach(explode("\n",$src) as $value){
      $en = true;
      $exclusion = $this->_isExclusion($value,$exclusion);

      if(!$exclusion){
        if(preg_match("/^([\s\t]*)\+([^\+].+)$/",$value,$match)){
          if($indent == 0){
            $value = "<ol>\n";
            $isList = true;
            $indent++;
          }else if($indent == 2){
            $value = "</ol>";
            $indent--;
          }else{
            $value = "";
          }
          if($isListLevel1 == true){
            $result = substr($result,0,-1);
            $value .= "</li>\n";
            $isListLevel1 = false;
          }
          $value .= "<li>".$match[2];
          $isListLevel1 = true;
        }else if(preg_match("/^([\s\t]*)\+\+([^\+].+)$/",$value,$match) && $isList == true){
          if($indent == 1){
            $value = "<ol>\n";
            $isList = true;
            $indent++;
          }else if($indent == 3){
            $value = "</ol>";
            $indent--;
          }else{
            $value = "";
          }
          if($isListLevel2 == true){
            $result = substr($result,0,-1);
            $value .= "</li>\n";
            $isListLevel2 = false;
          }
          $value .= "<li>".$match[2];
          $isListLevel2 = true;
        }else if(preg_match("/^([\s\t]*)\+\+\++([^\+].+)$/",$value,$match) && $isList == true){
          if($indent == 2){
            $value = "<ul>\n";
            $isList = true;
            $indent++;
          }else{
            $value = "";
          }
          $value .= "<li>".$match[2]."</li>";
        }else{
          if($indent == 3){
            $value .= "</ol>";
            $indent--;
          }
          if($isListLevel2 == true){
            $value .= "</li>";
            $isListLevel2 = false;
          }
          if($indent == 2){
            $value .= "</ol>\n";
            $indent--;
          }
          if($isListLevel1 == true){
            $value .= "</li>";
            $isListLevel1 = false;
          }
          if($indent == 1){
            $value .= "</ol>\n";
            $indent--;
          }
          $indent = 0;
          $isList = false;
        }
      }
      $result .= $value. "\n";
    }
    return ($en) ? substr($result,0,-1) : $result;
  }

  /**
   * 順序なしリスト作成
   * @param unknown_type $src
   * @return unknown_type
   */
  function _toUlList($src){
    $result = "";
    $exclusion = false;
    $indent = 0;
    $isListLevel1 = false;
    $isListLevel2 = false;
    $en = false;

    foreach(explode("\n",$src) as $value){
      $en = true;
      $exclusion = $this->_isExclusion($value,$exclusion);

      if(!$exclusion){
        if(preg_match("/^([\s\t]*)-([^-].+)$/",$value,$match)){
          if($indent == 0){
            $value = "<ul>\n";
            $isList = true;
            $indent++;
          }else if($indent == 2){
            $value = "</ul>";
            $indent--;
          }else{
            $value = "";
          }
          if($isListLevel1 == true){
            $result = substr($result,0,-1);
            $value .= "</li>\n";
            $isListLevel1 = false;
          }
          $value .= "<li>".$match[2];
          $isListLevel1 = true;
        }else if(preg_match("/^([\s\t]*)--([^-].+)$/",$value,$match) && $isList == true){
          if($indent == 1){
            $value = "<ul>\n";
            $isList = true;
            $indent++;
          }else if($indent == 3){
            $value = "</ul>";
            $indent--;
          }else{
            $value = "";
          }
          if($isListLevel2 == true){
            $result = substr($result,0,-1);
            $value .= "</li>\n";
            $isListLevel2 = false;
          }
          $value .= "<li>".$match[2];
          $isListLevel2 = true;
        }else if(preg_match("/^([\s\t]*)---+([^-].+)$/",$value,$match) && $isList == true){
          if($indent == 2){
            $value = "<ul>\n";
            $isList = true;
            $indent++;
          }else{
            $value = "";
          }
          $value .= "<li>".$match[2]."</li>";
        }else{
          if($indent == 3){
            $value .= "</ul>";
            $indent--;
          }
          if($isListLevel2 == true){
            $value .= "</li>";
            $isListLevel2 = false;
          }
          if($indent == 2){
            $value .= "</ul>\n";
            $indent--;
          }
          if($isListLevel1 == true){
            $value .= "</li>";
            $isListLevel1 = false;
          }
          if($indent == 1){
            $value .= "</ul>\n";
            $indent--;
          }
          $indent = 0;
          $isList = false;
        }
      }
      $result .= $value. "\n";
    }
    return ($en) ? substr($result,0,-1) : $result;
  }

  /**
   * 段落作成
   * @param $src
   * @return unknown_type
   */
  function _toParagraph($src){
    $result = "";
    $exclusion = false;
    $en = false;
    $isParagraph = false;

    foreach(explode("\n",$src) as $value){
      $en = true;
      $exclusion = $this->_isExclusion($value,$exclusion);

      if(!$exclusion){

        if(!$isParagraph){
          if(preg_match("/^[\s]*([^<].*)$/",$value,$match)){
            $value = "<p>". $match[1];
            $isParagraph = true;
          }
        } else {
          if(preg_match("/^[\s]*(<.*)$/",$value,$match)){
            $value = "</p>\n". $match[1];
            $result = substr($result,0,-1);
            $isParagraph = false;
          }
          if(preg_match("/^[\s\t]*$/",$value)){
            $value = "</p>\n";
            $result = substr($result,0,-1);
            $isParagraph = false;
          }
        }
      }
      $result .= $value."\n";
    }
    return ($en) ? substr($result,0,-1) : $result;
  }
}
?>