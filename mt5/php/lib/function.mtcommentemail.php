<?php
# Movable Type (r) (C) 2001-2010 Six Apart, Ltd. All Rights Reserved.
# This code cannot be redistributed without permission from www.sixapart.com.
# For more information, consult your Movable Type license.
#
# $Id: function.mtcommentemail.php 4196 2009-09-04 07:46:50Z takayama $

function smarty_function_mtcommentemail($args, &$ctx) {
    $comment = $ctx->stash('comment');
    $email = $comment->comment_email;
    $email = strip_tags($email);
    if (!preg_match('/@/', $email))
        return '';
    return((isset($args['spam_protect']) && $args['spam_protect']) ? spam_protect($email) : $email);
}
?>
