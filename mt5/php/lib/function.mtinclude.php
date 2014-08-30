<?php
# Movable Type (r) (C) 2001-2010 Six Apart, Ltd. All Rights Reserved.
# This code cannot be redistributed without permission from www.sixapart.com.
# For more information, consult your Movable Type license.
#
# $Id: function.mtfolderpath.php 4196 2009-09-04 07:46:50Z takayama $

require_once('function.mtsubcategorypath.php');
function smarty_function_mtfolderpath($args, &$ctx) {
    $args['class'] = 'folder';
    return smarty_function_mtsubcategorypath($args, $ctx);
}
?>
