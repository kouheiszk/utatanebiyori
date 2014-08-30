<?php
# Movable Type (r) (C) 2001-2010 Six Apart, Ltd. All Rights Reserved.
# This code cannot be redistributed without permission from www.sixapart.com.
# For more information, consult your Movable Type license.
#
# $Id: block.mtcommentsfooter.php 4196 2009-09-04 07:46:50Z takayama $

function smarty_block_mtcommentsfooter($args, $content, &$ctx, &$repeat) {
    if (!isset($content)) {
        $comments = $ctx->stash('comments');
        $counter = $ctx->stash('comment_order_num');
        return $ctx->_hdlr_if($args, $content, $ctx, $repeat, $counter == count($comments));
    } else {
        return $ctx->_hdlr_if($args, $content, $ctx, $repeat);
    }
}
?>
