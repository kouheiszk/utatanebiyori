<?php
Rhaco::import("resources.Message");
Rhaco::import("database.model.TableObjectBase");
Rhaco::import("database.model.DbConnection");
Rhaco::import("database.TableObjectUtil");
Rhaco::import("database.model.Table");
Rhaco::import("database.model.Column");
/**
 * #ignore
 * Wikis_backup
 */
class WikisBackupTable extends TableObjectBase{
	/**  */
	var $id;
	/**  */
	var $wikiId;
	/**  */
	var $wikiName;
	/**  */
	var $text;
	/**  */
	var $createdAt;
	var $factWikiId;


	function WikisBackupTable($id=null){
		$this->__init__($id);
	}
	function __init__($id=null){
		$this->id = null;
		$this->wikiId = null;
		$this->wikiName = null;
		$this->text = null;
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
		if(!Rhaco::isVariable("_R_D_T_","WikisBackup")){
			Rhaco::addVariable("_R_D_T_",new Table(Rhaco::constant("DATABASE_utatanebiyori_PREFIX")."wikis_backup",__CLASS__),"WikisBackup");
		}
		return Rhaco::getVariable("_R_D_T_",null,"WikisBackup");
	}


	/**
	 * 
	 * @return database.model.Column
	 */
	function columnId(){
		if(!Rhaco::isVariable("_R_D_C_","WikisBackup::Id")){
			$column = new Column("column=id,variable=id,type=serial,size=22,primary=true,",__CLASS__);
			$column->label(Message::_("id"));
			Rhaco::addVariable("_R_D_C_",$column,"WikisBackup::Id");
		}
		return Rhaco::getVariable("_R_D_C_",null,"WikisBackup::Id");
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
		if(!Rhaco::isVariable("_R_D_C_","WikisBackup::WikiId")){
			$column = new Column("column=wiki_id,variable=wikiId,type=integer,size=22,reference=Wikis::Id,",__CLASS__);
			$column->label(Message::_("wiki_id"));
			Rhaco::addVariable("_R_D_C_",$column,"WikisBackup::WikiId");
		}
		return Rhaco::getVariable("_R_D_C_",null,"WikisBackup::WikiId");
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
	function columnWikiName(){
		if(!Rhaco::isVariable("_R_D_C_","WikisBackup::WikiName")){
			$column = new Column("column=wiki_name,variable=wikiName,type=text,",__CLASS__);
			$column->label(Message::_("ページ名"));
			Rhaco::addVariable("_R_D_C_",$column,"WikisBackup::WikiName");
		}
		return Rhaco::getVariable("_R_D_C_",null,"WikisBackup::WikiName");
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
	function columnText(){
		if(!Rhaco::isVariable("_R_D_C_","WikisBackup::Text")){
			$column = new Column("column=text,variable=text,type=text,",__CLASS__);
			$column->label(Message::_("本文"));
			Rhaco::addVariable("_R_D_C_",$column,"WikisBackup::Text");
		}
		return Rhaco::getVariable("_R_D_C_",null,"WikisBackup::Text");
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
		if(!Rhaco::isVariable("_R_D_C_","WikisBackup::CreatedAt")){
			$column = new Column("column=created_at,variable=createdAt,type=timestamp,",__CLASS__);
			$column->label(Message::_("作成日時"));
			Rhaco::addVariable("_R_D_C_",$column,"WikisBackup::CreatedAt");
		}
		return Rhaco::getVariable("_R_D_C_",null,"WikisBackup::CreatedAt");
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
}
?>