<?php
Rhaco::import('view.Utatane');
Rhaco::import('model.Uploader');
Rhaco::import('model.UploaderCategory');

class UtataneApi extends Utatane
{
    /**
     * 自分のホーム
     */
    function index(){
		$object = new Uploader();
	    $criteria = new C(Q::eq(Uploader::columnDeleteFlag(), 0));
		$criteria->q(Q::pager(200));
	    //$criteria = new C(Q::eq(Uploader::columnDeleteFlag(), 0), Q::join(Uploader::columnCategoryId(), UploaderCategory::columnId()), Q::pager(10));
	    $this->_setParser($object, "api/index.html", "search.html");
		// echo '<pre>';
	    $result = parent::read($object, $criteria);
		$eol = "";
		foreach($result->variables['object_list'] as $data) {
			$tags = array();
			if(! empty($data->tag01)) $tags[] = $data->tag01;
			if(! empty($data->tag02)) $tags[] = $data->tag02;
			if(! empty($data->tag03)) $tags[] = $data->tag03;
			if(! empty($data->tag04)) $tags[] = $data->tag04;
			if(! empty($data->tag05)) $tags[] = $data->tag05;
			if(! empty($data->tag06)) $tags[] = $data->tag06;
			if(! empty($data->tag07)) $tags[] = $data->tag07;
			if(! empty($data->tag08)) $tags[] = $data->tag08;
			if(! empty($data->tag09)) $tags[] = $data->tag09;
			if(! empty($data->tag10)) $tags[] = $data->tag10;
			echo 'comment:'.$data->comment.',' . $eol;
			echo 'downloadPath:'.$data->downloadPath.',' . $eol;
			echo 'downloadCount:'.$data->downloadCount.',' . $eol;
			echo 'size:'.$data->size.',' . $eol;
			echo 'mime:'.$data->mime.',' . $eol;
			echo 'updatedAt:'.$data->updatedAt.',' . $eol;
			echo 'createdAt:'.$data->createdAt.',' . $eol;
			echo 'categoryId:'.$data->factCategoryId->id.',' . $eol;
			echo 'tags:'.implode('|', $tags).',' . $eol;
			echo '&&&&&';
		}
		// echo '</pre>';
		exit;
    }
}