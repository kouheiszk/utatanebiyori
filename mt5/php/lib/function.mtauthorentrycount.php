<?php
# Movable Type (r) (C) 2001-2010 Six Apart, Ltd. All Rights Reserved.
# This code cannot be redistributed without permission from www.sixapart.com.
# For more information, consult your Movable Type license.
#
# $Id: function.mtauthorentrycount.php 4196 2009-09-04 07:46:50Z takayama $

function smarty_function_mtauthorentrycount($args, &$ctx) {
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

    $args['blog_id'] = $ctx->stash('blog_id');
    $args['author_id'] = $$author->id;
    $count = $ctx->mt->db()->blog_entry_count($args);
    return $ctx->count_format($count, $args);
}
