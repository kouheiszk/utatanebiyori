<?php
Rhaco::import('view.Utatane');
Rhaco::import('model.Wikis');
Rhaco::import("model.WikisBackup");

class UtataneWiki extends Utatane
{
  /**
   * トップの表示
   */
  function index(){
    $wikis = $this->dbUtil->get(new Wikis(), new C(Q::eq(Wikis::columnWikiName(), Rhaco::constant(VAR_WIKI_TOP)), Q::fact()));
    if(Variable::istype('Wikis', $wikis)){
      $this->setVariable('object', $wikis);
      return $this->parser('wiki/index.html');
    }
    return $this->_notFound();
  }
  /**
   * ページの表示
   */
  function page($wiki_name){
    $wikis = $this->dbUtil->get(new Wikis(), new C(Q::eq(Wikis::columnWikiName(), $this->decode($wiki_name)), Q::fact()));
    if(Variable::istype('Wikis', $wikis)){
      $this->setVariable('object', $wikis);
      return $this->parser('wiki/index.html');
    }
    return $this->_notFound($wiki_name);
  }

  /**
   * 作成する
   */
  function create($wiki_name = null){
    $wikis = new Wikis();
    $filterargs = array();
    $filters = array();

    $this->_addFitler($filters);
    if($this->_connection($wikis)){
      $object = null;
      if($this->isPost() && !ExceptionTrigger::isException()){
        $object = $this->dbUtil->insert($this->toObject($wikis));
        if(Variable::istype("Wikis",$object)){
          ObjectUtil::calls($this->filters,"afterCreate",array_merge(array($object),ArrayUtil::arrays($filterargs)));
          Header::redirect(Rhaco::url('wiki')."/".$object->wikiName);
        }
      }
      $this->setVariable(ObjectUtil::objectConvHash($object));
      $this->setVariable("object",$wikis);
      $this->_setParser($wikis,"wiki/new.html","form.html");
    }else{
      $this->_notFound();
    }
    $this->setVariable('wikiName', $wiki_name);
    return $this->parser();
  }

  /**
   * 更新する
   */
  function update($wiki_name = null){
    $wikis = new Wikis();
    $criteria = new C(Q::eq(Wikis::columnWikiName(), $wiki_name), Q::fact());
    $filterargs = array();
    $filters = array();

    //キャンセルが押された
    if($this->isVariable('cancel')){
      Header::redirect(Rhaco::url('wiki')."/".$wiki_name);
    }

    $this->_addFitler($filters);
    if($this->_connection($wikis)){
      $wikis = $this->dbUtil->get($wikis,$this->_primaryCriteria($wikis,$criteria));
      if(!Variable::istype("Wikis",$wikis)){
        $this->_notFound();
      }else{
        if($this->isPost() && !ExceptionTrigger::isException()){
          $wikis = $this->toObject($wikis);
          if(Variable::istype("Wikis",$wikis) && $this->dbUtil->update($wikis)){
            ObjectUtil::calls($this->filters,"afterUpdate",array_merge(array($wikis),ArrayUtil::arrays($filterargs)));
            Header::redirect(Rhaco::url('wiki')."/".$wikis->getWikiName());
          }
        }
        $this->setVariable(ObjectUtil::objectConvHash($wikis));
        $this->setVariable("object",$wikis);
        $this->_setParser($wikis,"wiki/edit.html","form.html");
      }
    }else{
      $this->_notFound();
    }
    return $this->parser();
  }

  /**
   * バックアップ
   */
  function backuplist(){
    $object = new WikisBackup();
    $criteria = new C(Q::order(Wikis::columnWikiName()), Q::eq(Wikis::columnDeleteFlag(), 0), Q::fact());
    $this->_setParser($object, "wiki/backuplist.html", "list.html");
    return parent::read($object, $criteria);
  }

  /**
   * バックアップ
   */
  function backup($wiki_name){
    $wikis = $this->dbUtil->get(new Wikis(), new C(Q::eq(Wikis::columnWikiName(), $this->decode($wiki_name))));
    if(Variable::istype('Wikis', $wikis)){
      $wikis_backup = new WikisBackup();
      $criteria = new C(Q::orderDesc(Wikis::columnCreatedAt()), Q::eq(WikisBackup::columnWikiId(), $wikis->getId()));
      $this->_setParser($object, "wiki/backup.html", "list.html");
      $this->setVariable('wikiName', $wiki_name);
      return parent::read($wikis_backup, $criteria);
    }
    return $this->_notFound();
  }

