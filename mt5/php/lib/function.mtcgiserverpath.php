<?php
# Movable Type (r) (C) 2001-2010 Six Apart, Ltd. All Rights Reserved.
# This code cannot be redistributed without permission from www.sixapart.com.
# For more information, consult your Movable Type license.
#
# $Id: function.mtcgiserverpath.php 4196 2009-09-04 07:46:50Z takayama $

function smarty_function_mtcgiserverpath($args, &$ctx) {
    // status: complete
    // parameters: none
    $path = $ctx->mt->config('MTDir');
    if (substr($path, strlen($path) - 1, 1) == '/')
        $path = substr($path, 1, strlen($path)-1);
    return $path;
}
?>
