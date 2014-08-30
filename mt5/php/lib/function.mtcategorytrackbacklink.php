<?php
# Movable Type (r) (C) 2001-2010 Six Apart, Ltd. All Rights Reserved.
# This code cannot be redistributed without permission from www.sixapart.com.
# For more information, consult your Movable Type license.
#
# $Id: function.mtcategorytrackbacklink.php 4196 2009-09-04 07:46:50Z takayama $

function smarty_function_mtcategorytrackbacklink($args, &$ctx) {
    $cat = $ctx->stash('category');
    if (!$cat) return '';
    if (!$cat->trackback()->id) return '';
    require_once "function.mtcgipath.php";
    $path = smarty_function_mtcgipath($args, $ctx);
    $path .= $ctx->mt->config('TrackbackScript') . '/' . $cat->trackback()->id;
    return $path;
}
?>
