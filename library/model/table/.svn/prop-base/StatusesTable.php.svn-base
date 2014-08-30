<?php
Rhaco::import("resources.Message");
Rhaco::import("database.model.TableObjectBase");
Rhaco::import("database.model.DbConnection");
Rhaco::import("model.Users");
Rhaco::import("database.TableObjectUtil");
Rhaco::import("database.model.Table");
Rhaco::import("database.model.Column");
/**
 * #ignore
 * 
 */
class WhisperRequestedUsersTable extends Users{
	var $dependWhisperRequestss;
	var $userss;

	function table(){
		if(!Rhaco::isVariable("_R_D_T_","WhisperRequestedUsers")){
			Rhaco::addVariable("_R_D_T_",new Table(parent::table(),__CLASS__),"WhisperRequestedUsers");
		}
		return Rhaco::getVariable("_R_D_T_",null,"WhisperRequestedUsers");
	}
	function columns(){
		return array(WhisperRequestedUsers::columnId(),WhisperRequestedUsers::columnUserId(),WhisperRequestedUsers::columnUserName(),WhisperRequestedUsers::columnEmail(),WhisperRequestedUsers::columnPassword(),WhisperRequestedUsers::columnImage(),WhisperRequestedUsers::columnImageX(),WhisperRequestedUsers::columnImageY(),WhisperRequestedUsers::columnIntroduceId(),WhisperRequestedUsers::columnPrivateFlag(),WhisperRequestedUsers::columnLastLogin(),WhisperRequestedUsers::columnCreatedAt(),WhisperRequestedUsers::columnUpdatedAt(),WhisperRequestedUsers::columnDeleteFlag(),WhisperRequestedUsers::columnActKey(),);
	}
	function columnId(){
		if(!Rhaco::isVariable("_R_D_C_","WhisperRequestedUsers::Id")){
			Rhaco::addVariable("_R_D_C_",new Column(parent::columnId(),__CLASS__),"WhisperRequestedUsers::Id");
		}
		return Rhaco::getVariable("_R_D_C_",null,"WhisperRequestedUsers::Id");			
	}
	function columnUserId(){
		if(!Rhaco::isVariable("_R_D_C_","WhisperRequestedUsers::UserId")){
			Rhaco::addVariable("_R_D_C_",new Column(parent::columnUserId(),__CLASS__),"WhisperRequestedUsers::UserId");
		}
		return Rhaco::getVariable("_R_D_C_",null,"WhisperRequestedUsers::UserId");			
	}
	function columnUserName(){
		if(!Rhaco::isVariable("_R_D_C_","WhisperRequestedUsers::UserName")){
			Rhaco::addVariable("_R_D_C_",new Column(parent::columnUserName(),__CLASS__),"WhisperRequestedUsers::UserName");
		}
		return Rhaco::getVariable("_R_D_C_",null,"WhisperRequestedUsers::UserName");			
	}
	function columnEmail(){
		if(!Rhaco::isVariable("_R_D_C_","WhisperRequestedUsers::Email")){
			Rhaco::addVariable("_R_D_C_",new Column(parent::columnEmail(),__CLASS__),"WhisperRequestedUsers::Email");
		}
		return Rhaco::getVariable("_R_D_C_",null,"WhisperRequestedUsers::Email");			
	}
	function columnPassword(){
		if(!Rhaco::isVariable("_R_D_C_","WhisperRequestedUsers::Password")){
			Rhaco::addVariable("_R_D_C_",new Column(parent::columnPassword(),__CLASS__),"WhisperRequestedUsers::Password");
		}
		return Rhaco::getVariable("_R_D_C_",null,"WhisperRequestedUsers::Password");			
	}
	function columnImage(){
		if(!Rhaco::isVariable("_R_D_C_","WhisperRequestedUsers::Image")){
			Rhaco::addVariable("_R_D_C_",new Column(parent::columnImage(),__CLASS__),"WhisperRequestedUsers::Image");
		}
		return Rhaco::getVariable("_R_D_C_",null,"WhisperRequestedUsers::Image");			
	}
	function columnImageX(){
		if(!Rhaco::isVariable("_R_D_C_","WhisperRequestedUsers::ImageX")){
			Rhaco::addVariable("_R_D_C_",new Column(parent::columnImageX(),__CLASS__),"WhisperRequestedUsers::ImageX");
		}
		return Rhaco::getVariable("_R_D_C_",null,"WhisperRequestedUsers::ImageX");			
	}
	function columnImageY(){
		if(!Rhaco::isVariable("_R_D_C_","WhisperRequestedUsers::ImageY")){
			Rhaco::addVariable("_R_D_C_",new Column(parent::columnImageY(),__CLASS__),"WhisperRequestedUsers::ImageY");
		}
		return Rhaco::getVariable("_R_D_C_",null,"WhisperRequestedUsers::ImageY");			
	}
	function columnIntroduceId(){
		if(!Rhaco::isVariable("_R_D_C_","WhisperRequestedUsers::IntroduceId")){
			Rhaco::addVariable("_R_D_C_",new Column(parent::columnIntroduceId(),__CLASS__),"WhisperRequestedUsers::IntroduceId");
		}
		return Rhaco::getVariable("_R_D_C_",null,"WhisperRequestedUsers::IntroduceId");			
	}
	function columnPrivateFlag(){
		if(!Rhaco::isVariable("_R_D_C_","WhisperRequestedUsers::PrivateFlag")){
			Rhaco::addVariable("_R_D_C_",new Column(parent::columnPrivateFlag(),__CLASS__),"WhisperRequestedUsers::PrivateFlag");
		}
		return Rhaco::getVariable("_R_D_C_",null,"WhisperRequestedUsers::PrivateFlag");			
	}
	function columnLastLogin(){
		if(!Rhaco::isVariable("_R_D_C_","WhisperRequestedUsers::LastLogin")){
			Rhaco::addVariable("_R_D_C_",new Column(parent::columnLastLogin(),__CLASS__),"WhisperRequestedUsers::LastLogin");
		}
		return Rhaco::getVariable("_R_D_C_",null,"WhisperRequestedUsers::LastLogin");			
	}
	function columnCreatedAt(){
		if(!Rhaco::isVariable("_R_D_C_","WhisperRequestedUsers::CreatedAt")){
			Rhaco::addVariable("_R_D_C_",new Column(parent::columnCreatedAt(),__CLASS__),"WhisperRequestedUsers::CreatedAt");
		}
		return Rhaco::getVariable("_R_D_C_",null,"WhisperRequestedUsers::CreatedAt");			
	}
	function columnUpdatedAt(){
		if(!Rhaco::isVariable("_R_D_C_","WhisperRequestedUsers::UpdatedAt")){
			Rhaco::addVariable("_R_D_C_",new Column(parent::columnUpdatedAt(),__CLASS__),"WhisperRequestedUsers::UpdatedAt");
		}
		return Rhaco::getVariable("_R_D_C_",null,"WhisperRequestedUsers::UpdatedAt");			
	}
	function columnDeleteFlag(){
		if(!Rhaco::isVariable("_R_D_C_","WhisperRequestedUsers::DeleteFlag")){
			Rhaco::addVariable("_R_D_C_",new Column(parent::columnDeleteFlag(),__CLASS__),"WhisperRequestedUsers::DeleteFlag");
		}
		return Rhaco::getVariable("_R_D_C_",null,"WhisperRequestedUsers::DeleteFlag");			
	}
	function columnActKey(){
		if(!Rhaco::isVariable("_R_D_C_","WhisperRequestedUsers::ActKey")){
			Rhaco::addVariable("_R_D_C_",new Column(parent::columnActKey(),__CLASS__),"WhisperRequestedUsers::ActKey");
		}
		return Rhaco::getVariable("_R_D_C_",null,"WhisperRequestedUsers::ActKey");			
	}
	function setDependWhisperRequestss($value){
		$this->dependWhisperRequestss = $value;
	}
	function getDependWhisperRequestss(){
		return $this->dependWhisperRequestss;
	}
	function setUserss($value){
		$this->userss = $value;
	}
	function getUserss(){
		return $this->userss;
	}
}
?>