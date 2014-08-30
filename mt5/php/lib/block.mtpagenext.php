<?php
# Movable Type (r) (C) 2001-2010 Six Apart, Ltd. All Rights Reserved.
# This code cannot be redistributed without permission from www.sixapart.com.
# For more information, consult your Movable Type license.
#
# $Id: block.mtpagenext.php 4196 2009-09-04 07:46:50Z takayama $

require_once('block.mtentrynext.php');
function smarty_block_mtpagenext($args, $content, &$ctx, &$repeat) {
    $args['class'] = 'page';
    return smarty_block_mtentrynext($args, $content, $ctx, $repeat);
}
?>
