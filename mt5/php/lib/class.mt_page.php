<?php
# Movable Type (r) (C) 2001-2010 Six Apart, Ltd. All Rights Reserved.
# This code cannot be redistributed without permission from www.sixapart.com.
# For more information, consult your Movable Type license.
#
# $Id: class.mt_page.php 4196 2009-09-04 07:46:50Z takayama $

require_once("class.mt_entry.php");

/***
 * Class for mt_entry (Page)
 */
class Page extends Entry
{
	function Save() {
        if (empty($this->entry_class))
            $this->entry_class = 'page';
        return parent::Save();
    }

    public function folder() {
        return $this->category();
    }
}

// Relations
ADODB_Active_Record::ClassHasMany('Page', 'mt_entry_meta','entry_meta_entry_id');	
