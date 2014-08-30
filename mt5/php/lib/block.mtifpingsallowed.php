<?php
# Movable Type (r) (C) 2001-2010 Six Apart, Ltd. All Rights Reserved.
# This code cannot be redistributed without permission from www.sixapart.com.
# For more information, consult your Movable Type license.
#
# $Id: block.mtifpingsallowed.php 4196 2009-09-04 07:46:50Z takayama $

function smarty_block_mtifpingsallowed($args, $content, &$ctx, &$repeat) {
    # status: complete
    if (!isset($content)) {
        $blog = $ctx->stash('blog');
        return $ctx->_hdlr_if($args, $content, $ctx, $repeat, $blog->blog_allow_pings && $ctx->mt->config('AllowPings'));
    } else {
        return $ctx->_hdlr_if($args, $content, $ctx, $repeat);
    }
}
?>