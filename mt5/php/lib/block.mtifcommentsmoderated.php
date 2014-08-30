<?php
# Movable Type (r) (C) 2001-2010 Six Apart, Ltd. All Rights Reserved.
# This code cannot be redistributed without permission from www.sixapart.com.
# For more information, consult your Movable Type license.
#
# $Id: block.mtifcommentsmoderated.php 4196 2009-09-04 07:46:50Z takayama $

function smarty_block_mtifcommentsmoderated($args, $content, &$ctx, &$repeat) {
    # status: complete
    if (!isset($content)) {
        $blog = $ctx->stash('blog');
        $moderated = ($blog->blog_moderate_unreg_comments || $blog->blog_manual_approve_commenters);
        return $ctx->_hdlr_if($args, $content, $ctx, $repeat, $moderated);
    } else {
        return $ctx->_hdlr_if($args, $content, $ctx, $repeat);
    }
}
?>
