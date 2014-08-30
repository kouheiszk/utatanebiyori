<?php
Rhaco::import('view.Utatane');
Rhaco::import('model.Uploader');
Rhaco::import('model.UploaderCategory');

class UtataneUploader extends Utatane
{
  /**
   * トップの表示
   */
  function index(){
    $object = new Uploader();
    $criteria = new C(Q::eq(Uploader::columnDeleteFlag(), 0), Q::fact(), Q::depend());
    //$criteria = new C(Q::eq(Uploader::columnDeleteFlag(), 0), Q::join(Uploader::columnCategoryId(), UploaderCategory::columnId()), Q::pager(10));
    $this->_setParser($object, "uploader/index.html", "search.html");
    return parent::read($object, $criteria);
  }

  /**
   * アップロード
   */
  function create(){
    $uploader = new Uploader();
    $filterargs = array();
    $filters = array();

    $this->_addFitler($filters);
    if($this->_connection($uploader)){
      $object = null;
      if($this->isPost() && !ExceptionTrigger::isException()){
        $object = $this->dbUtil->insert($this->toObject($uploader));
        if(Variable::istype("Uploader",$object)){
          ObjectUtil::calls($this->filters,"afterCreate",array_merge(array($object),ArrayUtil::arrays($filterargs)));
          Header::redirect(Rhaco::url('uploader/upload_success'));
        }
      }
      $this->setVariable(ObjectUtil::objectConvHash($object));
      $category_list = UploaderCategory::getCategoryList();
      $this->setVariable("category_list",$category_list);
      $this->setVariable("object",$uploader);
      $this->_setParser($uploader,"uploader/upload.html","form.html");
    }else{
      $this->_notFound();
    }
    return $this->parser();
  }

  /**
   * アップロード完了
   */
  function uploadSuccess(){
    $this->setVariable("title",_("アップロード完了"));
    $this->setVariable("message",_("アップロードが完了しました。"));
    return $this->parser('uploader/success.html');
  }

  /**
   * アップロードファイル詳細
   */
  function detail($id){
    if(empty($id) || !is_numeric($id)){
      return $this->_notFound();
    }

    $uploader = new Uploader();
    $criteria = new C(Q::eq(Uploader::columnId(), $id), Q::fact());
    $filterargs = array();
    $filters = array();

    $this->_addFitler($filters);
    if($this->_connection($uploader)){
      $uploader = $this->dbUtil->get($uploader,$this->_primaryCriteria($uploader,$criteria));
      if(!Variable::istype("Uploader",$uploader)){
        $this->_notFound();
      }else{
        if($this->isPost() && !ExceptionTrigger::isException()){
          $uploader = $this->toObject($uploader);
          if(Variable::istype("Uploader",$uploader) && $this->dbUtil->update($uploader)){
            ObjectUtil::calls($this->filters,"afterUpdate",array_merge(array($uploader),ArrayUtil::arrays($filterargs)));
            Header::redirect(Rhaco::url('uploader/detail/').$uploader->id);
          }
        }
        $this->setVariable(ObjectUtil::objectConvHash($uploader));
        $this->setVariable("object",$uploader);
        $this->_setParser($uploader,"uploader/detail.html","detail.html");
      }
    }else{
      return $this->_notFound();
    }
    return $this->parser();
  }

  /**
   * ダウンロード
   */
  function download($id){
    if(empty($id) || !is_numeric($id)){
      return $this->_notFound();
    }

    $uploader = new Uploader();
    $criteria = new C(Q::eq(Uploader::columnId(), $id), Q::fact());

    if($this->_connection($uploader)){
      $uploader = $this->dbUtil->get($uploader,$this->_primaryCriteria($uploader,$criteria));
      if(!Variable::istype("Uploader",$uploader)){
        $this->_notFound();
      }else{
        $file_path = "";
        if($this->isPost()){
          if(!$this->isLogin()){
            $post_password = $this->getVariable('download_key');
            $password_list = explode(',', Rhaco::constant('DOWNLOAD_PASSWORD'));
            $check = false;
            foreach($password_list as $key => $password){
              if($post_password === $password) $check = true;
            }
            if($check || (!empty($post_password) && !empty($uploader->downloadKey) && $uploader->downloadKey === $post_password)){
              $file_path = Rhaco::constant('CONTEXT_URL').Rhaco::constant('UPLOAD_URL').$uploader->downloadPath;
              $this->addDownloadCount($uploader);
            }else{
              $this->setSession('login_message', "パスワードが違います。戻って再度入力するかログインしてください。");
              $this->loginRequired();
            }
          }else{
            $file_path = Rhaco::constant('CONTEXT_URL').Rhaco::constant('UPLOAD_URL').$uploader->downloadPath;
            $this->addDownloadCount($uploader);
          }
        }else{
          if($this->isLogin()){
            $file_path = Rhaco::constant('CONTEXT_URL').Rhaco::constant('UPLOAD_URL').$uploader->downloadPath;
            $this->addDownloadCount($uploader);
          }else{
            Header::redirect(Rhaco::url('uploader/detail/').$uploader->id);
          }
        }
        $this->setVariable(ObjectUtil::objectConvHash($uploader));
        $this->setVariable("file_url",$file_path);
        $this->setVariable("object",$uploader);
        $this->_setParser($uploader,"uploader/download.html","detail.html");
      }
    }else{
      return $this->_notFound();
    }
    return $this->parser();
  }

