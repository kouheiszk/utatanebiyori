<?php
# Movable Type (r) (C) 2001-2010 Six Apart, Ltd. All Rights Reserved.
# This code cannot be redistributed without permission from www.sixapart.com.
# For more information, consult your Movable Type license.
#
# $Id: mtcache_base.php 4196 2009-09-04 07:46:50Z takayama $

class MTCacheBase {
    var $_ttl = 0;

    function MTCacheBase ($ttl = 0) {
        $this->ttl = $ttl;
    }

    function get ($key, $ttl = null) {
    }

    function get_multi ($keys, $ttl = null) {
    }

    function delete ($key) {
    }

    function add ($key, $val, $ttl = null) {
    }

    function replace ($key, $val, $ttl = null) {
    }

    function set ($key, $val, $ttl = null) {
    }

    function flush_all() {
    }
}
?>
