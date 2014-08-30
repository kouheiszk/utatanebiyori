<?php
# Movable Type (r) (C) 2001-2010 Six Apart, Ltd. All Rights Reserved.
# This code cannot be redistributed without permission from www.sixapart.com.
# For more information, consult your Movable Type license.
#
# $Id: function.mtblogtemplatesetid.php 4370 2009-09-16 03:38:46Z takayama $

function smarty_function_mtblogtemplatesetid($args, &$ctx) {
    // status: complete
    // parameters: none
    $blog = $ctx->stash('blog');
    if (!$blog) return '';
    $id = $blog->blog_template_set ? $blog->blog_template_set : $blog->blog_theme_id;
    $id = preg_replace('/_/', '-', $id);
    return $id;
}
?>
