<?php
# Movable Type (r) (C) 2001-2010 Six Apart, Ltd. All Rights Reserved.
# This code cannot be redistributed without permission from www.sixapart.com.
# For more information, consult your Movable Type license.
#
# $Id: function.mtpingrank.php 4196 2009-09-04 07:46:50Z takayama $

require_once('rating_lib.php');

function smarty_function_mtpingrank($args, &$ctx) {
    return hdlr_rank($ctx, 'tbping', $args['namespace'], $args['max'],
        "AND (tbping_visible = 1)\n", $args
    );
}
?>
