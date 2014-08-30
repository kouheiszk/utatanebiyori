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
class WhisperFollowedUsersTable extends Users{
	var $dependWhisperFollowerss;
	var $userss;

	function table(){
		if(!Rhaco::isVariable("_R_D_T_","WhisperFollowedUsers")){
			Rhaco::addVariable("_R_D_T_",new Table(parent::table(),__CLASS__),"WhisperFollowedUsers");
		}
		return Rhaco::getVariable("_R_D_T_",null,"WhisperFollowedUsers");
	}
	function columns(){
		return array(WhisperFollowedUsers::columnId(),WhisperFollowedUsers::columnUserId(),WhisperFollowedUsers::columnUserName(),WhisperFollowedUsers::columnEmail(),WhisperFollowedUsers::columnPassword(),WhisperFollowedUsers::columnImage(),WhisperFollowedUsers::columnImageX(),WhisperFollowedUsers::columnImageY(),WhisperFollowedUsers::columnIntroduceId(),WhisperFollowedUsers::columnPrivateFlag(),WhisperFollowedUsers::columnLastLogin(),WhisperFollowedUsers::columnCreatedAt(),WhisperFollowedUsers::columnUpdatedAt(),WhisperFollowedUsers::columnDeleteFlag(),WhisperFollowedUsers::columnActKey(),);
	}
	function columnId(){
		if(!Rhaco::isVariable("_R_D_C_","WhisperFollowedUsers::Id")){
			Rhaco::addVariable("_R_D_C_",new Column(parent::columnId(),__CLASS__),"WhisperFollowedUsers::Id");
		}
		return Rhaco::getVariable("_R_D_C_",null,"WhisperFollowedUsers::Id");			
	}
	function columnUserId(){
		if(!Rhaco::isVariable("_R_D_C_","WhisperFollowedUsers::UserId")){
			Rhaco::addVariable("_R_D_C_",new Column(parent::columnUserId(),__CLASS__),"WhisperFollowedUsers::UserId");
		}
		return Rhaco::getVariable("_R_D_C_",null,"WhisperFollowedUsers::UserId");			
	}
	function columnUserName(){
		if(!Rhaco::isVariable("_R_D_C_","WhisperFollowedUsers::UserName")){
			Rhaco::addVariable("_R_D_C_",new Column(parent::columnUserName(),__CLASS__),"WhisperFollowedUsers::UserName");
		}
		return Rhaco::getVariable("_R_D_C_",null,"WhisperFollowedUsers::UserName");			
	}
	function columnEmail(){
		if(!Rhaco::isVariable("_R_D_C_","WhisperFollowedUsers::Email")){
			Rhaco::addVariable("_R_D_C_",new Column(parent::columnEmail(),__CLASS__),"WhisperFollowedUsers::Email");
		}
		return Rhaco::getVariable("_R_D_C_",null,"WhisperFollowedUsers::Email");			
	}
	function columnPassword(){
		if(!Rhaco::isVariable("_R_D_C_","WhisperFollowedUsers::Password")){
			Rhaco::addVariable("_R_D_C_",new Column(parent::columnPassword(),__CLASS__),"WhisperFollowedUsers::Password");
		}
		return Rhaco::getVariable("_R_D_C_",null,"WhisperFollowedUsers::Password");			
	}
	function columnImage(){
		if(!Rhaco::isVariable("_R_D_C_","WhisperFollowedUsers::Image")){
			Rhaco::addVariable("_R_D_C_",new Column(parent::columnImage(),__CLASS__),"WhisperFollowedUsers::Image");
		}
		return Rhaco::getVariable("_R_D_C_",null,"WhisperFollowedUsers::Image");			
	}
	function columnImageX(){
		if(!Rhaco::isVariable("_R_D_C_","WhisperFollowedUsers::ImageX")){
			Rhaco::addVariable("_R_D_C_",new Column(parent::columnImageX(),__CLASS__),"WhisperFollowedUsers::ImageX");
		}
		return Rhaco::getVariable("_R_D_C_",null,"WhisperFollowedUsers::ImageX");			
	}
	function columnImageY(){
		if(!Rhaco::isVariable("_R_D_C_","WhisperFollowedUsers::ImageY")){
			Rhaco::addVariable("_R_D_C_",new Column(parent::columnImageY(),__CLASS__),"WhisperFollowedUsers::ImageY");
		}
		return Rhaco::getVariable("_R_D_C_",null,"WhisperFollowedUsers::ImageY");			
	}
	function columnIntroduceId(){
		if(!Rhaco::isVariable("_R_D_C_","WhisperFollowedUsers::IntroduceId")){
			Rhaco::addVariable("_R_D_C_",new Column(parent::columnIntroduceId(),__CLASS__),"WhisperFollowedUsers::IntroduceId");
		}
		return Rhaco::getVariable("_R_D_C_",null,"WhisperFollowedUsers::IntroduceId");			
	}
	function columnPrivateFlag(){
		if(!Rhaco::isVariable("_R_D_C_","WhisperFollowedUsers::PrivateFlag")){
			Rhaco::addVariable("_R_D_C_",new Column(parent::columnPrivateFlag(),__CLASS__),"WhisperFollowedUsers::PrivateFlag");
		}
		return Rhaco::getVariable("_R_D_C_",null,"WhisperFollowedUsers::PrivateFlag");			
	}
	function columnLastLogin(){
		if(!Rhaco::isVariable("_R_D_C_","WhisperFollowedUsers::LastLogin")){
			Rhaco::addVariable("_R_D_C_",new Column(parent::columnLastLogin(),__CLASS__),"WhisperFollowedUsers::LastLogin");
		}
		return Rhaco::getVariable("_R_D_C_",null,"WhisperFollowedUsers::LastLogin");			
	}
	function columnCreatedAt(){
		if(!Rhaco::isVariable("_R_D_C_","WhisperFollowedUsers::CreatedAt")){
			Rhaco::addVariable("_R_D_C_",new Column(parent::columnCreatedAt(),__CLASS__),"WhisperFollowedUsers::CreatedAt");
		}
		return Rhaco::getVariable("_R_D_C_",null,"WhisperFollowedUsers::CreatedAt");			
	}
	function columnUpdatedAt(){
		if(!Rhaco::isVariable("_R_D_C_","WhisperFollowedUsers::UpdatedAt")){
			Rhaco::addVariable("_R_D_C_",new Column(parent::columnUpdatedAt(),__CLASS__),"WhisperFollowedUsers::UpdatedAt");
		}
		return Rhaco::getVariable("_R_D_C_",null,"WhisperFollowedUsers::UpdatedAt");			
	}
	function columnDeleteFlag(){
		if(!Rhaco::isVariable("_R_D_C_","WhisperFollowedUsers::DeleteFlag")){
			Rhaco::addVariable("_R_D_C_",new Column(parent::columnDeleteFlag(),__CLASS__),"WhisperFollowedUsers::DeleteFlag");
		}
		return Rhaco::getVariable("_R_D_C_",null,"WhisperFollowedUsers::DeleteFlag");			
	}
	function columnActKey(){
		if(!Rhaco::isVariable("_R_D_C_","WhisperFollowedUsers::ActKey")){
			Rhaco::addVariable("_R_D_C_",new Column(parent::columnActKey(),__CLASS__),"WhisperFollowedUsers::ActKey");
		}
		return Rhaco::getVariable("_R_D_C_",null,"WhisperFollowedUsers::ActKey");			
	}
	function setDependWhisperFollowerss($value){
		$this->dependWhisperFollowerss = $value;
	}
	function getDependWhisperFollowerss(){
		return $this->dependWhisperFollowerss;
	}
	function setUserss($value){
		$this->userss = $value;
	}
	function getUserss(){
		return $this->userss;
	}
}
?>