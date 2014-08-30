<?php
Rhaco::import('view.Utatane');
Rhaco::import('model.Followers');

class UtataneFriend extends Utatane
{
    /**
     * follow するよ
     */
    function create($userId){
        $login = $this->loginRequired();
        $this->isCsrf();
        $users = $this->dbUtil->get(new Users($userId));
        if(!ExceptionTrigger::invalid()){
            $followers = new Followers();
            $followers->setUserId($login->id);
            $followers->setFollowId($userId);
            $this->dbUtil->insert($followers);
        }
        Header::redirect(Rhaco::url($users->userId));
    }
    /**
     * remove するよ
     */
    function destroy($userId){
        $login = $this->loginRequired();
        $this->isCsrf();
        $users = $this->dbUtil->get(new Users($userId));
        if(!ExceptionTrigger::invalid()){
            $this->dbUtil->delete(new Followers(), new C(Q::eq(Followers::columnUserId(), $login->id), Q::eq(Followers::columnFollowId(), $userId)));
        }
        Header::redirect(Rhaco::url($users->userId));
    }
    function following($userId=null){
        if(is_null($userId) || !is_string($userId)){
            $users = $this->loginRequired();
        } else {
            $users = $this->dbUtil->get(new Users(), new C(Q::eq(Users::columnUserId(), $userId)));
        }
        if(!Variable::istype('Users', $users) || !$users->hasPermission($this->dbUtil, RequestLogin::getLoginSession())){
            return $this->_forbidden();
        }
        $parser = parent::read(new Users(), new C(Q::orc(Q::selectIn(Users::columnId(), Followers::columnFollowId(),
            new C(Q::eq(Followers::columnUserId(), $users->id))))));
        $parser->setTemplate('following.html');
        return $this->filterUser($parser, $users);
    }
    function followers($userId=null){
        if(is_null($userId) || !is_string($userId)){
            $users = $this->loginRequired();
        } else {
            $users = $this->dbUtil->get(new Users(), new C(Q::eq(Users::columnUserId(), $userId)));
        }
        if(!Variable::istype('Users', $users) || !$users->hasPermission($this->dbUtil, RequestLogin::getLoginSession())){
            return $this->_forbidden();
        }
        $parser = parent::read(new Users(), new C(Q::orc(Q::selectIn(Users::columnId(), Followers::columnUserId(),
            new C(Q::eq(Followers::columnFollowId(), $users->id))))));
        $parser->setTemplate('followers.html');
        return $this->filterUser($parser, $users);
    }

    function accept($userId){
        $login = $this->loginRequired();
        $this->isCsrf();
        $requests = $this->dbUtil->get(new Requests(), new C(Q::eq(Requests::columnRequestId(), $login->id), Q::eq(Requests::columnUserId(), $userId)));
        $requests->accept($this->dbUtil);
        Header::redirect(Rhaco::url('friend_requests'));
    }
    function deny($userId){
        $login = $this->loginRequired();
        $this->isCsrf();
        $this->dbUtil->delete(new Requests(), new C(Q::eq(Requests::columnRequestId(), $login->id), Q::eq(Requests::columnUserId(), $userId)));
        Header::redirect(Rhaco::url('friend_requests'));
    }
    function requests(){
        $users = $this->loginRequired();
        $parser = parent::read(new Users(), new C(Q::orc(Q::selectIn(Users::columnId(), Requests::columnUserId(),
            new C(Q::eq(Requests::columnRequestId(), $users->id))))));
        $parser->setTemplate('requests.html');
        return $this->filterUser($parser, $users);
    }
}