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
class WhisperTable extends TableObjectBase{
	/**  */
	var $id;
	/**  */
	var $userId;
	/**  */
	var $replyStatusId;
	/**  */
	var $replyUserId;
	/**  */
	var $status;
	/**  */
	var $createdAt;
	var $factUserId;


	function WhisperTable($id=null){
		$this->__init__($id);
	}
	function __init__($id=null){
		$this->id = null;
		$this->userId = null;
		$this->replyStatusId = null;
		$this->replyUserId = null;
		$this->status = null;
		$this->createdAt = time();
		$this->setId($id);
	}
	function connection(){
		if(!Rhaco::isVariable("_R_D_CON_","utatanebiyori")){
			Rhaco::addVariable("_R_D_CON_",new DbConnection("utatanebiyori"),"utatanebiyori");
		}
		return Rhaco::getVariable("_R_D_CON_",null,"utatanebiyori");
	}
	function table(){
		if(!Rhaco::isVariable("_R_D_T_","Whisper")){
			Rhaco::addVariable("_R_D_T_",new Table(Rhaco::constant("DATABASE_utatanebiyori_PREFIX")."whisper",__CLASS__),"Whisper");
		}
		return Rhaco::getVariable("_R_D_T_",null,"Whisper");
	}


	/**
	 * 
	 * @return database.model.Column
	 */
	function columnId(){
		if(!Rhaco::isVariable("_R_D_C_","Whisper::Id")){
			$column = new Column("column=id,variable=id,type=serial,size=22,primary=true,",__CLASS__);
			$column->label(Message::_("id"));
			Rhaco::addVariable("_R_D_C_",$column,"Whisper::Id");
		}
		return Rhaco::getVariable("_R_D_C_",null,"Whisper::Id");
	}
	/**
	 * 
	 * @return serial
	 */
	function setId($value){
		$this->id = TableObjectUtil::cast($value,"serial");
	}
	/**
	 * 
	 */
	function getId(){
		return $this->id;
	}
	/**
	 * 
	 * @return database.model.Column
	 */
	function columnUserId(){
		if(!Rhaco::isVariable("_R_D_C_","Whisper::UserId")){
			$column = new Column("column=user_id,variable=userId,type=integer,size=22,reference=Users::Id,",__CLASS__);
			$column->label(Message::_("user_id"));
			Rhaco::addVariable("_R_D_C_",$column,"Whisper::UserId");
		}
		return Rhaco::getVariable("_R_D_C_",null,"Whisper::UserId");
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
	function columnReplyStatusId(){
		if(!Rhaco::isVariable("_R_D_C_","Whisper::ReplyStatusId")){
			$column = new Column("column=reply_status_id,variable=replyStatusId,type=integer,size=22,",__CLASS__);
			$column->label(Message::_("reply_status_id"));
			Rhaco::addVariable("_R_D_C_",$column,"Whisper::ReplyStatusId");
		}
		return Rhaco::getVariable("_R_D_C_",null,"Whisper::ReplyStatusId");
	}
	/**
	 * 
	 * @return integer
	 */
	function setReplyStatusId($value){
		$this->replyStatusId = TableObjectUtil::cast($value,"integer");
	}
	/**
	 * 
	 */
	function getReplyStatusId(){
		return $this->replyStatusId;
	}
	/**
	 * 
	 * @return database.model.Column
	 */
	function columnReplyUserId(){
		if(!Rhaco::isVariable("_R_D_C_","Whisper::ReplyUserId")){
			$column = new Column("column=reply_user_id,variable=replyUserId,type=integer,size=22,",__CLASS__);
			$column->label(Message::_("reply_user_id"));
			Rhaco::addVariable("_R_D_C_",$column,"Whisper::ReplyUserId");
		}
		return Rhaco::getVariable("_R_D_C_",null,"Whisper::ReplyUserId");
	}
	/**
	 * 
	 * @return integer
	 */
	function setReplyUserId($value){
		$this->replyUserId = TableObjectUtil::cast($value,"integer");
	}
	/**
	 * 
	 */
	function getReplyUserId(){
		return $this->replyUserId;
	}
	/**
	 * 
	 * @return database.model.Column
	 */
	function columnStatus(){
		if(!Rhaco::isVariable("_R_D_C_","Whisper::Status")){
			$column = new Column("column=status,variable=status,type=string,max=300,require=true,",__CLASS__);
			$column->label(Message::_("ささやき"));
			Rhaco::addVariable("_R_D_C_",$column,"Whisper::Status");
		}
		return Rhaco::getVariable("_R_D_C_",null,"Whisper::Status");
	}
	/**
	 * 
	 * @return string
	 */
	function setStatus($value){
		$this->status = TableObjectUtil::cast($value,"string");
	}
	/**
	 * 
	 */
	function getStatus(){
		return $this->status;
	}
	/**
	 * 
	 * @return database.model.Column
	 */
	function columnCreatedAt(){
		if(!Rhaco::isVariable("_R_D_C_","Whisper::CreatedAt")){
			$column = new Column("column=created_at,variable=createdAt,type=timestamp,",__CLASS__);
			$column->label(Message::_("created_at"));
			Rhaco::addVariable("_R_D_C_",$column,"Whisper::CreatedAt");
		}
		return Rhaco::getVariable("_R_D_C_",null,"Whisper::CreatedAt");
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
}
?>