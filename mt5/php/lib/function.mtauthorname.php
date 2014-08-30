<?php
# Movable Type (r) (C) 2001-2010 Six Apart, Ltd. All Rights Reserved.
# This code cannot be redistributed without permission from www.sixapart.com.
# For more information, consult your Movable Type license.
#
# $Id: function.mtauthorname.php 4196 2009-09-04 07:46:50Z takayama $

function smarty_function_mtauthorname($args, &$ctx) {
    $author = $ctx->stash('author');
    if (empty($author)) {
        $entry = $ctx->stash('entry');
        if (!empty($entry)) {
            $author = $entry->author();
        }
    }

    if (empty($author)) {
        return $ctx->error("No author available");
    }
    return $author->author_name;
}
?>
