<?php
# Movable Type (r) (C) 2001-2010 Six Apart, Ltd. All Rights Reserved.
# This code cannot be redistributed without permission from www.sixapart.com.
# For more information, consult your Movable Type license.
#
# $Id: block.mtblogifcclicense.php 4196 2009-09-04 07:46:50Z takayama $

function smarty_block_mtblogifcclicense($args, $content, &$ctx, &$repeat) {
    // status: complete
    // parameters: none
    if (!isset($content)) {
        $blog = $ctx->stash('blog');
        return $ctx->_hdlr_if($args, $content, $ctx, $repeat, !empty($blog->blog_cc_license));
    } else {
        return $ctx->_hdlr_if($args, $content, $ctx, $repeat);
    }
}
?>
