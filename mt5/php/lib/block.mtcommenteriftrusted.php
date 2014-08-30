<?php
# Movable Type (r) (C) 2001-2010 Six Apart, Ltd. All Rights Reserved.
# This code cannot be redistributed without permission from www.sixapart.com.
# For more information, consult your Movable Type license.
#
# $Id: block.mtcommenteriftrusted.php 4196 2009-09-04 07:46:50Z takayama $

function smarty_block_mtcommenteriftrusted($args, $content, &$ctx, &$repeat) {
    if (!isset($content)) {
        $a = $ctx->stash('commenter');
        if (empty($a)) {
            $banned = 0;
            $approved = 0;
        } else {
            $perms = $a->permissions();
            foreach ($perms as $perm) {
                $banned = preg_match("/'comment'/", $perm->permission_restrictions) ? 1 : 0;
                $approved = preg_match("/'(comment|administer_blog|manage_feedback)'/", $perm->permission_permissions) ? 1 : 0;
                if ($banned || $approved)
                    break;
            }
        }
        return $ctx->_hdlr_if($args, $content, $ctx, $repeat, !$banned && $approved);
    } else {
        return $ctx->_hdlr_if($args, $content, $ctx, $repeat);
    }
}
?>
