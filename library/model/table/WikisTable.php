<?php
Rhaco::import("resources.Message");
Rhaco::import("database.model.TableObjectBase");
Rhaco::import("database.model.DbConnection");
Rhaco::import("database.TableObjectUtil");
Rhaco::import("database.model.Table");
Rhaco::import("database.model.Column");
/**
 * #ignore
 * Wikis
 */
class WikisTable extends TableObjectBase{
	/**  */
	var $id;
	/**  */
	var $userId;
	/**  */
	var $wikiName;
	/**  */
	var $password;
	/**  */
	var $text;
	/**  */
	var $createdAt;
	/**  */
	var $updatedAt;
	/**  */
	var $deleteFlag;
	var $url;
	var $wikiNameLink;
	var $dependWikisBackups;
	var $dependWikisAttachs;
	var $factUserId;


	function WikisTable($id=null){
		$this->__init__($id);
	}
	function __init__($id=null){
		$this->id = null;
		$this->userId = null;
		$this->wikiName = null;
		$this->password = null;
		$this->text = null;
		$this->createdAt = time();
		$this->updatedAt = time();
		$this->deleteFlag = 0;
		$this->url = null;
		$this->wikiNameLink = null;
		$this->setId($id);
	}
	function connection(){
		if(!Rhaco::isVariable("_R_D_CON_","utatanebiyori")){
			Rhaco::addVariable("_R_D_CON_",new DbConnection("utatanebiyori"),"utatanebiyori");
		}
		return Rhaco::getVariable("_R_D_CON_",null,"utatanebiyori");
	}
	function table(){
		if(!Rhaco::isVariable("_R_D_T_","Wikis")){
			Rhaco::addVariable("_R_D_T_",new Table(Rhaco::constant("DATABASE_utatanebiyori_PREFIX")."wikis",__CLASS__),"Wikis");
		}
		return Rhaco::getVariable("_R_D_T_",null,"Wikis");
	}


