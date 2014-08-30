<?php
Rhaco::import("resources.Message");
Rhaco::import("database.model.TableObjectBase");
Rhaco::import("database.model.DbConnection");
Rhaco::import("database.TableObjectUtil");
Rhaco::import("database.model.Table");
Rhaco::import("database.model.Column");
/**
 * #ignore
 * Uploader
 */
class UploaderTable extends TableObjectBase{
	/**  */
	var $id;
	/**  */
	var $userId;
	/**  */
	var $fileName;
	/**  */
	var $comment;
	/**  */
	var $size;
	/**  */
	var $mime;
	/**  */
	var $host;
	/**  */
	var $categoryId;
	/**  */
	var $tag01;
	/**  */
	var $tag02;
	/**  */
	var $tag03;
	/**  */
	var $tag04;
	/**  */
	var $tag05;
	/**  */
	var $tag06;
	/**  */
	var $tag07;
	/**  */
	var $tag08;
	/**  */
	var $tag09;
	/**  */
	var $tag10;
	/**  */
	var $downloadCount;
	/**  */
	var $downloadPath;
	/**  */
	var $downloadKey;
	/**  */
	var $deleteKey;
	/**  */
	var $deleteFlag;
	/**  */
	var $updatedAt;
	/**  */
	var $createdAt;
	var $factUserId;
	var $factCategoryId;


	function UploaderTable($id=null){
		$this->__init__($id);
	}
	function __init__($id=null){
		$this->id = null;
		$this->userId = null;
		$this->fileName = null;
		$this->comment = null;
		$this->size = null;
		$this->mime = null;
		$this->host = null;
		$this->categoryId = null;
		$this->tag01 = null;
		$this->tag02 = null;
		$this->tag03 = null;
		$this->tag04 = null;
		$this->tag05 = null;
		$this->tag06 = null;
		$this->tag07 = null;
		$this->tag08 = null;
		$this->tag09 = null;
		$this->tag10 = null;
		$this->downloadCount = 0;
		$this->downloadPath = null;
		$this->downloadKey = null;
		$this->deleteKey = null;
		$this->deleteFlag = 0;
		$this->updatedAt = time();
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
		if(!Rhaco::isVariable("_R_D_T_","Uploader")){
			Rhaco::addVariable("_R_D_T_",new Table(Rhaco::constant("DATABASE_utatanebiyori_PREFIX")."uploader",__CLASS__),"Uploader");
		}
		return Rhaco::getVariable("_R_D_T_",null,"Uploader");
	}


