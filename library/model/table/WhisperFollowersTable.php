<?php
Rhaco::import("resources.Message");
Rhaco::import("database.model.TableObjectBase");
Rhaco::import("database.model.DbConnection");
Rhaco::import("database.TableObjectUtil");
Rhaco::import("database.model.Table");
Rhaco::import("database.model.Column");
/**
 * #ignore
 * 
 */
class WhisperFollowersTable extends TableObjectBase{
	/**  */
	var $userId;
	/**  */
	var $followId;
	/**  */
	var $createdAt;
	var $factUserId;
	var $factFollowId;


	function WhisperFollowersTable(){
		$this->__init__();
	}
	function __init__(){
		$this->userId = null;
		$this->followId = null;
		$this->createdAt = time();
	}
	function connection(){
		if(!Rhaco::isVariable("_R_D_CON_","utatanebiyori")){
			Rhaco::addVariable("_R_D_CON_",new DbConnection("utatanebiyori"),"utatanebiyori");
		}
		return Rhaco::getVariable("_R_D_CON_",null,"utatanebiyori");
	}
	function table(){
		if(!Rhaco::isVariable("_R_D_T_","WhisperFollowers")){
			Rhaco::addVariable("_R_D_T_",new Table(Rhaco::constant("DATABASE_utatanebiyori_PREFIX")."whisper_followers",__CLASS__),"WhisperFollowers");
		}
		return Rhaco::getVariable("_R_D_T_",null,"WhisperFollowers");
	}


	/**
	 * 
	 * @return database.model.Column
	 */
	function columnUserId(){
		if(!Rhaco::isVariable("_R_D_C_","WhisperFollowers::UserId")){
			$column = new Column("column=user_id,variable=userId,type=integer,size=22,unique=true,reference=Users::Id,uniqueWith=WhisperFollowers::FollowId,",__CLASS__);
			$column->label(Message::_("user_id"));
			Rhaco::addVariable("_R_D_C_",$column,"WhisperFollowers::UserId");
		}
		return Rhaco::getVariable("_R_D_C_",null,"WhisperFollowers::UserId");
	}
	/**
	 * 
	 * @return integer
	 */
	function setUserId($value){
		$this->userId = TableObjectUtil::cast($value,"integer");
	}
	/**
	 * 
	 */
	function getUserId(){
		return $this->userId;
	}
	/**
	 * 
	 * @return database.model.Column
	 */
	function columnFollowId(){
		if(!Rhaco::isVariable("_R_D_C_","WhisperFollowers::FollowId")){
			$column = new Column("column=follow_id,variable=followId,type=integer,size=22,unique=true,reference=WhisperFollowedUsers::Id,uniqueWith=WhisperFollowers::UserId,",__CLASS__);
			$column->label(Message::_("follow_id"));
			Rhaco::addVariable("_R_D_C_",$column,"WhisperFollowers::FollowId");
		}
		return Rhaco::getVariable("_R_D_C_",null,"WhisperFollowers::FollowId");
	}
	/**
	 * 
	 * @return integer
	 */
	function setFollowId($value){
		$this->followId = TableObjectUtil::cast($value,"integer");
	}
	/**
	 * 
	 */
	function getFollowId(){
		return $this->followId;
	}
	/**
	 * 
	 * @return database.model.Column
	 */
	function columnCreatedAt(){
		if(!Rhaco::isVariable("_R_D_C_","WhisperFollowers::CreatedAt")){
			$column = new Column("column=created_at,variable=createdAt,type=timestamp,",__CLASS__);
			$column->label(Message::_("created_at"));
			Rhaco::addVariable("_R_D_C_",$column,"WhisperFollowers::CreatedAt");
		}
		return Rhaco::getVariable("_R_D_C_",null,"WhisperFollowers::CreatedAt");
	}
	/**
	 * 
	 * @return timestamp
	 */
	function setCreatedAt($value){
		$this->createdAt = TableObjectUtil::cast($value,"timestamp");
	}
	/**
	 * 
	 */
	function getCreatedAt(){
		return $this->createdAt;
	}
	/**  */
	function formatCreatedAt($format="Y/m/d H:i:s"){
		return DateUtil::format($this->createdAt,$format);
	}


	function getFactUserId(){
		return $this->factUserId;
	}
	function setFactUserId($obj){
		$this->factUserId = $obj;
	}
	function getFactFollowId(){
		return $this->factFollowId;
	}
	function setFactFollowId($obj){
		$this->factFollowId = $obj;
	}
}
?>