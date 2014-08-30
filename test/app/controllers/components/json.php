<?php

App::import('Vendor', 'Json', array('file'=>'Jsphon'.DS.'Decoder.php'));

class JsonComponent extends Object
{
	function decode($data)
	{
		$json = new Jsphon_Decoder();
		return $json->decode($data);
	}
}