	/**
	 * 
	 * @return database.model.Column
	 */
	function columnId(){
		if(!Rhaco::isVariable("_R_D_C_","Wikis::Id")){
			$column = new Column("column=id,variable=id,type=serial,size=22,primary=true,",__CLASS__);
			$column->label(Message::_("id"));
			$column->depend("WikisBackup::WikiId","WikisAttach::WikiId");
			Rhaco::addVariable("_R_D_C_",$column,"Wikis::Id");
		}
		return Rhaco::getVariable("_R_D_C_",null,"Wikis::Id");
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
		if(!Rhaco::isVariable("_R_D_C_","Wikis::UserId")){
			$column = new Column("column=user_id,variable=userId,type=integer,size=22,reference=Users::Id,",__CLASS__);
			$column->label(Message::_("user_id"));
			Rhaco::addVariable("_R_D_C_",$column,"Wikis::UserId");
		}
		return Rhaco::getVariable("_R_D_C_",null,"Wikis::UserId");
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
	function columnWikiName(){
		if(!Rhaco::isVariable("_R_D_C_","Wikis::WikiName")){
			$column = new Column("column=wiki_name,variable=wikiName,type=text,require=true,unique=true,",__CLASS__);
			$column->label(Message::_("ページ名"));
			Rhaco::addVariable("_R_D_C_",$column,"Wikis::WikiName");
		}
		return Rhaco::getVariable("_R_D_C_",null,"Wikis::WikiName");
	}
	/**
	 * 
	 * @return text
	 */
	function setWikiName($value){
		$this->wikiName = TableObjectUtil::cast($value,"text");
	}
	/**
	 * 
	 */
	function getWikiName(){
		return $this->wikiName;
	}
	/**
	 * 
	 * @return database.model.Column
	 */
	function columnPassword(){
		if(!Rhaco::isVariable("_R_D_C_","Wikis::Password")){
			$column = new Column("column=password,variable=password,type=string,",__CLASS__);
			$column->label(Message::_("パスワード"));
			Rhaco::addVariable("_R_D_C_",$column,"Wikis::Password");
		}
		return Rhaco::getVariable("_R_D_C_",null,"Wikis::Password");
	}
	/**
	 * 
	 * @return string
	 */
	function setPassword($value){
		$this->password = TableObjectUtil::cast($value,"string");
	}
	/**
	 * 
	 */
	function getPassword(){
		return $this->password;
	}
	/**
	 * 
	 * @return database.model.Column
	 */
	function columnText(){
		if(!Rhaco::isVariable("_R_D_C_","Wikis::Text")){
			$column = new Column("column=text,variable=text,type=text,",__CLASS__);
			$column->label(Message::_("本文"));
			Rhaco::addVariable("_R_D_C_",$column,"Wikis::Text");
		}
		return Rhaco::getVariable("_R_D_C_",null,"Wikis::Text");
	}
	/**
	 * 
	 * @return text
	 */
	function setText($value){
		$this->text = TableObjectUtil::cast($value,"text");
	}
	/**
	 * 
	 */
	function getText(){
		return $this->text;
	}
	/**
	 * 
	 * @return database.model.Column
	 */
	function columnCreatedAt(){
		if(!Rhaco::isVariable("_R_D_C_","Wikis::CreatedAt")){
			$column = new Column("column=created_at,variable=createdAt,type=timestamp,",__CLASS__);
			$column->label(Message::_("作成日時"));
			Rhaco::addVariable("_R_D_C_",$column,"Wikis::CreatedAt");
		}
		return Rhaco::getVariable("_R_D_C_",null,"Wikis::CreatedAt");
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
	/**
	 * 
	 * @return database.model.Column
	 */
	function columnUpdatedAt(){
		if(!Rhaco::isVariable("_R_D_C_","Wikis::UpdatedAt")){
			$column = new Column("column=updated_at,variable=updatedAt,type=timestamp,",__CLASS__);
			$column->label(Message::_("更新日時"));
			Rhaco::addVariable("_R_D_C_",$column,"Wikis::UpdatedAt");
		}
		return Rhaco::getVariable("_R_D_C_",null,"Wikis::UpdatedAt");
	}
	/**
	 * 
	 * @return timestamp
	 */
	function setUpdatedAt($value){
		$this->updatedAt = TableObjectUtil::cast($value,"timestamp");
	}
	/**
	 * 
	 */
	function getUpdatedAt(){
		return $this->updatedAt;
	}
	/**  */
	function formatUpdatedAt($format="Y/m/d H:i:s"){
		return DateUtil::format($this->updatedAt,$format);
	}
	/**
	 * 
	 * @return database.model.Column
	 */
	function columnDeleteFlag(){
		if(!Rhaco::isVariable("_R_D_C_","Wikis::DeleteFlag")){
			$column = new Column("column=delete_flag,variable=deleteFlag,type=boolean,",__CLASS__);
			$column->label(Message::_("delete_flag"));
			Rhaco::addVariable("_R_D_C_",$column,"Wikis::DeleteFlag");
		}
		return Rhaco::getVariable("_R_D_C_",null,"Wikis::DeleteFlag");
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
	function extraUrl(){
		if(!Rhaco::isVariable("_R_D_C_","Wikis::Url")){
			$column = new Column("column=url,variable=url,type=string,",__CLASS__);
			$column->label(Message::_("url"));
			Rhaco::addVariable("_R_D_C_",$column,"Wikis::Url");
		}
		return Rhaco::getVariable("_R_D_C_",null,"Wikis::Url");
	}
	/**
	 * 
	 * @return string
	 */
	function setUrl($value){
		$this->url = TableObjectUtil::cast($value,"string");
	}
	/**
	 * 
	 */
	function getUrl(){
		return $this->url;
	}
	/**
	 * 
	 * @return database.model.Column
	 */
	function extraWikiNameLink(){
		if(!Rhaco::isVariable("_R_D_C_","Wikis::WikiNameLink")){
			$column = new Column("column=wiki_name_link,variable=wikiNameLink,type=string,",__CLASS__);
			$column->label(Message::_("wiki_name_link"));
			Rhaco::addVariable("_R_D_C_",$column,"Wikis::WikiNameLink");
		}
		return Rhaco::getVariable("_R_D_C_",null,"Wikis::WikiNameLink");
	}
	/**
	 * 
	 * @return string
	 */
	function setWikiNameLink($value){
		$this->wikiNameLink = TableObjectUtil::cast($value,"string");
	}
	/**
	 * 
	 */
	function getWikiNameLink(){
		return $this->wikiNameLink;
	}


	function getFactUserId(){
		return $this->factUserId;
	}
	function setFactUserId($obj){
		$this->factUserId = $obj;
	}
	function setDependWikisBackups($value){
		$this->dependWikisBackups = $value;
	}
	function getDependWikisBackups(){
		return $this->dependWikisBackups;
	}
	function setDependWikisAttachs($value){
		$this->dependWikisAttachs = $value;
	}
	function getDependWikisAttachs(){
		return $this->dependWikisAttachs;
	}
}
?>