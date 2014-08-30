<?php
/**
 * CSRF対策フィルター
 * 
 * @author Kazutaka Tokushima
 * @license New BSD License
 * @copyright Copyright 2008 rhaco project. All rights reserved.
 */
class HtmlCsrfFilter{
	function reset(&$request){
		if(!isset($_SESSION["_csrfid"])){
			$request->setSession("_csrfid",uniqid("csrfid").mt_rand());
		}
		Rhaco::setVariable('_csrfid', $request->getSession('_csrfid'));
	}
	function validate(&$request){
		if($request->isPost() && (!$request->isSession("_csrfid") || $request->getVariable("_csrfid") != $request->getSession("_csrfid"))){
			$request->raise(new IllegalStateException("CSRF ID"));
		}
		$request->setSession("_csrfid",uniqid("csrfid").mt_rand());
	}
	function isValid(&$request){
		if(Rhaco::isVariable('_csrfid') && $request->getVariable("_csrfid") != Rhaco::getVariable('_csrfid')){
			$request->raise(new IllegalStateException("CSRF ID"));
		}
	}
	function after($src,&$parser){
		if(preg_match("/form /i",$src) && SimpleTag::setof($tag,"<html_parser>".$src."</html_parser>","html_parser")){
			foreach($tag->getIn("form") as $obj){
				if(strpos($obj->getPlain(), '_csrfid') === false && strtolower($obj->getParameter("method")) == "post"){
					$obj->setValue("<input type=\"hidden\" name=\"_csrfid\" value=\"{\$_csrfid}\" />".$obj->getValue());
					$src = str_replace($obj->getPlain(),$obj->get(),$src);
				}
			}
		}
		return $src;
	}
}
?>