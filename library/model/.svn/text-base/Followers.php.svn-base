<?php
Rhaco::import('model.Requests');
Rhaco::import("model.table.FollowersTable");
/**
 * 
 */
class Followers extends FollowersTable{
    function beforeInsert($db){
        $users = is_object($this->factFollowId) ? $this->factFollowId : $db->get(new Users($this->followId));
        if(Variable::istype('Users', $users)){
            if(!$users->isPrivateFlag()){
                return true;
            }
            $followers = $db->get(new Followers(), new C(Q::eq(Followers::columnUserId(), $this->followId), Q::eq(Followers::columnFollowId(), $this->userId)));
            if(Variable::istype('Followers', $followers)){
                return true;
            } else {
                $requests = new Requests();
                $requests->setUserId($this->userId);
                $requests->setRequestId($this->followId);
                $db->insert($requests);
            }
        }
        return false;
    }
}

?>