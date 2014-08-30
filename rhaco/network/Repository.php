<?php
class Repository{
	/**
	 * repository serverからdownloadする
	 * 要 Zlibモジュール
	 * 
	 * @param string $repository_name
	 * @param string $package
	 * @param string $download_path
	 * @return boolean
	 */
	function download($repository_name,$package,$download_path){
		$path_list = explode(".",$package);
		$domain = $path_list[1].".".$path_list[0];
		unset($path_list[1],$path_list[0]);

		while(true){
			$server = Repository::getServerAddress($domain);
			if($server === false) return false;
			$uri = str_replace(".","/",$package);

			if(Http::body($server."/__repository__.php/".$repository_name."/state/".$uri) !== false){
				$fp = gzopen($server."/__repository__.php/".$repository_name."/download/".$uri,"rb");
				$buf = null;
				while(!gzeof($fp)) $buf .= gzread($fp,4096);
				gzclose($fp);
				
				FileUtil::untar($buf,$download_path);
				return true;
			}
			if(empty($path_list)) break;
			$domain = array_shift($path_list).".".$domain;
		}
		return false;		
	}
	/**
	 * repository server名を返す
	 * 見つからない場合はfalseを返す
	 * 
	 * @param string $url
	 * @return string
	 */
	function getServerAddress($url){
		$server = $url;
		if(strpos($server,"://") === false) $server = "http://".$server;
		if(substr($server,-1) == "/") $server = substr($server,0,-1);
		if(Http::body($server."/__repository__.php/check") !== false) return $server;

		$body = Http::body($server."/__repository__.xml");
		if($body !== false){
			if(SimpleTag::setof($tag,$body,"map")){
				foreach($tag->getIn("repository") as $alias){
					return Repository::getServerAddress($alias->getParameter("url",trim($alias->getValue())));
				}
			}
		}
		ExceptionTrigger::clear();
		return false;
	}
}
?>