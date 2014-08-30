<?php
Rhaco::import('exception.model.RequireException');
Rhaco::import('exception.model.PermissionException');
Rhaco::import('network.mail.Mail');
Rhaco::import('io.ImageEx');
Rhaco::import("model.table.UsersTable");
/**
 *
 */
class Users extends UsersTable{

  var $array_of_user_id;

  var $denyName = array('signup', 'account', 'public_timeline', 'login', 'logout', 'sessions',
        'hoge', 'replies', 'status', 'statuses', 'friends', 'followers', 'friendships', 'friend_requests');

    function beforeInsert(&$db){
        if(ExceptionTrigger::invalid()) return false;
        if(in_array($this->userName, $this->denyName)) return ExceptionTrigger::raise(new GenericException('使用出来ない名前です。'));
        $this->_genUserId();
        $this->_hpswd();
        $this->_genActKey();
        return true;
    }
    function afterInsert(&$db){
        // メールを送る
        $mail  = new Mail(Rhaco::constant('MAIL_ADDRESS'), Rhaco::constant('SITE_NAME'));
        $mail->to($this->email, $this->userName);
        $mail->subject('Welcome');
        $mail->message(Rhaco::url('activate/'. $this->actKey));
        $mail->send();
        return true;
    }

    function beforeUpdate(&$db){
        if(ExceptionTrigger::invalid()) return false;
        if(RequestLogin::isLoginSession()){
            $users = RequestLogin::getLoginSession();
            if($users->id == $this->id && !empty($this->newPassword) && $this->newPassword == $this->passwordConf){
                $this->password = $this->newPassword;
                $this->_hpswd();
            }
        }
        $request = new Request();
        if($request->isFile('pic')){
            $length = 500;
            $file = $request->getFile('pic');
            $image = new ImageEx();
            $image->loadFile($file->tmp);
            $image->fitin($length, $length);
            if($image->save(Rhaco::resource('templates/img/user/'). $this->userId. $file->extension)){
                $this->image = $this->userId. $file->extension;
                $this->imageX = $image->getXLength($length);
                $this->imageY = $image->getYLength($length);
            }
        }
        return true;
    }

    function afterUpdate(&$db){
        if(RequestLogin::isLoginSession()){
            $users = RequestLogin::getLoginSession();
            if($this->id === $users->id) RequestLogin::setLoginSession($this);
        }
        return true;
    }

    function _hpswd(){
        /***
         * $users = new Users();
         * $users->password = 'hoge';
         * eq(sha1('hoge'), $users->_hpswd());
         * eq(sha1('hoge'), $users->password);
         */
        return $this->password = sha1($this->password);
    }
    function _genActKey(){
        $this->actKey = md5((string) time(). mt_rand(0, 9999));
    }
    function _genUserId($length = 8){
        $charlist = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        mt_srand();
        $res = "";
        for($i = 0; $i < $length; $i++)
            $res .= $charlist{mt_rand(0, strlen($charlist) - 1)};
        $this->userId = $res;
    }

    /**
     * ゲストユーザーの取得
     */
    function getGuestUser(&$db){
      $model = new Users();
      $criteria = new C(Q::eq(Users::columnId(), Rhaco::constant('GUEST_USER_ID')));
      return $db->get($model, $criteria);
    }

    /**
     * ユーザーID(8文字の英数字)からユーザーを取得
     */
    function getUserByUserId(&$db, $user_id = null){
      if(empty($user_id)){
        return Users::getGuestUser();
      }
      $model = new Users();
      $criteria = new C(Q::eq(Users::columnUserId(), $user_id));
      return $db->get($model, $criteria);
    }

    function getArrayOfUserId(&$db){
      if(empty($this->array_of_user_id)){
        $this->array_of_user_id = array();
        $model = new Users();
        $criteria = null;
        $objects = $db->select($model, $criteria);
        foreach($objects as $key => $object){
          $this->array_of_user_id[$object->userId] = $object;
        }
      }
      return $this->array_of_user_id;
    }

    /**
     * ユーザー見れますか？
     */
    function hasPermission(&$db, $users = null){
        if(!$this->isPrivateFlag()) return true;
        if(Variable::istype('Users', $users)){
            if($this->id === $users->id) return true;
            $followers = $db->get(new Followers(), new C(
                Q::eq(Followers::columnUserId(), $this->id),
                Q::eq(Followers::columnFollowId(), $users->id)
            ));
            if(Variable::istype('Followers', $followers)) return true;
        }
        return ExceptionTrigger::raise(new PermissionException($this->userId));
    }

    /**
     * ログイン判定を行う
     */
    function loginCondition(&$db, &$var, $request){
        // verify
        if(!$request->isPost()) return false;
        if(!$request->isVariable('email') || !$request->getVariable('email'))
            ExceptionTrigger::raise(new RequireException('email'));
        if(!$request->isVariable('password') || !$request->getVariable('password'))
            ExceptionTrigger::raise(new RequireException('password'));
        if(ExceptionTrigger::invalid()) return false;

        // login
        $users = $db->get(new Users(), new C(
            Q::eq(Users::columnEmail(), $request->getVariable('email')),
            Q::eq(Users::columnPassword(), sha1($request->getVariable('password')))
        ));
        if(Variable::istype('Users', $users)){
            if(!empty($users->actKey)) return ExceptionTrigger::raise(new GenericException('アクティベージョンが完了していません'));
            $var = $users;
            if($request->getVariable('remember'))
                RequestLogin::setLoginCookie(
                    $request->getVariable('email').','.$request->getVariable('password'));
            return true;
        }
        return false;
    }
    function loginConditionCookie(&$db, &$var, $cookie){
        if(strpos($cookie, ',') === false) return false;
        list($email, $password) = explode(',', $cookie, 2);
        if(empty($email) || empty($password)) return false;
        $users = $db->get(new Users(), new C(
            Q::eq(Users::columnEmail(), $email),
            Q::eq(Users::columnPassword(), sha1($password))
        ));
        if(Variable::istype('Users', $users)){
            $var = $users;
            return true;
        }
        return false;
    }
}

?>