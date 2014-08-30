<?php

class PagesController extends AppController
{
	var $name = 'Pages';
	var $uses = null;

	function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->allow('*');
	}

	function home()
	{
	}
}