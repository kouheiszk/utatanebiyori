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
class WhisperRequestsTable extends TableObjectBase{
	/**  */
	var $userId;
	/**  */
	var $requestId;
	/**  */
	var $createdAt;
	var $factUserId;
	var $factRequestId;


	function WhisperRequestsTable(){
		$this->__init__();
	}
	function __init__(){
		$this->userId = null;
		$this->requestId = null;
		$this->createdAt = time();
	}
	function connection(){
		if(!Rhaco::isVariable("_R_D_CON_","utatanebiyori")){
			Rhaco::addVariable("_R_D_CON_",new DbConnection("utatanebiyori"),"utatanebiyori");
		}
		return Rhaco::getVariable("_R_D_CON_",null,"utatanebiyori");
	}
	function table(){
		if(!Rhaco::isVariable("_R_D_T_","WhisperRequests")){
			Rhaco::addVariable("_R_D_T_",new Table(Rhaco::constant("DATABASE_utatanebiyori_PREFIX")."whisper_requests",__CLASS__),"WhisperRequests");
		}
		return Rhaco::getVariable("_R_D_T_",null,"WhisperRequests");
	}


	/**
	 * 
	 * @return database.model.Column
	 */
	function columnUserId(){
		if(!Rhaco::isVariable("_R_D_C_","WhisperRequests::UserId")){
			$column = new Column("column=user_id,variable=userId,type=integer,size=22,unique=true,reference=Users::Id,uniqueWith=WhisperRequests::RequestId,",__CLASS__);
			$column->label(Message::_("user_id"));
			Rhaco::addVariable("_R_D_C_",$column,"WhisperRequests::UserId");
		}
		return Rhaco::getVariable("_R_D_C_",null,"WhisperRequests::UserId");
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
	function columnRequestId(){
		if(!Rhaco::isVariable("_R_D_C_","WhisperRequests::RequestId")){
			$column = new Column("column=request_id,variable=requestId,type=integer,size=22,unique=true,reference=WhisperRequestedUsers::Id,uniqueWith=WhisperRequests::UserId,",__CLASS__);
			$column->label(Message::_("request_id"));
			Rhaco::addVariable("_R_D_C_",$column,"WhisperRequests::RequestId");
		}
		return Rhaco::getVariable("_R_D_C_",null,"WhisperRequests::RequestId");
	}
	/**
	 * 
	 * @return integer
	 */
	function setRequestId($value){
		$this->requestId = TableObjectUtil::cast($value,"integer");
	}
	/**
	 * 
	 */
	function getRequestId(){
		return $this->requestId;
	}
	/**
	 * 
	 * @return database.model.Column
	 */
	function columnCreatedAt(){
		if(!Rhaco::isVariable("_R_D_C_","WhisperRequests::CreatedAt")){
			$column = new Column("column=created_at,variable=createdAt,type=timestamp,",__CLASS__);
			$column->label(Message::_("created_at"));
			Rhaco::addVariable("_R_D_C_",$column,"WhisperRequests::CreatedAt");
		}
		return Rhaco::getVariable("_R_D_C_",null,"WhisperRequests::CreatedAt");
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
	function getFactRequestId(){
		return $this->factRequestId;
	}
	function setFactRequestId($obj){
		$this->factRequestId = $obj;
	}
}
?>