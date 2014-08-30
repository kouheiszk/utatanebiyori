<?php
Rhaco::import('network.mail.Mail');
Rhaco::import('model.Users');
Rhaco::import('model.Followers');
Rhaco::import("model.table.RequestsTable");
/**
 * 
 */
class Requests extends RequestsTable{
    function afterInsert(&$db){
        $users = $db->get(new Users($this->requestId));
        if(Variable::istype('Users', $users)){
            $mail  = new Mail(Rhaco::constant('MAIL_ADDRESS'), Rhaco::constant('SITE_NAME'));
            $mail->to($users->email, $users->userName);
            $mail->subject('New Friend Request');
            $mail->message(Rhaco::url('requests'));
            $mail->send();
        }
    }
    function accept(&$db){
        $followers = new Followers();
        $followers->setUserId($this->requestId);
        $followers->setFollowId($this->userId);
        $db->insert($followers);
        $followers = new Followers();
        $followers->setUserId($this->userId);
        $followers->setFollowId($this->requestId);
        if($db->insert($followers))
            return $db->delete($this);
        return false;
    }
}

?>