	/**
	 * 
	 * @return database.model.Column
	 */
	function columnId(){
		if(!Rhaco::isVariable("_R_D_C_","Uploader::Id")){
			$column = new Column("column=id,variable=id,type=serial,size=22,primary=true,",__CLASS__);
			$column->label(Message::_("id"));
			Rhaco::addVariable("_R_D_C_",$column,"Uploader::Id");
		}
		return Rhaco::getVariable("_R_D_C_",null,"Uploader::Id");
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
		if(!Rhaco::isVariable("_R_D_C_","Uploader::UserId")){
			$column = new Column("column=user_id,variable=userId,type=integer,size=22,reference=Users::Id,",__CLASS__);
			$column->label(Message::_("user_id"));
			Rhaco::addVariable("_R_D_C_",$column,"Uploader::UserId");
		}
		return Rhaco::getVariable("_R_D_C_",null,"Uploader::UserId");
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
	function columnFileName(){
		if(!Rhaco::isVariable("_R_D_C_","Uploader::FileName")){
			$column = new Column("column=file_name,variable=fileName,type=text,",__CLASS__);
			$column->label(Message::_("ファイル名"));
			Rhaco::addVariable("_R_D_C_",$column,"Uploader::FileName");
		}
		return Rhaco::getVariable("_R_D_C_",null,"Uploader::FileName");
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
	function columnComment(){
		if(!Rhaco::isVariable("_R_D_C_","Uploader::Comment")){
			$column = new Column("column=comment,variable=comment,type=text,max=200,",__CLASS__);
			$column->label(Message::_("コメント"));
			Rhaco::addVariable("_R_D_C_",$column,"Uploader::Comment");
		}
		return Rhaco::getVariable("_R_D_C_",null,"Uploader::Comment");
	}
	/**
	 * 
	 * @return text
	 */
	function setComment($value){
		$this->comment = TableObjectUtil::cast($value,"text");
	}
	/**
	 * 
	 */
	function getComment(){
		return $this->comment;
	}
	/**
	 * 
	 * @return database.model.Column
	 */
	function columnSize(){
		if(!Rhaco::isVariable("_R_D_C_","Uploader::Size")){
			$column = new Column("column=size,variable=size,type=integer,size=22,",__CLASS__);
			$column->label(Message::_("ファイルサイズ"));
			Rhaco::addVariable("_R_D_C_",$column,"Uploader::Size");
		}
		return Rhaco::getVariable("_R_D_C_",null,"Uploader::Size");
	}
	/**
	 * 
	 * @return integer
	 */
	function setSize($value){
		$this->size = TableObjectUtil::cast($value,"integer");
	}
	/**
	 * 
	 */
	function getSize(){
		return $this->size;
	}
	/**
	 * 
	 * @return database.model.Column
	 */
	function columnMime(){
		if(!Rhaco::isVariable("_R_D_C_","Uploader::Mime")){
			$column = new Column("column=mime,variable=mime,type=text,",__CLASS__);
			$column->label(Message::_("ファイルタイプ"));
			Rhaco::addVariable("_R_D_C_",$column,"Uploader::Mime");
		}
		return Rhaco::getVariable("_R_D_C_",null,"Uploader::Mime");
	}
	/**
	 * 
	 * @return text
	 */
	function setMime($value){
		$this->mime = TableObjectUtil::cast($value,"text");
	}
	/**
	 * 
	 */
	function getMime(){
		return $this->mime;
	}
	/**
	 * 
	 * @return database.model.Column
	 */
	function columnHost(){
		if(!Rhaco::isVariable("_R_D_C_","Uploader::Host")){
			$column = new Column("column=host,variable=host,type=text,",__CLASS__);
			$column->label(Message::_("host"));
			Rhaco::addVariable("_R_D_C_",$column,"Uploader::Host");
		}
		return Rhaco::getVariable("_R_D_C_",null,"Uploader::Host");
	}
	/**
	 * 
	 * @return text
	 */
	function setHost($value){
		$this->host = TableObjectUtil::cast($value,"text");
	}
	/**
	 * 
	 */
	function getHost(){
		return $this->host;
	}
	/**
	 * 
	 * @return database.model.Column
	 */
	function columnCategoryId(){
		if(!Rhaco::isVariable("_R_D_C_","Uploader::CategoryId")){
			$column = new Column("column=category_id,variable=categoryId,type=integer,size=22,reference=UploaderCategory::Id,",__CLASS__);
			$column->label(Message::_("category_id"));
			Rhaco::addVariable("_R_D_C_",$column,"Uploader::CategoryId");
		}
		return Rhaco::getVariable("_R_D_C_",null,"Uploader::CategoryId");
	}
	/**
	 * 
	 * @return integer
	 */
	function setCategoryId($value){
		$this->categoryId = TableObjectUtil::cast($value,"integer");
	}
	/**
	 * 
	 */
	function getCategoryId(){
		return $this->categoryId;
	}
	/**
	 * 
	 * @return database.model.Column
	 */
	function columnTag01(){
		if(!Rhaco::isVariable("_R_D_C_","Uploader::Tag01")){
			$column = new Column("column=tag01,variable=tag01,type=text,max=20,",__CLASS__);
			$column->label(Message::_("tag01"));
			Rhaco::addVariable("_R_D_C_",$column,"Uploader::Tag01");
		}
		return Rhaco::getVariable("_R_D_C_",null,"Uploader::Tag01");
	}
	/**
	 * 
	 * @return text
	 */
	function setTag01($value){
		$this->tag01 = TableObjectUtil::cast($value,"text");
	}
	/**
	 * 
	 */
	function getTag01(){
		return $this->tag01;
	}
	/**
	 * 
	 * @return database.model.Column
	 */
	function columnTag02(){
		if(!Rhaco::isVariable("_R_D_C_","Uploader::Tag02")){
			$column = new Column("column=tag02,variable=tag02,type=text,max=20,",__CLASS__);
			$column->label(Message::_("tag02"));
			Rhaco::addVariable("_R_D_C_",$column,"Uploader::Tag02");
		}
		return Rhaco::getVariable("_R_D_C_",null,"Uploader::Tag02");
	}
	/**
	 * 
	 * @return text
	 */
	function setTag02($value){
		$this->tag02 = TableObjectUtil::cast($value,"text");
	}
	/**
	 * 
	 */
	function getTag02(){
		return $this->tag02;
	}
	/**
	 * 
	 * @return database.model.Column
	 */
	function columnTag03(){
		if(!Rhaco::isVariable("_R_D_C_","Uploader::Tag03")){
			$column = new Column("column=tag03,variable=tag03,type=text,max=20,",__CLASS__);
			$column->label(Message::_("tag03"));
			Rhaco::addVariable("_R_D_C_",$column,"Uploader::Tag03");
		}
		return Rhaco::getVariable("_R_D_C_",null,"Uploader::Tag03");
	}
	/**
	 * 
	 * @return text
	 */
	function setTag03($value){
		$this->tag03 = TableObjectUtil::cast($value,"text");
	}
	/**
	 * 
	 */
	function getTag03(){
		return $this->tag03;
	}
	/**
	 * 
	 * @return database.model.Column
	 */
	function columnTag04(){
		if(!Rhaco::isVariable("_R_D_C_","Uploader::Tag04")){
			$column = new Column("column=tag04,variable=tag04,type=text,max=20,",__CLASS__);
			$column->label(Message::_("tag04"));
			Rhaco::addVariable("_R_D_C_",$column,"Uploader::Tag04");
		}
		return Rhaco::getVariable("_R_D_C_",null,"Uploader::Tag04");
	}
	/**
	 * 
	 * @return text
	 */
	function setTag04($value){
		$this->tag04 = TableObjectUtil::cast($value,"text");
	}
	/**
	 * 
	 */
	function getTag04(){
		return $this->tag04;
	}
	/**
	 * 
	 * @return database.model.Column
	 */
	function columnTag05(){
		if(!Rhaco::isVariable("_R_D_C_","Uploader::Tag05")){
			$column = new Column("column=tag05,variable=tag05,type=text,max=20,",__CLASS__);
			$column->label(Message::_("tag05"));
			Rhaco::addVariable("_R_D_C_",$column,"Uploader::Tag05");
		}
		return Rhaco::getVariable("_R_D_C_",null,"Uploader::Tag05");
	}
	/**
	 * 
	 * @return text
	 */
	function setTag05($value){
		$this->tag05 = TableObjectUtil::cast($value,"text");
	}
	/**
	 * 
	 */
	function getTag05(){
		return $this->tag05;
	}
	/**
	 * 
	 * @return database.model.Column
	 */
	function columnTag06(){
		if(!Rhaco::isVariable("_R_D_C_","Uploader::Tag06")){
			$column = new Column("column=tag06,variable=tag06,type=text,max=20,",__CLASS__);
			$column->label(Message::_("tag06"));
			Rhaco::addVariable("_R_D_C_",$column,"Uploader::Tag06");
		}
		return Rhaco::getVariable("_R_D_C_",null,"Uploader::Tag06");
	}
	/**
	 * 
	 * @return text
	 */
	function setTag06($value){
		$this->tag06 = TableObjectUtil::cast($value,"text");
	}
	/**
	 * 
	 */
	function getTag06(){
		return $this->tag06;
	}
	/**
	 * 
	 * @return database.model.Column
	 */
	function columnTag07(){
		if(!Rhaco::isVariable("_R_D_C_","Uploader::Tag07")){
			$column = new Column("column=tag07,variable=tag07,type=text,max=20,",__CLASS__);
			$column->label(Message::_("tag07"));
			Rhaco::addVariable("_R_D_C_",$column,"Uploader::Tag07");
		}
		return Rhaco::getVariable("_R_D_C_",null,"Uploader::Tag07");
	}
	/**
	 * 
	 * @return text
	 */
	function setTag07($value){
		$this->tag07 = TableObjectUtil::cast($value,"text");
	}
	/**
	 * 
	 */
	function getTag07(){
		return $this->tag07;
	}
	/**
	 * 
	 * @return database.model.Column
	 */
	function columnTag08(){
		if(!Rhaco::isVariable("_R_D_C_","Uploader::Tag08")){
			$column = new Column("column=tag08,variable=tag08,type=text,max=20,",__CLASS__);
			$column->label(Message::_("tag08"));
			Rhaco::addVariable("_R_D_C_",$column,"Uploader::Tag08");
		}
		return Rhaco::getVariable("_R_D_C_",null,"Uploader::Tag08");
	}
	/**
	 * 
	 * @return text
	 */
	function setTag08($value){
		$this->tag08 = TableObjectUtil::cast($value,"text");
	}
	/**
	 * 
	 */
	function getTag08(){
		return $this->tag08;
	}
	/**
	 * 
	 * @return database.model.Column
	 */
	function columnTag09(){
		if(!Rhaco::isVariable("_R_D_C_","Uploader::Tag09")){
			$column = new Column("column=tag09,variable=tag09,type=text,max=20,",__CLASS__);
			$column->label(Message::_("tag09"));
			Rhaco::addVariable("_R_D_C_",$column,"Uploader::Tag09");
		}
		return Rhaco::getVariable("_R_D_C_",null,"Uploader::Tag09");
	}
	/**
	 * 
	 * @return text
	 */
	function setTag09($value){
		$this->tag09 = TableObjectUtil::cast($value,"text");
	}
	/**
	 * 
	 */
	function getTag09(){
		return $this->tag09;
	}
	/**
	 * 
	 * @return database.model.Column
	 */
	function columnTag10(){
		if(!Rhaco::isVariable("_R_D_C_","Uploader::Tag10")){
			$column = new Column("column=tag10,variable=tag10,type=text,max=20,",__CLASS__);
			$column->label(Message::_("tag10"));
			Rhaco::addVariable("_R_D_C_",$column,"Uploader::Tag10");
		}
		return Rhaco::getVariable("_R_D_C_",null,"Uploader::Tag10");
	}
	/**
	 * 
	 * @return text
	 */
	function setTag10($value){
		$this->tag10 = TableObjectUtil::cast($value,"text");
	}
	/**
	 * 
	 */
	function getTag10(){
		return $this->tag10;
	}
	/**
	 * 
	 * @return database.model.Column
	 */
	function columnDownloadCount(){
		if(!Rhaco::isVariable("_R_D_C_","Uploader::DownloadCount")){
			$column = new Column("column=download_count,variable=downloadCount,type=integer,size=22,",__CLASS__);
			$column->label(Message::_("ダウンロード数"));
			Rhaco::addVariable("_R_D_C_",$column,"Uploader::DownloadCount");
		}
		return Rhaco::getVariable("_R_D_C_",null,"Uploader::DownloadCount");
	}
	/**
	 * 
	 * @return integer
	 */
	function setDownloadCount($value){
		$this->downloadCount = TableObjectUtil::cast($value,"integer");
	}
	/**
	 * 
	 */
	function getDownloadCount(){
		return $this->downloadCount;
	}
	/**
	 * 
	 * @return database.model.Column
	 */
	function columnDownloadPath(){
		if(!Rhaco::isVariable("_R_D_C_","Uploader::DownloadPath")){
			$column = new Column("column=download_path,variable=downloadPath,type=string,require=true,unique=true,",__CLASS__);
			$column->label(Message::_("download_path"));
			Rhaco::addVariable("_R_D_C_",$column,"Uploader::DownloadPath");
		}
		return Rhaco::getVariable("_R_D_C_",null,"Uploader::DownloadPath");
	}
	/**
	 * 
	 * @return string
	 */
	function setDownloadPath($value){
		$this->downloadPath = TableObjectUtil::cast($value,"string");
	}
	/**
	 * 
	 */
	function getDownloadPath(){
		return $this->downloadPath;
	}
	/**
	 * 
	 * @return database.model.Column
	 */
	function columnDownloadKey(){
		if(!Rhaco::isVariable("_R_D_C_","Uploader::DownloadKey")){
			$column = new Column("column=download_key,variable=downloadKey,type=text,",__CLASS__);
			$column->label(Message::_("download_key"));
			Rhaco::addVariable("_R_D_C_",$column,"Uploader::DownloadKey");
		}
		return Rhaco::getVariable("_R_D_C_",null,"Uploader::DownloadKey");
	}
	/**
	 * 
	 * @return text
	 */
	function setDownloadKey($value){
		$this->downloadKey = TableObjectUtil::cast($value,"text");
	}
	/**
	 * 
	 */
	function getDownloadKey(){
		return $this->downloadKey;
	}
	/**
	 * 
	 * @return database.model.Column
	 */
	function columnDeleteKey(){
		if(!Rhaco::isVariable("_R_D_C_","Uploader::DeleteKey")){
			$column = new Column("column=delete_key,variable=deleteKey,type=text,",__CLASS__);
			$column->label(Message::_("delete_key"));
			Rhaco::addVariable("_R_D_C_",$column,"Uploader::DeleteKey");
		}
		return Rhaco::getVariable("_R_D_C_",null,"Uploader::DeleteKey");
	}
	/**
	 * 
	 * @return text
	 */
	function setDeleteKey($value){
		$this->deleteKey = TableObjectUtil::cast($value,"text");
	}
	/**
	 * 
	 */
	function getDeleteKey(){
		return $this->deleteKey;
	}
	/**
	 * 
	 * @return database.model.Column
	 */
	function columnDeleteFlag(){
		if(!Rhaco::isVariable("_R_D_C_","Uploader::DeleteFlag")){
			$column = new Column("column=delete_flag,variable=deleteFlag,type=boolean,",__CLASS__);
			$column->label(Message::_("delete_flag"));
			Rhaco::addVariable("_R_D_C_",$column,"Uploader::DeleteFlag");
		}
		return Rhaco::getVariable("_R_D_C_",null,"Uploader::DeleteFlag");
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
	function columnUpdatedAt(){
		if(!Rhaco::isVariable("_R_D_C_","Uploader::UpdatedAt")){
			$column = new Column("column=updated_at,variable=updatedAt,type=timestamp,",__CLASS__);
			$column->label(Message::_("更新日時"));
			Rhaco::addVariable("_R_D_C_",$column,"Uploader::UpdatedAt");
		}
		return Rhaco::getVariable("_R_D_C_",null,"Uploader::UpdatedAt");
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
	function columnCreatedAt(){
		if(!Rhaco::isVariable("_R_D_C_","Uploader::CreatedAt")){
			$column = new Column("column=created_at,variable=createdAt,type=timestamp,",__CLASS__);
			$column->label(Message::_("作成日時"));
			Rhaco::addVariable("_R_D_C_",$column,"Uploader::CreatedAt");
		}
		return Rhaco::getVariable("_R_D_C_",null,"Uploader::CreatedAt");
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
	function getFactCategoryId(){
		return $this->factCategoryId;
	}
	function setFactCategoryId($obj){
		$this->factCategoryId = $obj;
	}
}
?>