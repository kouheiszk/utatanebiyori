<?php
# Movable Type (r) (C) 2001-2010 Six Apart, Ltd. All Rights Reserved.
# This code cannot be redistributed without permission from www.sixapart.com.
# For more information, consult your Movable Type license.
#
# $Id: function.mttagcount.php 4196 2009-09-04 07:46:50Z takayama $

function smarty_function_mttagcount($args, &$ctx) {
    $tag = $ctx->stash('Tag');
    $count = 0;
    if ($tag && is_object($tag))
        $count = $tag->tag_count;
    return $ctx->count_format($count, $args);
}
