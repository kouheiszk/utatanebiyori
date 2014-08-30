<?php
# Movable Type (r) (C) 2001-2010 Six Apart, Ltd. All Rights Reserved.
# This code cannot be redistributed without permission from www.sixapart.com.
# For more information, consult your Movable Type license.
#
# $Id: function.mtcategorytrackbackcount.php 4196 2009-09-04 07:46:50Z takayama $

function smarty_function_mtcategorytrackbackcount($args, &$ctx) {
    $cat = $ctx->stash('category');
    $cat_id = $cat->category_id;
    $count = $ctx->mt->db()->category_ping_count($cat_id);
    return $ctx->count_format($count, $args);
}
