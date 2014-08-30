<?php
# Movable Type (r) (C) 2001-2010 Six Apart, Ltd. All Rights Reserved.
# This code cannot be redistributed without permission from www.sixapart.com.
# For more information, consult your Movable Type license.
#
# $Id: function.mtblogurl.php 4196 2009-09-04 07:46:50Z takayama $

function smarty_function_mtblogurl($args, &$ctx) {
    // status: complete
    // parameters: none
    $blog = $ctx->stash('blog');
    $url = $blog->site_url();
    if (!preg_match('!/$!', $url))
        $url .= '/';
    return $url;
}
?>