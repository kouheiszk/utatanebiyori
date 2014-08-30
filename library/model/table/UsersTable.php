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
class UsersTable extends TableObjectBase{
	/**  */
	var $id;
	/**  */
	var $userId;
	/**  */
	var $userName;
	/**  */
	var $email;
	/**  */
	var $password;
	/**  */
	var $image;
	/**  */
	var $imageX;
	/**  */
	var $imageY;
	/**  */
	var $introduceId;
	/**  */
	var $privateFlag;
	/**  */
	var $lastLogin;
	/**  */
	var $createdAt;
	/**  */
	var $updatedAt;
	/**  */
	var $deleteFlag;
	/**  */
	var $actKey;
	var $newPassword;
	var $passwordConf;
	var $dependWhispers;
	var $dependWikiss;
	var $dependWikisAttachs;
	var $dependUploaders;
	var $dependWhisperFollowerss;
	var $dependWhisperRequestss;
	var $whisperFollowedUserss;
	var $whisperRequestedUserss;


	function UsersTable($id=null){
		$this->__init__($id);
	}
	function __init__($id=null){
		$this->id = null;
		$this->userId = null;
		$this->userName = null;
		$this->email = null;
		$this->password = null;
		$this->image = null;
		$this->imageX = null;
		$this->imageY = null;
		$this->introduceId = null;
		$this->privateFlag = 0;
		$this->lastLogin = time();
		$this->createdAt = time();
		$this->updatedAt = time();
		$this->deleteFlag = 0;
		$this->actKey = null;
		$this->newPassword = null;
		$this->passwordConf = null;
		$this->setId($id);
	}
	function connection(){
		if(!Rhaco::isVariable("_R_D_CON_","utatanebiyori")){
			Rhaco::addVariable("_R_D_CON_",new DbConnection("utatanebiyori"),"utatanebiyori");
		}
		return Rhaco::getVariable("_R_D_CON_",null,"utatanebiyori");
	}
	function table(){
		if(!Rhaco::isVariable("_R_D_T_","Users")){
			Rhaco::addVariable("_R_D_T_",new Table(Rhaco::constant("DATABASE_utatanebiyori_PREFIX")."users",__CLASS__),"Users");
		}
		return Rhaco::getVariable("_R_D_T_",null,"Users");
	}


