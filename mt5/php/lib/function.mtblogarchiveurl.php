<?php
# Movable Type (r) (C) 2001-2010 Six Apart, Ltd. All Rights Reserved.
# This code cannot be redistributed without permission from www.sixapart.com.
# For more information, consult your Movable Type license.
#
# $Id: function.mtblogarchiveurl.php 4196 2009-09-04 07:46:50Z takayama $

function smarty_function_mtblogarchiveurl($args, &$ctx) {
    // status: complete
    // parameters: none
    $blog = $ctx->stash('blog');
    $url = $blog->archive_url();
    if ($url == '') {
        $url = $blog->site_url();
    }
    if (!preg_match('/\/$/', $url)) $url .= '/';
    return $url;
}
?>
