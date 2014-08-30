<?php
# Movable Type (r) (C) 2001-2010 Six Apart, Ltd. All Rights Reserved.
# This code cannot be redistributed without permission from www.sixapart.com.
# For more information, consult your Movable Type license.
#
# $Id: function.mtstaticwebpath.php 4196 2009-09-04 07:46:50Z takayama $

function smarty_function_mtstaticwebpath($args, &$ctx) {
    $path = $ctx->mt->config('StaticWebPath');
    if (!$path) {
        require_once "function.mtcgipath.php";
        $path = smarty_function_mtcgipath($args, $ctx);
        $path .= 'mt-static/';
    } elseif (substr($path, 0, 1) == '/') {
        $blog = $ctx->stash('blog');
        $host = $blog->site_url();
        if (!preg_match('!/$!', $host))
            $host .= '/';
        if (preg_match('!^(https?://[^/:]+)(:\d+)?/!', $host, $matches)) {
            $path = $matches[1] . $path;
        }        
    }
    if (substr($path, strlen($path) - 1, 1) != '/')
        $path .= '/';
    return $path;
}
?>
