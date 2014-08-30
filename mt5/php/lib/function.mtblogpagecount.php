<?php
# Movable Type (r) (C) 2001-2010 Six Apart, Ltd. All Rights Reserved.
# This code cannot be redistributed without permission from www.sixapart.com.
# For more information, consult your Movable Type license.
#
# $Id: function.mtblogpagecount.php 4196 2009-09-04 07:46:50Z takayama $

require_once('function.mtblogentrycount.php');
function smarty_function_mtblogpagecount($args, &$ctx) {
    // status: complete
    // parameters: none
    $args['class'] = 'page';
    return smarty_function_mtblogentrycount($args, $ctx);
}
