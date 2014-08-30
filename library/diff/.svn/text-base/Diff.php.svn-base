<?php

Rhaco::import('diff.LineDiff');

/**
 * Create diff-style data between arrays
 * @author SuzukiKouhei
 *
 */
class Diff{

  function doDiff($strlines1, $strlines2)
  {
    $obj = new LineDiff();
    $str = $obj->str_compare($strlines1, $strlines2);
    return $str;
  }

  function onlyDiff($strlines1, $strlines2)
  {
    $this->doDiff($strlines1, $strlines2);
    return preg_replace('/^[^-+].*\n/m', '', $str);
  }

  /**
   * Visualize diff-style-text to text-with-CSS
   *
   * '+Added'   => '<span added>Added</span>'
   * '-Removed' => '<span removed>Removed</span>'
   * ' Nothing' => 'Nothing'
   */
  function diffStyleToCss($str = '')
  {
  	// Cut diff markers ('+' or '-' or ' ')
  	return preg_replace(
  		array(
  			'/^\-(.*)$/m',
  			'/^\+(.*)$/m',
  			'/^ (.*)$/m'
  		),
  		array(
  			'<span class="diff-removed">$1</span>',
  			'<span class="diff-added"  >$1</span>',
  			'$1'
  		),
  		$str
  	);
  }

  /**
   *
   * @param $str
   * @return unknown_type
   */
  function diffMarkerRemove($str = '')
  {
    // Cut diff markers ('+' or '-' or ' ')
    return preg_replace(
      array(
        '/^\-(.*)$/m',
        '/^\+(.*)$/m',
        '/^ (.*)$/m'
      ),
      array(
        '$1',
        '',
        '$1'
      ),
      $str
    );
  }

  // Merge helper (when it conflicts)
  function doUpdateDiff($pagestr, $poststr, $original)
  {
  	$obj = new LineDiff();

  	$obj->set_str('left', $original, $pagestr);
  	$obj->compare();
  	$diff1 = $obj->toArray();

  	$obj->set_str('right', $original, $poststr);
  	$obj->compare();
  	$diff2 = $obj->toArray();

  	$arr = $obj->arr_compare('all', $diff1, $diff2);

		global $do_update_diff_table;
		$table = array();
		$table[] = <<<EOD
<p>l : between backup data and stored page data.<br />
 r : between backup data and your post data.</p>
<table class="style_table">
<tr>
  <th>l</th>
  <th>r</th>
  <th>text</th>
</tr>
EOD;
		$tags = array('th', 'th', 'td');
		foreach ($arr as $_obj) {
			$table[] = ' <tr>';
			$params = array($_obj->get('left'), $_obj->get('right'), $_obj->text());
			foreach ($params as $key => $text) {
				$text = htmlspecialchars(rtrim($text));
				if (empty($text)) $text = '&nbsp;';
				$table[] =
					'  <' . $tags[$key] . ' class="style_' . $tags[$key] . '">' .
					$text .
					'</' . $tags[$key] . '>';
			}
			$table[] = ' </tr>';
		}
		$table[] =  '</table>';

		$do_update_diff_table = implode("\n", $table) . "\n";
		unset($table);

  	$body = array();
  	foreach ($arr as $_obj) {
  		if ($_obj->get('left') != '-' && $_obj->get('right') != '-') {
  			$body[] = $_obj->text();
  		}
  	}

  	return array(rtrim(implode('', $body)) . "\n", 1);
  }
}


?>
