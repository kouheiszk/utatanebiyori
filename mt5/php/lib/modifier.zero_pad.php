<?php
# Movable Type (r) (C) 2001-2010 Six Apart, Ltd. All Rights Reserved.
# This code cannot be redistributed without permission from www.sixapart.com.
# For more information, consult your Movable Type license.
#
# $Id: modifier.zero_pad.php 4196 2009-09-04 07:46:50Z takayama $

function smarty_modifier_zero_pad($text, $len) {
    return sprintf("%0".$len."s", $text);
}
?>
