<?php
# Movable Type (r) (C) 2001-2010 Six Apart, Ltd. All Rights Reserved.
# This code cannot be redistributed without permission from www.sixapart.com.
# For more information, consult your Movable Type license.
#
# $Id: function.mttypekeytoken.php 4196 2009-09-04 07:46:50Z takayama $

function smarty_function_mttypekeytoken($args, &$ctx) {
    // status: complete
    // parameters: none
    $blog = $ctx->stash('blog');
    return $blog->blog_remote_auth_token;
}
?>