  /**
   * 差分
   */
  function diff($backup_id){
    $wikis_backup = $this->dbUtil->get(new WikisBackup(), new C(Q::eq(WikisBackup::columnId(), $backup_id)));
    if(Variable::istype('WikisBackup', $wikis_backup)){
      $wikis = $this->dbUtil->get(new Wikis(), new C(Q::eq(Wikis::columnId(), $wikis_backup->getWikiId()), Q::fact()));
      $this->setVariable('now', $wikis);
      $this->setVariable('backup_id', $backup_id);
      $object = new WikisBackup();
      $criteria = new C(Q::order(WikisBackup::columnCreatedAt()), Q::eq(WikisBackup::columnWikiId(), $wikis_backup->getWikiId()), Q::fact());
      $this->_setParser($object, "wiki/diff.html", "list.html");
      return parent::read($object, $criteria);
    }
    return $this->_notFound();
  }

  /**
   * 現在との差分
   */
  function nowdiff($backup_id){
    $wikis_backup = $this->dbUtil->get(new WikisBackup(), new C(Q::eq(WikisBackup::columnId(), $backup_id)));
    if(Variable::istype('WikisBackup', $wikis_backup)){
      $wikis = $this->dbUtil->get(new Wikis(), new C(Q::eq(Wikis::columnId(), $wikis_backup->getWikiId()), Q::fact()));
      $this->setVariable('now', $wikis);
      $this->setVariable('backup_id', $backup_id);
      $object = new WikisBackup();
      $criteria = new C(Q::order(WikisBackup::columnCreatedAt()), Q::eq(WikisBackup::columnWikiId(), $wikis_backup->getWikiId()), Q::fact());
      $this->_setParser($object, "wiki/nowdiff.html", "list.html");
      return parent::read($object, $criteria);
    }
    return $this->_notFound();
  }

  /**
   * バックアップのソース
   */
  function source($backup_id){
    $wikis_backup = $this->dbUtil->get(new WikisBackup(), new C(Q::eq(WikisBackup::columnId(), $backup_id)));
    if(Variable::istype('WikisBackup', $wikis_backup)){
      $wikis = $this->dbUtil->get(new Wikis(), new C(Q::eq(Wikis::columnId(), $wikis_backup->getWikiId()), Q::fact()));
      $this->setVariable('now', $wikis);
      $this->setVariable('backup_id', $backup_id);
      $object = new WikisBackup();
      $criteria = new C(Q::order(WikisBackup::columnCreatedAt()), Q::eq(WikisBackup::columnWikiId(), $wikis_backup->getWikiId()), Q::fact());
      $this->_setParser($object, "wiki/source.html", "list.html");
      return parent::read($object, $criteria);
    }
    return $this->_notFound();
  }

  function attach($id){
    $wikis = $this->dbUtil->get(new Wikis(), new C(Q::eq(Wikis::columnId(), $id), Q::fact()));
    if(Variable::istype('Wikis', $wikis)){
      $users = $this->loginRequired();
      $wikis_attach = new WikisAttach();
      if($this->isPost()){
        $this->dbUtil->insert($wikis_attach);
      }
      $criteria = new C(Q::order(WikisAttach::columnCreatedAt()), Q::eq(WikisAttach::columnWikiId(), $id), Q::fact());
      $this->setVariable('object', $wikis);
      $this->_setParser($object, "wiki/attach.html", "list.html");
      return parent::read($wikis_attach, $criteria);
    }
    return $this->_notFound();
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
    $object = new Wikis();
    $criteria = new C(Q::order(Wikis::columnWikiName()), Q::eq(Wikis::columnDeleteFlag(), 0));
    $this->_setParser($object, "wiki/list.html", "list.html");
    return parent::read($object, $criteria);
  }

  /**
   * 履歴
   */
  function history(){
    $object = new Wikis();
    $criteria = new C(Q::orderDesc(Wikis::columnUpdatedAt()), Q::eq(Wikis::columnDeleteFlag(), 0));
    $this->_setParser($object, "wiki/history.html", "history.html");
    return parent::read($object, $criteria);
  }

  /**
   * ページ検索
   */
  function search(){
    $object = new Wikis();
    $criteria = new C(Q::order(Wikis::columnWikiName()), Q::eq(Wikis::columnDeleteFlag(), 0));
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

