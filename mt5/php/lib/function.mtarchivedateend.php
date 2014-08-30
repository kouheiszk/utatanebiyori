<?php
# Movable Type (r) (C) 2001-2010 Six Apart, Ltd. All Rights Reserved.
# This code cannot be redistributed without permission from www.sixapart.com.
# For more information, consult your Movable Type license.
#
# $Id: function.mtarchivedateend.php 4196 2009-09-04 07:46:50Z takayama $

function smarty_function_mtarchivedateend($args, &$ctx) {
    // status: complete
    $end = $ctx->stash('current_timestamp_end');
    $args['ts'] = $end;
    return $ctx->_hdlr_date($args, $ctx);
}
?>
