<?php
# Movable Type (r) (C) 2001-2010 Six Apart, Ltd. All Rights Reserved.
# This code cannot be redistributed without permission from www.sixapart.com.
# For more information, consult your Movable Type license.
#
# $Id: function.mtentryblogdescription.php 4196 2009-09-04 07:46:50Z takayama $

function smarty_function_mtentryblogdescription($args, &$ctx) {
    $entry = $ctx->stash('entry');
    if ($entry->entry_blog_id) {
        $blog = $ctx->mt->db()->fetch_blog($entry->entry_blog_id);
        if ($blog) {
            return $blog->blog_description;
        }
    }
    return '';
}
?>