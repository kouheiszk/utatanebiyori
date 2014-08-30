<?php
Rhaco::import('view.Utatane');
Rhaco::import('model.Users');
Rhaco::import('model.Statuses');
Rhaco::import('model.Followers');
Rhaco::import('UtataneFormatter');
Rhaco::import('tag.model.TemplateFormatter');

class UtataneStatus extends Utatane
{
    /**
     * 自分のホーム
     */
    function home(){
        $users = $this->loginRequired();

        $statuses = new Whisper();
        $s_criteria = new C(Q::eq(Whisper::columnUserId(), $users->id), Q::orc(Q::selectIn(Whisper::columnUserId(), Followers::columnFollowId(), new C(Q::eq(Followers::columnUserId(), $users->id)))));
        parent::read($statuses, $s_criteria);

        $this->setUpdateInformation();

        $parser = $this->parser('home.html');
        return $this->filterUser($parser, $users);
    }

    /**
     * 返信
     */
    function reply($id){
        $users = $this->loginRequired();
        $statuses = $this->dbUtil->get(new Statuses(), new C(Q::eq(Statuses::columnId(), $id), Q::fact()));
        if(Variable::istype('Statuses', $statuses)){
            if(!$statuses->factUserId->hasPermission($this->dbUtil, RequestLogin::getLoginSession()))
                return $this->_forbidden();
            $this->setVariable('object', $statuses);
            $parser = $this->parser('reply.html');
            return $this->filterUser($parser, $users);
        }
        return $this->_notFound();
    }

    /**
     * 更新
     */
    function update(){
        $users = $this->loginRequired();
        $this->_update($users);
        Header::redirect(Rhaco::url('home'));
    }
    function update_ajax(){
        $users = $this->loginRequired();
        if($statuses = $this->_update($users)){
            $statuses->comment = UtataneFormatter::comment($statuses->comment);
            $statuses->createdAt = $statuses->formatCreatedAt();
            $users->password = null;
            return $this->_json(array(
                'success' => 1,
                'users' => ObjectUtil::objectConvHash($users),
                'statuses' => ObjectUtil::objectConvHash($statuses),
            ));
        }
        $messages = array();
        if(ExceptionTrigger::invalid())
            foreach(ExceptionTrigger::get() as $e) $messages[] = $e->getMessage();
        $this->_json(array(
            'errors' => 1,
            'messages' => $messages,
        ));
        Header::redirect(Rhaco::url('home'));
    }
    function _update($users){
        if($this->isPost()){
            $this->clearVariable('id', 'reply_user_id', 'created_at');
            if($this->isVariable('replyto')) $this->setVariable('comment', $this->getVariable('replyto'). $this->getVariable('comment'));
            $statuses = $this->toObject(new Statuses());
            $statuses->setUserId($users->id);
            if($statuses->save($this->dbUtil)){
                return $statuses;
            }
        }
        return false;
    }
    function destroy($statusesId){
        $users = $this->loginRequired();
        $this->isCsrf();
        if(!ExceptionTrigger::invalid()){
            $this->dbUtil->delete(new Statuses(), new C(Q::eq(Statuses::columnUserId(), $users->id), Q::eq(Statuses::columnId(), $statusesId)));
        }
        Header::redirect(Rhaco::url('home'));
    }
    /**
     * 他人から見たユーザーのページ
     */
    function user($userId=null){
        $user = $this->dbUtil->get(new Users(), new C(Q::eq(Users::columnUserId(), $userId)));
        $this->setTemplate('user.html');
        if(!Variable::istype('Users', $user) || !$user->hasPermission($this->dbUtil, RequestLogin::getLoginSession())){
            return $this->_forbidden();
        }
        $parser = parent::read(new Statuses(), new C(Q::eq(Statuses::columnUserId(), $user->id), Q::pager(5)));
        return $this->filterUser($parser, $user);
    }
    /**
     * 自分の発言一覧
     */
    function archive(){
        $user = $this->loginRequired();
        $this->setTemplate('archive.html');
        if(!Variable::istype('Users', $user) || !$user->hasPermission($this->dbUtil, RequestLogin::getLoginSession())){
            return $this->_forbidden();
        }
        $parser = parent::read(new Statuses(), new C(Q::eq(Statuses::columnUserId(), $user->id), Q::pager(20)));
        return $this->filterUser($parser, $user);
    }
    /**
     * 自分への返信一覧
     */
    function replies(){
        $users = $this->loginRequired();
        $parser = parent::read(new Statuses(), new C(Q::eq(Statuses::columnReplyUserId(), $users->id), Q::fact(), Q::pager(20)));
        $parser->setTemplate('replies.html');
        return $this->filterUser($parser, $users);
    }
    /**
     * 削除
     */
    function delete($id){
        $users = $this->loginRequired();
        $statuses = $this->dbUtil->get(new Statuses(), new C(Q::eq(Statuses::columnId(), $id), Q::fact()));
        if(Variable::istype('Statuses', $statuses)){
            if(!$statuses->factUserId->hasPermission($this->dbUtil, RequestLogin::getLoginSession()))
                return $this->_forbidden();
            $this->setVariable('object', $statuses);
            $parser = $this->parser('delete.html');
            return $this->filterUser($parser, $statuses->factUserId);
        }
        return $this->_notFound();
    }
    /**
     * 公開タイムライン
     */
    function public_timeline(){
        $parser = parent::read(new Statuses(), new C(Q::neq(Users::columnPrivateFlag(), true), Q::pager(20)));
        //if(RequestLogin::isLoginSession()){
        //    $parser->setTemplate('home.html');
        //    return $this->filterUser($parser, RequestLogin::getLoginSession());
        //}
        $parser->setTemplate('public_timeline.html');
        return $parser;
    }
}