  /**
   * ダウンロード数を増やす
   */
  function addDownloadCount($uploader){
    if(!Variable::istype("Uploader",$uploader)){
      $this->_notFound();
    }else{
      $uploader->downloadCount++;
      if(!ExceptionTrigger::isException()){
        if(Variable::istype("Uploader",$uploader) && $this->dbUtil->update($uploader)){
          return true;
        }
      }
    }
    return false;
  }

  /**
   * 更新する
   */
  function update($wiki_name = null){
    $uploader = new Uploader();
    $criteria = new C(Q::eq(Uploader::columnWikiName(), $wiki_name), Q::fact());
    $filterargs = array();
    $filters = array();

    //キャンセルが押された
    if($this->isVariable('cancel')){
      Header::redirect(Rhaco::url('wiki')."/".$wiki_name);
    }

    $this->_addFitler($filters);
    if($this->_connection($uploader)){
      $uploader = $this->dbUtil->get($uploader,$this->_primaryCriteria($uploader,$criteria));
      if(!Variable::istype("Uploader",$uploader)){
        $this->_notFound();
      }else{
        if($this->isPost() && !ExceptionTrigger::isException()){
          $uploader = $this->toObject($uploader);
          if(Variable::istype("Uploader",$uploader) && $this->dbUtil->update($uploader)){
            ObjectUtil::calls($this->filters,"afterUpdate",array_merge(array($uploader),ArrayUtil::arrays($filterargs)));
            Header::redirect(Rhaco::url('wiki')."/".$uploader->getWikiName());
          }
        }
        $this->setVariable(ObjectUtil::objectConvHash($uploader));
        $this->setVariable("object",$uploader);
        $this->_setParser($uploader,"wiki/edit.html","form.html");
      }
    }else{
      $this->_notFound();
    }
    return $this->parser();
  }

  /**
   * エラーページ
   * @see library/view/Utatane#_notFound()
   */
  function _notFound($name = null){
    parent::_notFound();
    $this->setVariable('pagename', $name);
    return $this->parser('wiki/error/404.html');
  }

  /**
   * ページ一覧
   */
  function _list(){
    $object = new Uploader();
    $criteria = new C(Q::order(Uploader::columnWikiName()), Q::eq(Uploader::columnDeleteFlag(), 0));
    $this->_setParser($object, "wiki/list.html", "list.html");
    return parent::read($object, $criteria);
  }

  /**
   * 履歴
   */
  function history(){
    $object = new Uploader();
    $criteria = new C(Q::orderDesc(Uploader::columnUpdatedAt()), Q::eq(Uploader::columnDeleteFlag(), 0));
    $this->_setParser($object, "wiki/history.html", "history.html");
    return parent::read($object, $criteria);
  }

  /**
   * ページ検索
   */
  function search(){
    $object = new Uploader();
    $criteria = new C(Q::order(Uploader::columnWikiName()), Q::eq(Uploader::columnDeleteFlag(), 0));
    $this->_setParser($object, "wiki/search.html", "search.html");
    return parent::read($object, $criteria);
  }

  /**
   * エンコード
   */
  function encode($str)
  {
    $str = strval($str);
    return ($str == '') ? '' : strtoupper(bin2hex($str));
    // Equal to strtoupper(join('', unpack('H*0', $str)));
    // But PHP 4.3.10 says 'Warning: unpack(): Type H: outside of string in ...'
  }

  /**
   * デコード
   */
  function decode($str)
  {
    return $this->hex2bin($str);
  }

  /**
   * Inversion of bin2hex()
   */
  function hex2bin($hex_string)
  {
    // preg_match : Avoid warning : pack(): Type H: illegal hex digit ...
    // (string)   : Always treat as string (not int etc). See BugTrack2/31
    return preg_match('/^[0-9a-f]+$/i', $hex_string) ? pack('H*', (string)$hex_string) : $hex_string;
  }
}

