<?php
# Movable Type (r) (C) 2001-2010 Six Apart, Ltd. All Rights Reserved.
# This code cannot be redistributed without permission from www.sixapart.com.
# For more information, consult your Movable Type license.
#
# $Id: block.mtcommenteruserpicasset.php 4196 2009-09-04 07:46:50Z takayama $

function smarty_block_mtcommenteruserpicasset($args, $content, &$ctx, &$repeat) {
    $comment = $ctx->stash('comment');
    if (!$comment) {
        return $ctx->error("No comment available");
    }
    $cmntr = $ctx->stash('commenter');
    if (!$cmntr) return '';

    $asset = $cmntr->userpic();
    if (!$asset) return '';

    $ctx->stash('asset',  $asset);

    return $content;
}
?>