	/**
	 * 
	 * @return database.model.Column
	 */
	function columnId(){
		if(!Rhaco::isVariable("_R_D_C_","Users::Id")){
			$column = new Column("column=id,variable=id,type=serial,size=22,primary=true,",__CLASS__);
			$column->label(Message::_("id"));
			$column->depend("Whisper::UserId","Wikis::UserId","WikisAttach::UserId","Uploader::UserId","WhisperFollowers::UserId","WhisperRequests::UserId");
			Rhaco::addVariable("_R_D_C_",$column,"Users::Id");
		}
		return Rhaco::getVariable("_R_D_C_",null,"Users::Id");
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
		if(!Rhaco::isVariable("_R_D_C_","Users::UserId")){
			$column = new Column("column=user_id,variable=userId,type=string,require=true,unique=true,chartype=/^[a-zA-Z0-9]+$/,",__CLASS__);
			$column->label(Message::_("ユーザーID"));
			Rhaco::addVariable("_R_D_C_",$column,"Users::UserId");
		}
		return Rhaco::getVariable("_R_D_C_",null,"Users::UserId");
	}
	/**
	 * 
	 * @return string
	 */
	function setUserId($value){
		$this->userId = TableObjectUtil::cast($value,"string");
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
	function columnUserName(){
		if(!Rhaco::isVariable("_R_D_C_","Users::UserName")){
			$column = new Column("column=user_name,variable=userName,type=string,max=30,require=true,unique=true,",__CLASS__);
			$column->label(Message::_("ユーザー名"));
			Rhaco::addVariable("_R_D_C_",$column,"Users::UserName");
		}
		return Rhaco::getVariable("_R_D_C_",null,"Users::UserName");
	}
	/**
	 * 
	 * @return string
	 */
	function setUserName($value){
		$this->userName = TableObjectUtil::cast($value,"string");
	}
	/**
	 * 
	 */
	function getUserName(){
		return $this->userName;
	}
	/**
	 * 
	 * @return database.model.Column
	 */
	function columnEmail(){
		if(!Rhaco::isVariable("_R_D_C_","Users::Email")){
			$column = new Column("column=email,variable=email,type=email,size=255,require=true,unique=true,",__CLASS__);
			$column->label(Message::_("メールアドレス"));
			Rhaco::addVariable("_R_D_C_",$column,"Users::Email");
		}
		return Rhaco::getVariable("_R_D_C_",null,"Users::Email");
	}
	/**
	 * 
	 * @return email
	 */
	function setEmail($value){
		$this->email = TableObjectUtil::cast($value,"email");
	}
	/**
	 * 
	 */
	function getEmail(){
		return $this->email;
	}
	/**
	 * 
	 * @return database.model.Column
	 */
	function columnPassword(){
		if(!Rhaco::isVariable("_R_D_C_","Users::Password")){
			$column = new Column("column=password,variable=password,type=string,require=true,",__CLASS__);
			$column->label(Message::_("パスワード"));
			Rhaco::addVariable("_R_D_C_",$column,"Users::Password");
		}
		return Rhaco::getVariable("_R_D_C_",null,"Users::Password");
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
	function columnImage(){
		if(!Rhaco::isVariable("_R_D_C_","Users::Image")){
			$column = new Column("column=image,variable=image,type=string,",__CLASS__);
			$column->label(Message::_("image"));
			Rhaco::addVariable("_R_D_C_",$column,"Users::Image");
		}
		return Rhaco::getVariable("_R_D_C_",null,"Users::Image");
	}
	/**
	 * 
	 * @return string
	 */
	function setImage($value){
		$this->image = TableObjectUtil::cast($value,"string");
	}
	/**
	 * 
	 */
	function getImage(){
		return $this->image;
	}
	/**
	 * 
	 * @return database.model.Column
	 */
	function columnImageX(){
		if(!Rhaco::isVariable("_R_D_C_","Users::ImageX")){
			$column = new Column("column=image_x,variable=imageX,type=integer,size=22,",__CLASS__);
			$column->label(Message::_("image_x"));
			Rhaco::addVariable("_R_D_C_",$column,"Users::ImageX");
		}
		return Rhaco::getVariable("_R_D_C_",null,"Users::ImageX");
	}
	/**
	 * 
	 * @return integer
	 */
	function setImageX($value){
		$this->imageX = TableObjectUtil::cast($value,"integer");
	}
	/**
	 * 
	 */
	function getImageX(){
		return $this->imageX;
	}
	/**
	 * 
	 * @return database.model.Column
	 */
	function columnImageY(){
		if(!Rhaco::isVariable("_R_D_C_","Users::ImageY")){
			$column = new Column("column=image_y,variable=imageY,type=integer,size=22,",__CLASS__);
			$column->label(Message::_("image_y"));
			Rhaco::addVariable("_R_D_C_",$column,"Users::ImageY");
		}
		return Rhaco::getVariable("_R_D_C_",null,"Users::ImageY");
	}
	/**
	 * 
	 * @return integer
	 */
	function setImageY($value){
		$this->imageY = TableObjectUtil::cast($value,"integer");
	}
	/**
	 * 
	 */
	function getImageY(){
		return $this->imageY;
	}
	/**
	 * 
	 * @return database.model.Column
	 */
	function columnIntroduceId(){
		if(!Rhaco::isVariable("_R_D_C_","Users::IntroduceId")){
			$column = new Column("column=introduce_id,variable=introduceId,type=integer,size=22,",__CLASS__);
			$column->label(Message::_("introduce_id"));
			Rhaco::addVariable("_R_D_C_",$column,"Users::IntroduceId");
		}
		return Rhaco::getVariable("_R_D_C_",null,"Users::IntroduceId");
	}
	/**
	 * 
	 * @return integer
	 */
	function setIntroduceId($value){
		$this->introduceId = TableObjectUtil::cast($value,"integer");
	}
	/**
	 * 
	 */
	function getIntroduceId(){
		return $this->introduceId;
	}
	/**
	 * 
	 * @return database.model.Column
	 */
	function columnPrivateFlag(){
		if(!Rhaco::isVariable("_R_D_C_","Users::PrivateFlag")){
			$column = new Column("column=private_flag,variable=privateFlag,type=boolean,",__CLASS__);
			$column->label(Message::_("private_flag"));
			Rhaco::addVariable("_R_D_C_",$column,"Users::PrivateFlag");
		}
		return Rhaco::getVariable("_R_D_C_",null,"Users::PrivateFlag");
	}
	/**
	 * 
	 * @return boolean
	 */
	function setPrivateFlag($value){
		$this->privateFlag = TableObjectUtil::cast($value,"boolean");
	}
	/**
	 * 
	 */
	function getPrivateFlag(){
		return $this->privateFlag;
	}
	/**  */
	function isPrivateFlag(){
		return Variable::bool($this->privateFlag);
	}
	/**
	 * 
	 * @return database.model.Column
	 */
	function columnLastLogin(){
		if(!Rhaco::isVariable("_R_D_C_","Users::LastLogin")){
			$column = new Column("column=last_login,variable=lastLogin,type=timestamp,",__CLASS__);
			$column->label(Message::_("last_login"));
			Rhaco::addVariable("_R_D_C_",$column,"Users::LastLogin");
		}
		return Rhaco::getVariable("_R_D_C_",null,"Users::LastLogin");
	}
	/**
	 * 
	 * @return timestamp
	 */
	function setLastLogin($value){
		$this->lastLogin = TableObjectUtil::cast($value,"timestamp");
	}
	/**
	 * 
	 */
	function getLastLogin(){
		return $this->lastLogin;
	}
	/**  */
	function formatLastLogin($format="Y/m/d H:i:s"){
		return DateUtil::format($this->lastLogin,$format);
	}
	/**
	 * 
	 * @return database.model.Column
	 */
	function columnCreatedAt(){
		if(!Rhaco::isVariable("_R_D_C_","Users::CreatedAt")){
			$column = new Column("column=created_at,variable=createdAt,type=timestamp,",__CLASS__);
			$column->label(Message::_("created_at"));
			Rhaco::addVariable("_R_D_C_",$column,"Users::CreatedAt");
		}
		return Rhaco::getVariable("_R_D_C_",null,"Users::CreatedAt");
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
		if(!Rhaco::isVariable("_R_D_C_","Users::UpdatedAt")){
			$column = new Column("column=updated_at,variable=updatedAt,type=timestamp,",__CLASS__);
			$column->label(Message::_("updated_at"));
			Rhaco::addVariable("_R_D_C_",$column,"Users::UpdatedAt");
		}
		return Rhaco::getVariable("_R_D_C_",null,"Users::UpdatedAt");
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
		if(!Rhaco::isVariable("_R_D_C_","Users::DeleteFlag")){
			$column = new Column("column=delete_flag,variable=deleteFlag,type=boolean,",__CLASS__);
			$column->label(Message::_("delete_flag"));
			Rhaco::addVariable("_R_D_C_",$column,"Users::DeleteFlag");
		}
		return Rhaco::getVariable("_R_D_C_",null,"Users::DeleteFlag");
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
	function columnActKey(){
		if(!Rhaco::isVariable("_R_D_C_","Users::ActKey")){
			$column = new Column("column=act_key,variable=actKey,type=string,",__CLASS__);
			$column->label(Message::_("act_key"));
			Rhaco::addVariable("_R_D_C_",$column,"Users::ActKey");
		}
		return Rhaco::getVariable("_R_D_C_",null,"Users::ActKey");
	}
	/**
	 * 
	 * @return string
	 */
	function setActKey($value){
		$this->actKey = TableObjectUtil::cast($value,"string");
	}
	/**
	 * 
	 */
	function getActKey(){
		return $this->actKey;
	}
	/**
	 * 
	 * @return database.model.Column
	 */
	function extraNewPassword(){
		if(!Rhaco::isVariable("_R_D_C_","Users::NewPassword")){
			$column = new Column("column=new_password,variable=newPassword,type=string,min=3,",__CLASS__);
			$column->label(Message::_("new_password"));
			Rhaco::addVariable("_R_D_C_",$column,"Users::NewPassword");
		}
		return Rhaco::getVariable("_R_D_C_",null,"Users::NewPassword");
	}
	/**
	 * 
	 * @return string
	 */
	function setNewPassword($value){
		$this->newPassword = TableObjectUtil::cast($value,"string");
	}
	/**
	 * 
	 */
	function getNewPassword(){
		return $this->newPassword;
	}
	/**
	 * 
	 * @return database.model.Column
	 */
	function extraPasswordConf(){
		if(!Rhaco::isVariable("_R_D_C_","Users::PasswordConf")){
			$column = new Column("column=password_conf,variable=passwordConf,type=string,",__CLASS__);
			$column->label(Message::_("password_conf"));
			Rhaco::addVariable("_R_D_C_",$column,"Users::PasswordConf");
		}
		return Rhaco::getVariable("_R_D_C_",null,"Users::PasswordConf");
	}
	/**
	 * 
	 * @return string
	 */
	function setPasswordConf($value){
		$this->passwordConf = TableObjectUtil::cast($value,"string");
	}
	/**
	 * 
	 */
	function getPasswordConf(){
		return $this->passwordConf;
	}


	function setDependWhispers($value){
		$this->dependWhispers = $value;
	}
	function getDependWhispers(){
		return $this->dependWhispers;
	}
	function setDependWikiss($value){
		$this->dependWikiss = $value;
	}
	function getDependWikiss(){
		return $this->dependWikiss;
	}
	function setDependWikisAttachs($value){
		$this->dependWikisAttachs = $value;
	}
	function getDependWikisAttachs(){
		return $this->dependWikisAttachs;
	}
	function setDependUploaders($value){
		$this->dependUploaders = $value;
	}
	function getDependUploaders(){
		return $this->dependUploaders;
	}
	function setDependWhisperFollowerss($value){
		$this->dependWhisperFollowerss = $value;
	}
	function getDependWhisperFollowerss(){
		return $this->dependWhisperFollowerss;
	}
	function setDependWhisperRequestss($value){
		$this->dependWhisperRequestss = $value;
	}
	function getDependWhisperRequestss(){
		return $this->dependWhisperRequestss;
	}
	function setWhisperFollowedUserss($value){
		$this->whisperFollowedUserss = $value;
	}
	function getWhisperFollowedUserss(){
		return $this->whisperFollowedUserss;
	}
	function setWhisperRequestedUserss($value){
		$this->whisperRequestedUserss = $value;
	}
	function getWhisperRequestedUserss(){
		return $this->whisperRequestedUserss;
	}
}
?>