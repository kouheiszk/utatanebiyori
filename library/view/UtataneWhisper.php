<?php
Rhaco::import('view.Utatane');
Rhaco::import('model.Whisper');
Rhaco::import('model.Users');

class UtataneWhisper extends Utatane
{
  /**
   * Whispトップ
   */
  function index(){
    $user = $this->getLoginUser();
    $this->_setParser($object, "whisper/index.html", "list.html");
    $this->setVariable('status_list', Whisper::getStatusList($this->dbUtil, $user->id));
    return $this->filterUser($this->parser(), $user);
  }

  /**
   * 公開タイムライン
   */
  function public_timeline(){
    $object = new Whisper();
    $user = Users::getGuestUser();
    $this->setVariable('recent_whisp', Whisper::getRecentWhispByUserId($user));
    $this->_setParser($object, "whisper/public_timeline.html", "list.html");
    return parent::read($object, Whisper::getCriteria($user->id));
  }


  /**
   * 投稿
   */
  function update(){
    $whisper = new Whisper();
    $filterargs = array();
    $filters = array();

    $this->_addFitler($filters);
    if($this->_connection($whisper)){
      $object = null;
      if($this->isPost() && !ExceptionTrigger::isException()){
        if($this->isVariable('reply_user_id')) $this->setVariable('status', $this->getVariable('reply_user_id'). $this->getVariable('status'));
        $object = $this->dbUtil->insert($this->toObject($whisper));
        if(Variable::istype("Whisper",$object)){
          ObjectUtil::calls($this->filters,"afterCreate",array_merge(array($object),ArrayUtil::arrays($filterargs)));
          Header::redirect(Rhaco::url('whisper/'));
        }
      }
      $this->setVariable(ObjectUtil::objectConvHash($object));
      $this->setVariable("object",$whisper);
      $this->_setParser($whisper,"whisper/status_update.html","form.html");
    }else{
      $this->_notFound();
    }
    return $this->parser();
  }

  /**
   * 返信
   */
  function reply($id){
    $user = $this->getLoginUser();
    $whisp = Whisper::getStatusByKey($this->dbUtil, $id);
    if(Variable::istype('Whisper', $whisp)){
      if(!$whisp->factUserId->hasPermission($this->dbUtil, RequestLogin::getLoginSession())) return $this->_forbidden();
      $this->setVariable('status', $whisp);
      $this->setVariable('reply_status_id', $whisp->replyStatusId);
      $this->setVariable('reply_user_id', $whisp->replyUserId);
      $this->setVariable('source', $whisp->status);
      $this->setVariable('status_list', Whisper::getStatusList($this->dbUtil, $user->id));
      $parser = $this->parser('whisper/reply.html');
      return $this->filterUser($parser, $user);
    }
    return $this->_notFound();
  }
}
