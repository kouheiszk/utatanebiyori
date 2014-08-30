<?php
# Movable Type (r) (C) 2001-2010 Six Apart, Ltd. All Rights Reserved.
# This code cannot be redistributed without permission from www.sixapart.com.
# For more information, consult your Movable Type license.
#
# $Id: block.mtcommentifmoderated.php 4196 2009-09-04 07:46:50Z takayama $

function smarty_block_mtcommentifmoderated($args, $content, &$ctx, &$repeat) {
    if (!isset($content)) {
        $comment = $ctx->stash('comment');
        if ($comment)
            $ret = $comment->visible;
        return $ctx->_hdlr_if($args, $content, $ctx, $repeat, $ret);
    } else {
        return $ctx->_hdlr_if($args, $content, $ctx, $repeat);
    }
}
?>
