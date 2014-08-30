<?php
# Movable Type (r) (C) 2001-2010 Six Apart, Ltd. All Rights Reserved.
# This code cannot be redistributed without permission from www.sixapart.com.
# For more information, consult your Movable Type license.
#
# $Id: class.mt_plugindata.php 4196 2009-09-04 07:46:50Z takayama $

require_once("class.baseobject.php");

/***
 * Class for mt_plugindata
 */
class PluginData extends BaseObject
{
    public $_table = 'mt_plugindata';
    protected $_prefix = "plugindata_";
    private $_data = null;

    public function data($name = null) {
        $mt = MT::get_instance();
        $this->_data = $mt->db()->unserialize($this->data);

        if (!empty($name))
            if (isset($this->_data[$name]))
                return $this->_data[$name];
            else
                return null;
        else
            return $this->_data;

    }

}
