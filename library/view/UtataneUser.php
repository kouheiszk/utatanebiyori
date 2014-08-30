<?php
Rhaco::import('view.Utatane');
Rhaco::import('model.Users');

class UtataneUser extends Utatane
{
  /**
   * 他人から見たユーザーページ
   */
  function user($user_id = null){
    if(empty($user_id)){
      $user = Users::getGuestUser($this->dbUtil);
    }else{
      $user = Users::getUserByUserId($this->dbUtil, $user_id);
    }
    if(!Variable::istype('Users', $user) || !$user->hasPermission($this->dbUtil, RequestLogin::getLoginSession())){
      return $this->_forbidden();
    }
    $this->setTemplate('user.html');
    $this->setVariable('status_list', $this->dbUtil->select(new Whisper(), new C(Q::eq(Whisper::columnUserId(), $user->id), Q::pager(20), Q::fact())));
    return $this->filterUser($this->parser(), $user);
  }

  /**
   * ユーザー登録
   */
  function signup(){
    if(RequestLogin::isLoginSession()) Header::redirect(Rhaco::url('home'));
    return $this->parser('signup.html');
  }
  function create(){
    if($this->isPost()){
      $this->clearVariable('id', 'image', 'createdAt', 'updatedAt', 'deleteFlag');
      if($this->dbUtil->insert($this->toObject(new Users()))){
        return $this->parser('account/create.html');
      }
    }
    return $this->parser('signup.html');
  }
  function settings(){
    $users = $this->loginRequired();
    $this->setTemplate('settings.html');
    if(!$this->isVariable('privateFlag')) $this->setVariable('privateFlag', false);
    $this->clearVariable('id', 'userId', 'password', 'createdAt', 'actKey', 'deleteFlag');
    return parent::update($users);
    Header::redirect(Rhaco::url('account/settings'));
  }
  function account(){
    $users = $this->loginRequired();
    $this->setTemplate('settings.html');
    $this->clearVariable('id', 'userId', 'userName', 'password', 'createdAt', 'actKey', 'deleteFlag');
    return parent::update($users);
    Header::redirect(Rhaco::url('account/settings'));
  }
  function picture(){
    $users = $this->loginRequired();
    if($this->isPost() && $this->isVariable('delete')){
      @unlink(Rhaco::resource('templates/img/user/'). $users->image);
      $users->image = null;
      $this->dbUtil->update($users);
    }
    $this->setTemplate('settings.html');
    $this->clearVariable('id', 'userId', 'email', 'password', 'createdAt', 'actKey', 'deleteFlag');
    return parent::update($users);
    Header::redirect(Rhaco::url('account/settings'));
  }
  function activate($actKey){
    $users = $this->dbUtil->get(new Users(), new C(Q::eq(Users::columnActKey(), $actKey)));
    if(Variable::istype('Users', $users)){
      $users->actKey = null;
      if($this->dbUtil->update($users))
        return $this->parser('account/activated.html');
    }
    return $this->_notFound();
  }
  function login(){
    if(!RequestLogin::isLoginSession())
      RequestLogin::login(new LoginCondition($this->dbUtil, new Users()));
    if(RequestLogin::isLoginSession()){
      $redirect_to = $this->getSession('redirect_to', Rhaco::url('index.html'));
      $this->clearSession('redirect_to');
      Header::redirect($redirect_to);
    }
    if($this->isPost()) ExceptionTrigger::raise(new GenericException('ログインに失敗しました'));
    $login_message = $this->getSession('login_message', '');
    $this->clearSession('login_message');
    if(!empty($login_message)) ExceptionTrigger::raise(new GenericException($login_message));
    return $this->parser('login.html');
  }
  function logout(){
    if(RequestLogin::isLoginSession())
      RequestLogin::logout();
    $redirect_to = $this->getSession('redirect_to', Rhaco::url('index.html'));
    $this->clearSession('redirect_to');
    Header::redirect($redirect_to);
  }
}

