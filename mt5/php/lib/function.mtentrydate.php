<?php
# Movable Type (r) (C) 2001-2010 Six Apart, Ltd. All Rights Reserved.
# This code cannot be redistributed without permission from www.sixapart.com.
# For more information, consult your Movable Type license.
#
# $Id: function.mtentrydate.php 4196 2009-09-04 07:46:50Z takayama $

function smarty_function_mtentrydate($args, &$ctx) {
    $e = $ctx->stash('entry');
    $args['ts'] = $e->entry_authored_on;
    return $ctx->_hdlr_date($args, $ctx);
}
?>
