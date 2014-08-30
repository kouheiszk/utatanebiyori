<?php
# Movable Type (r) (C) 2001-2010 Six Apart, Ltd. All Rights Reserved.
# This code cannot be redistributed without permission from www.sixapart.com.
# For more information, consult your Movable Type license.
#
# $Id: function.mtblogcclicenseurl.php 4196 2009-09-04 07:46:50Z takayama $

function smarty_function_mtblogcclicenseurl($args, &$ctx) {
    $blog = $ctx->stash('blog');
    $cc = $blog->blog_cc_license;
    if (empty($cc)) return '';
    require_once("cc_lib.php");
    return cc_url($cc);
}
?>
