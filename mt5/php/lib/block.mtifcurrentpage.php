<?php
# Movable Type (r) (C) 2001-2010 Six Apart, Ltd. All Rights Reserved.
# This code cannot be redistributed without permission from www.sixapart.com.
# For more information, consult your Movable Type license.
#
# $Id: block.mtifcurrentpage.php 4196 2009-09-04 07:46:50Z takayama $

function smarty_block_mtifcurrentpage($args, $content, &$ctx, &$repeat) {
    if (!isset($content)) {
        $limit = $ctx->stash('__pager_limit');
        $offset = $ctx->stash('__pager_offset');
        $value = $ctx->__stash['vars']['__value__'];
        $current = $limit ? $offset / $limit + 1 : 1;
        return $ctx->_hdlr_if($args, $content, $ctx, $repeat, $value == $current);
    } else {
        return $ctx->_hdlr_if($args, $content, $ctx, $repeat);
    }
}
?>

