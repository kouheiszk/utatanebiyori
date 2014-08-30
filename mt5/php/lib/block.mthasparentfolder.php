<?php
# Movable Type (r) (C) 2001-2010 Six Apart, Ltd. All Rights Reserved.
# This code cannot be redistributed without permission from www.sixapart.com.
# For more information, consult your Movable Type license.
#
# $Id: block.mthasparentfolder.php 4196 2009-09-04 07:46:50Z takayama $

require_once('block.mthasparentcategory.php');
function smarty_block_mthasparentfolder($args, $content, &$ctx, &$repeat) {
    $args['class'] = 'folder';
    return smarty_block_mthasparentcategory($args, $content, $ctx, $repaet);
}
?>
