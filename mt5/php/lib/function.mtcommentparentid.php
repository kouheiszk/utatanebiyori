<?php
# Movable Type (r) (C) 2001-2010 Six Apart, Ltd. All Rights Reserved.
# This code cannot be redistributed without permission from www.sixapart.com.
# For more information, consult your Movable Type license.
#
# $Id: function.mtcommentparentid.php 4196 2009-09-04 07:46:50Z takayama $

function smarty_function_mtcommentparentid($args, &$ctx) {
    $comment = $ctx->stash('comment');
    $id = $comment->comment_parent_id;
    if (! $id) return '';
    if (isset($args['pad']) && $args['pad']) {
        $id = sprintf("%06d", $id);
    }
    return $id;
}
?>
