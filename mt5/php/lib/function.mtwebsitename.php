<?php
# Movable Type (r) (C) 2001-2010 Six Apart, Ltd. All Rights Reserved.
# This code cannot be redistributed without permission from www.sixapart.com.
# For more information, consult your Movable Type license.
#
# $Id: function.mtwebsitename.php 4834 2009-10-23 03:09:06Z takayama $

function smarty_function_mtwebsitename($args, &$ctx) {
    // status: complete
    // parameters: none
    require_once('function.mtblogname.php');
    return smarty_function_mtblogname($args, $ctx);
}
?>
