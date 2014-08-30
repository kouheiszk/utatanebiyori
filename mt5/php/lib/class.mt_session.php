<?php
# Movable Type (r) (C) 2001-2010 Six Apart, Ltd. All Rights Reserved.
# This code cannot be redistributed without permission from www.sixapart.com.
# For more information, consult your Movable Type license.
#
# $Id: class.mt_session.php 4196 2009-09-04 07:46:50Z takayama $

require_once("class.baseobject.php");

/***
 * Class for mt_session
 */
class Session extends BaseObject
{
    public $_table = 'mt_session';
    protected $_prefix = "session_";

    public function data() {
        $mt = MT::get_instance();
        $this->_data = $mt->db()->unserialize($this->data);

        return $this->_data;
    }
}

