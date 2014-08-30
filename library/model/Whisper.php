<?php
Rhaco::import("model.table.WhisperTable");
Rhaco::import("model.Users");
/**
 *
 */
class Whisper extends WhisperTable{

  /**
   * 挿入前の操作
   */
  function beforeInsert($db){
    if(ExceptionTrigger::invalid()) return false;

//    if(!Variable::istype('Users', $user) || !$user->hasPermission($this->dbUtil, RequestLogin::getLoginSession())){
//      return false;
//    }



    if($this->comment{0} == '@' && preg_match('/^@(.+?)\s/', $this->comment, $match)){
      $reply_user = Users::getUserByUserId($match[1]);
      if(Variable::istype('Users', $reply_user) && $reply_user->id != $this->userId){
        $this->replyUserId = $reply_user->id;
      }
    }
  }

  /**
   * つぶやきの一覧を取得する
   */
  function getStatusList(&$db, $id = null){
    if(!empty($id)){
      $criteria = new C(
        Q::orc(Q::eq(Whisper::columnReplyUserId(), $id)),
        Q::orc(Q::eq(Whisper::columnUserId(), $id)),
        Q::orderDesc(Whisper::columnId()),
        Q::pager(20),
        Q::fact()
      );
    }else{
      $criteria = new C(
        Q::orderDesc(Whisper::columnId()),
        Q::pager(20),
        Q::fact()
      );
    }
    return $db->select(new Whisper(), $criteria);
  }

  function getStatusByKey(&$db, $id = null){
    if(!empty($id)){
      $criteria = new C(Q::eq(Whisper::columnId(), $id), Q::fact());
      return $db->get(new Whisper(), $criteria);
    }
    return null;
  }

  /**
   * 一覧表示のオプション
   */
  function views(){
    return array(
      'ordering' => '-id',
    );
  }
}

?>