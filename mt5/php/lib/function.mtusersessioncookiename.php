<?php
# Movable Type (r) (C) 2001-2010 Six Apart, Ltd. All Rights Reserved.
# This code cannot be redistributed without permission from www.sixapart.com.
# For more information, consult your Movable Type license.
#
# $Id: function.mtusersessioncookiename.php 4196 2009-09-04 07:46:50Z takayama $

function smarty_function_mtusersessioncookiename($args, &$ctx) {
    $name = $ctx->mt->config('UserSessionCookieName');
    if ($name == 'DEFAULT') {
        if ($ctx->mt->config('SingleCommunity')) {
            $name = 'mt_blog_user';
        } else {
            $name = 'mt_blog%b_user';
        }
    }
    if (preg_match('/%b/', $name)) {
        $blog = $ctx->stash('blog');
        $name = preg_replace('/%b/', $blog->blog_id, $name);
    }
    return $name;
}