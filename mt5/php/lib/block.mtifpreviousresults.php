<?php
# Movable Type (r) (C) 2001-2010 Six Apart, Ltd. All Rights Reserved.
# This code cannot be redistributed without permission from www.sixapart.com.
# For more information, consult your Movable Type license.
#
# $Id: block.mtifpreviousresults.php 4196 2009-09-04 07:46:50Z takayama $

function smarty_block_mtifpreviousresults($args, $content, &$ctx, &$repeat) {
    if (!isset($content)) {
        $offset = $ctx->stash('__pager_offset');
        return $ctx->_hdlr_if($args, $content, $ctx, $repeat, $offset ? true : false);
    } else {
        return $ctx->_hdlr_if($args, $content, $ctx, $repeat);
    }
}
?>
