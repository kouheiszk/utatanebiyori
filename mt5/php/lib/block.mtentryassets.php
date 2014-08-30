<?php
# Movable Type (r) (C) 2001-2010 Six Apart, Ltd. All Rights Reserved.
# This code cannot be redistributed without permission from www.sixapart.com.
# For more information, consult your Movable Type license.
#
# $Id: block.mtentryassets.php 4196 2009-09-04 07:46:50Z takayama $

require_once("block.mtassets.php");
function smarty_block_mtentryassets($args, $content, &$ctx, &$repeat) {
    return smarty_block_mtassets($args, $content, $ctx, $repeat);
}
?>
