<?php
# Movable Type (r) (C) 2001-2010 Six Apart, Ltd. All Rights Reserved.
# This code cannot be redistributed without permission from www.sixapart.com.
# For more information, consult your Movable Type license.
#
# $Id: function.mtassetthumbnailurl.php 4196 2009-09-04 07:46:50Z takayama $

function smarty_function_mtassetthumbnailurl($args, &$ctx) {
    $asset = $ctx->stash('asset');
    if (!$asset) return '';
    if ($asset->asset_class != 'image') return '';
    $blog = $ctx->stash('blog');
    if (!$blog) return '';

    require_once('MTUtil.php');

    list($thumb) = get_thumbnail_file($asset, $blog, $args);

    return $thumb;
}
?>

