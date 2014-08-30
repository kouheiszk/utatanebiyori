<?php
# Movable Type (r) (C) 2001-2010 Six Apart, Ltd. All Rights Reserved.
# This code cannot be redistributed without permission from www.sixapart.com.
# For more information, consult your Movable Type license.
#
# $Id: block.mtsetvartemplate.php 4196 2009-09-04 07:46:50Z takayama $

function smarty_block_mtsetvartemplate($args, $content, &$ctx, &$repeat) {
    // parameters: name, value
    if (!isset($content)) {
        $name = $args['name'];
        $name or $name = $args['var'];
        if (!$name) return '';
        $value = $args['token_fn'];
        $vars =& $ctx->__stash['vars'];
        if (is_array($vars)) {
            $vars[$name] = $value;
        } else {
            $vars = array($name => $value);
            $ctx->__stash['vars'] =& $vars;
        }
    }
    return '';
}
?>
