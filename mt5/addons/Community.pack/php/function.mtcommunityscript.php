<?php
# Movable Type (r) (C) 2001-2010 Six Apart, Ltd. All Rights Reserved.
# This code cannot be redistributed without permission from www.sixapart.com.
# For more information, consult your Movable Type license.
#
# $Id: function.mtcommunityscript.php 116653 2009-12-14 09:56:08Z auno $

function smarty_function_mtcommunityscript($args, &$ctx) {
    $script = $ctx->mt->config('CommunityScript');
    if (!$script) $script = 'mt-cp.cgi';
    return $script;
}
?>