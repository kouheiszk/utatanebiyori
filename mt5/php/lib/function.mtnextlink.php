<?php
# Movable Type (r) (C) 2001-2010 Six Apart, Ltd. All Rights Reserved.
# This code cannot be redistributed without permission from www.sixapart.com.
# For more information, consult your Movable Type license.
#
# $Id: function.mtnextlink.php 4196 2009-09-04 07:46:50Z takayama $

function smarty_function_mtnextlink($args, &$ctx) {

    $limit = $ctx->stash('__pager_limit');
    $offset = $ctx->stash('__pager_offset');
    $offset += $limit;

    if ( strpos($link, '?') ) {
        $link .= '&';
    }
    else {
        $link .= '?';
    }

    $link .= "limit=$limit";
    if ( $offset )
        $link .= "&offset=$offset";
    return $link;
}
?>

