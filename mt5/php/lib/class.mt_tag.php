<?php
# Movable Type (r) (C) 2001-2010 Six Apart, Ltd. All Rights Reserved.
# This code cannot be redistributed without permission from www.sixapart.com.
# For more information, consult your Movable Type license.
#
# $Id: class.mt_tag.php 4196 2009-09-04 07:46:50Z takayama $

require_once("class.baseobject.php");

/***
 * Class for mt_tag
 */
class Tag extends BaseObject
{
    public $_table = 'mt_tag';
    protected $_prefix = "tag_";
}

