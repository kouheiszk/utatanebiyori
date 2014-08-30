<?php
Rhaco::import("model.table.WhisperTable");
/**
 *
 */
class Statuses extends WhisperTable{
    function beforeInsert($db){
        if(ExceptionTrigger::invalid()) return false;
        if($this->comment{0} == '>' && preg_match('/^>>(.+?)\s/', $this->comment, $match)){
            $users = $db->get(new Users(), new C(Q::eq(Users::columnUserId(), $match[1])));
            if(Variable::istype('Users', $users) && $users->id != $this->userId){
                $this->replyUserId = $users->id;
            }
        }
    }
    function views(){
        return array(
            'ordering' => '-id',
        );
    }
}

?>