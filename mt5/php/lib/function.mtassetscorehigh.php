<?php
# Movable Type (r) (C) 2001-2010 Six Apart, Ltd. All Rights Reserved.
# This code cannot be redistributed without permission from www.sixapart.com.
# For more information, consult your Movable Type license.
#
# $Id: function.mtassetscorehigh.php 4196 2009-09-04 07:46:50Z takayama $

require_once('rating_lib.php');

function smarty_function_mtassetscorehigh($args, &$ctx) {
    return hdlr_score_high($ctx, 'asset', $args['namespace'], $args);
}
?>

