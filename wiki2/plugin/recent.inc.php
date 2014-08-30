<?php
// $Id: recent.inc.php,v 1.25.3 2008/07/08 00:25:00 upk Exp $
// Copyright (C)
//   2005-2008 PukiWiki Plus! Team
//   2002-2007 PukiWiki Developers Team
//   2002      Y.MASUI http://masui.net/pukiwiki/ masui@masui.net
// License: GPL version 2
//
// Recent plugin -- Show RecentChanges list
//   * Usually used at 'MenuBar' page
//   * Also used at special-page, without no #recnet at 'MenuBar'

// Default number of 'Show latest N changes'
define('PLUGIN_RECENT_DEFAULT_LINES', 10);

// Limit number of executions
define('PLUGIN_RECENT_EXEC_LIMIT', 3); // N times per one output

// ----

define('PLUGIN_RECENT_USAGE', '#recent(number-to-show)');

// Place of the cache of 'RecentChanges'
define('PLUGIN_RECENT_CACHE', CACHE_DIR . PKWK_MAXSHOW_CACHE);

function plugin_recent_convert()
{
	global $vars, $date_format, $show_passage; // , $_recent_plugin_frame;
	static $exec_count = 1;

	//$_recent_plugin_frame_s = _('recent(%d)');
	//$_recent_plugin_frame   = sprintf('<h5>%s</h5><div>%%s</div>', $_recent_plugin_frame_s);
	$_recent_plugin_frame_s = _('最新の%d件');
	$_recent_plugin_frame   = sprintf("<h3>%s</h3>\n<div>\n%%s\n</div>", $_recent_plugin_frame_s);

	$recent_lines = PLUGIN_RECENT_DEFAULT_LINES;
	if (func_num_args()) {
		$args = func_get_args();
		if (! is_numeric($args[0]) || isset($args[1])) {
			return PLUGIN_RECENT_USAGE . '<br />';
		} else {
			$recent_lines = $args[0];
		}
	}

	// Show only N times
	if ($exec_count > PLUGIN_RECENT_EXEC_LIMIT) {
		return '#recent(): You called me too much' . '<br />' . "\n";
	} else {
		++$exec_count;
	}

	if (! file_exists(PLUGIN_RECENT_CACHE))
		return '#recent(): Cache file of RecentChanges not found' . '<br />';

	// Get latest N changes
	$lines = file_head(PLUGIN_RECENT_CACHE, $recent_lines);
	if ($lines == FALSE) return '#recent(): File can not open' . '<br />' . "\n";

	$auth_key = auth::get_user_info();
	$date = $items = '';
	foreach ($lines as $line) {
		list($time, $page) = explode("\t", rtrim($line));
		if (! auth::is_page_readable($page,$auth_key['key'],$auth_key['group'])) continue;

		$_date = get_date($date_format, $time);
		if ($date != $_date) {
			// End of the day
			if ($date != '') $items .= '</ul>' . "\n";

			// New day
			$date = $_date;
			$items .= '<strong>' . $date . '</strong>' . "\n" .
				'<ul class="recent_list">' . "\n";
		}

		//$s_page = htmlspecialchars($page);
		$s_page = htmlspecialchars(basename($page));

		if($page === $vars['page']) {
			// No need to link to the page you just read, or notify where you just read
			$items .= ' <li>' . $s_page . '</li>' . "\n";
		} else {
			$passage = $show_passage ? ' ' . get_passage($time) : '';
			$items .= ' <li><a href="' . get_page_uri($page) . '"' .
				' title="' . $s_page . $passage . '">' . $s_page . '</a></li>' . "\n";
		}
	}
	// End of the day
	if ($date != '') $items .= '</ul>' . "\n";

	return sprintf($_recent_plugin_frame, count($lines), $items);
}
?>
