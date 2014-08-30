<?php
# Movable Type (r) (C) 2001-2010 Six Apart, Ltd. All Rights Reserved.
# This code cannot be redistributed without permission from www.sixapart.com.
# For more information, consult your Movable Type license.
#
# $Id: block.mtauthorhasentry.php 4196 2009-09-04 07:46:50Z takayama $

function smarty_block_mtauthorhasentry($args, $content, &$ctx, &$repeat) {
    if (!isset($content)) {
        $author = $ctx->stash('author');
        if (!$author) {
            return $ctx->error($ctx->mt->translate("No author available"));
        }
        $args['blog_id'] = $ctx->stash('blog_id');
        $args['author_id'] = $author->author_id;
        $args['class'] = 'entry';
        $count = $ctx->mt->db()->author_entry_count($args);
        return $ctx->_hdlr_if($args, $content, $ctx, $repeat, $count > 0);
    } else {
        return $ctx->_hdlr_if($args, $content, $ctx, $repeat);
    }
}
?>
