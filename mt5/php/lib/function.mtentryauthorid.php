<?php
# Movable Type (r) (C) 2001-2010 Six Apart, Ltd. All Rights Reserved.
# This code cannot be redistributed without permission from www.sixapart.com.
# For more information, consult your Movable Type license.
#
# $Id: function.mtentryauthorid.php 4196 2009-09-04 07:46:50Z takayama $

function smarty_function_mtentryauthorid($args, &$ctx) {
    // status: complete
    // parameters: none
    $entry = $ctx->stash('entry');
    if (!$entry) return '';
    return $entry->entry_author_id;
}
?>
