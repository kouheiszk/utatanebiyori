<?php
Rhaco::import("resources.Message");
Rhaco::import("database.model.TableObjectBase");
Rhaco::import("database.model.DbConnection");
Rhaco::import("database.TableObjectUtil");
Rhaco::import("database.model.Table");
Rhaco::import("database.model.Column");
/**
 * #ignore
 * Wikis_attach
 */
class WikisAttachTable extends TableObjectBase{
	/**  */
	var $id;
	/**  */
	var $wikiId;
	/**  */
	var $userId;
	/**  */
	var $fileId;
	/**  */
	var $fileName;
	/**  */
	var $deleteFlag;
	/**  */
	var $createdAt;
	var $factWikiId;
	var $factUserId;


	function WikisAttachTable($id=null){
		$this->__init__($id);
	}
	function __init__($id=null){
		$this->id = null;
		$this->wikiId = null;
		$this->userId = null;
		$this->fileId = null;
		$this->fileName = null;
		$this->deleteFlag = 0;
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
		if(!Rhaco::isVariable("_R_D_T_","WikisAttach")){
			Rhaco::addVariable("_R_D_T_",new Table(Rhaco::constant("DATABASE_utatanebiyori_PREFIX")."wikis_attach",__CLASS__),"WikisAttach");
		}
		return Rhaco::getVariable("_R_D_T_",null,"WikisAttach");
	}


	/**
	 * 
	 * @return database.model.Column
	 */
	function columnId(){
		if(!Rhaco::isVariable("_R_D_C_","WikisAttach::Id")){
			$column = new Column("column=id,variable=id,type=serial,size=22,primary=true,",__CLASS__);
			$column->label(Message::_("id"));
			Rhaco::addVariable("_R_D_C_",$column,"WikisAttach::Id");
		}
		return Rhaco::getVariable("_R_D_C_",null,"WikisAttach::Id");
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
	function columnWikiId(){
		if(!Rhaco::isVariable("_R_D_C_","WikisAttach::WikiId")){
			$column = new Column("column=wiki_id,variable=wikiId,type=integer,size=22,reference=Wikis::Id,",__CLASS__);
			$column->label(Message::_("wiki_id"));
			Rhaco::addVariable("_R_D_C_",$column,"WikisAttach::WikiId");
		}
		return Rhaco::getVariable("_R_D_C_",null,"WikisAttach::WikiId");
	}
	/**
	 * 
	 * @return integer
	 */
	function setWikiId($value){
		$this->wikiId = TableObjectUtil::cast($value,"integer");
	}
	/**
	 * 
	 */
	function getWikiId(){
		return $this->wikiId;
	}
	/**
	 * 
	 * @return database.model.Column
	 */
	function columnUserId(){
		if(!Rhaco::isVariable("_R_D_C_","WikisAttach::UserId")){
			$column = new Column("column=user_id,variable=userId,type=integer,size=22,reference=Users::Id,",__CLASS__);
			$column->label(Message::_("user_id"));
			Rhaco::addVariable("_R_D_C_",$column,"WikisAttach::UserId");
		}
		return Rhaco::getVariable("_R_D_C_",null,"WikisAttach::UserId");
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
	function columnFileId(){
		if(!Rhaco::isVariable("_R_D_C_","WikisAttach::FileId")){
			$column = new Column("column=file_id,variable=fileId,type=string,require=true,unique=true,uniqueWith=WikisAttach::WikiId,",__CLASS__);
			$column->label(Message::_("ファイルID"));
			Rhaco::addVariable("_R_D_C_",$column,"WikisAttach::FileId");
		}
		return Rhaco::getVariable("_R_D_C_",null,"WikisAttach::FileId");
	}
	/**
	 * 
	 * @return string
	 */
	function setFileId($value){
		$this->fileId = TableObjectUtil::cast($value,"string");
	}
	/**
	 * 
	 */
	function getFileId(){
		return $this->fileId;
	}
	/**
	 * 
	 * @return database.model.Column
	 */
	function columnFileName(){
		if(!Rhaco::isVariable("_R_D_C_","WikisAttach::FileName")){
			$column = new Column("column=file_name,variable=fileName,type=text,",__CLASS__);
			$column->label(Message::_("ファイル名"));
			Rhaco::addVariable("_R_D_C_",$column,"WikisAttach::FileName");
		}
		return Rhaco::getVariable("_R_D_C_",null,"WikisAttach::FileName");
	}
	/**
	 * 
	 * @return text
	 */
	function setFileName($value){
		$this->fileName = TableObjectUtil::cast($value,"text");
	}
	/**
	 * 
	 */
	function getFileName(){
		return $this->fileName;
	}
	/**
	 * 
	 * @return database.model.Column
	 */
	function columnDeleteFlag(){
		if(!Rhaco::isVariable("_R_D_C_","WikisAttach::DeleteFlag")){
			$column = new Column("column=delete_flag,variable=deleteFlag,type=boolean,",__CLASS__);
			$column->label(Message::_("delete_flag"));
			Rhaco::addVariable("_R_D_C_",$column,"WikisAttach::DeleteFlag");
		}
		return Rhaco::getVariable("_R_D_C_",null,"WikisAttach::DeleteFlag");
	}
	/**
	 * 
	 * @return boolean
	 */
	function setDeleteFlag($value){
		$this->deleteFlag = TableObjectUtil::cast($value,"boolean");
	}
	/**
	 * 
	 */
	function getDeleteFlag(){
		return $this->deleteFlag;
	}
	/**  */
	function isDeleteFlag(){
		return Variable::bool($this->deleteFlag);
	}
	/**
	 * 
	 * @return database.model.Column
	 */
	function columnCreatedAt(){
		if(!Rhaco::isVariable("_R_D_C_","WikisAttach::CreatedAt")){
			$column = new Column("column=created_at,variable=createdAt,type=timestamp,",__CLASS__);
			$column->label(Message::_("作成日時"));
			Rhaco::addVariable("_R_D_C_",$column,"WikisAttach::CreatedAt");
		}
		return Rhaco::getVariable("_R_D_C_",null,"WikisAttach::CreatedAt");
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


	function getFactWikiId(){
		return $this->factWikiId;
	}
	function setFactWikiId($obj){
		$this->factWikiId = $obj;
	}
	function getFactUserId(){
		return $this->factUserId;
	}
	function setFactUserId($obj){
		$this->factUserId = $obj;
	}
}
?>