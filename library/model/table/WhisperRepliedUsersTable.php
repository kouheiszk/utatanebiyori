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
class WhisperRepliedUsersTable extends Users{

	function table(){
		if(!Rhaco::isVariable("_R_D_T_","WhisperRepliedUsers")){
			Rhaco::addVariable("_R_D_T_",new Table(parent::table(),__CLASS__),"WhisperRepliedUsers");
		}
		return Rhaco::getVariable("_R_D_T_",null,"WhisperRepliedUsers");
	}
	function columns(){
		return array(WhisperRepliedUsers::columnId(),WhisperRepliedUsers::columnUserId(),WhisperRepliedUsers::columnUserName(),WhisperRepliedUsers::columnEmail(),WhisperRepliedUsers::columnPassword(),WhisperRepliedUsers::columnImage(),WhisperRepliedUsers::columnImageX(),WhisperRepliedUsers::columnImageY(),WhisperRepliedUsers::columnIntroduceId(),WhisperRepliedUsers::columnPrivateFlag(),WhisperRepliedUsers::columnLastLogin(),WhisperRepliedUsers::columnCreatedAt(),WhisperRepliedUsers::columnUpdatedAt(),WhisperRepliedUsers::columnDeleteFlag(),WhisperRepliedUsers::columnActKey(),);
	}
	function columnId(){
		if(!Rhaco::isVariable("_R_D_C_","WhisperRepliedUsers::Id")){
			Rhaco::addVariable("_R_D_C_",new Column(parent::columnId(),__CLASS__),"WhisperRepliedUsers::Id");
		}
		return Rhaco::getVariable("_R_D_C_",null,"WhisperRepliedUsers::Id");			
	}
	function columnUserId(){
		if(!Rhaco::isVariable("_R_D_C_","WhisperRepliedUsers::UserId")){
			Rhaco::addVariable("_R_D_C_",new Column(parent::columnUserId(),__CLASS__),"WhisperRepliedUsers::UserId");
		}
		return Rhaco::getVariable("_R_D_C_",null,"WhisperRepliedUsers::UserId");			
	}
	function columnUserName(){
		if(!Rhaco::isVariable("_R_D_C_","WhisperRepliedUsers::UserName")){
			Rhaco::addVariable("_R_D_C_",new Column(parent::columnUserName(),__CLASS__),"WhisperRepliedUsers::UserName");
		}
		return Rhaco::getVariable("_R_D_C_",null,"WhisperRepliedUsers::UserName");			
	}
	function columnEmail(){
		if(!Rhaco::isVariable("_R_D_C_","WhisperRepliedUsers::Email")){
			Rhaco::addVariable("_R_D_C_",new Column(parent::columnEmail(),__CLASS__),"WhisperRepliedUsers::Email");
		}
		return Rhaco::getVariable("_R_D_C_",null,"WhisperRepliedUsers::Email");			
	}
	function columnPassword(){
		if(!Rhaco::isVariable("_R_D_C_","WhisperRepliedUsers::Password")){
			Rhaco::addVariable("_R_D_C_",new Column(parent::columnPassword(),__CLASS__),"WhisperRepliedUsers::Password");
		}
		return Rhaco::getVariable("_R_D_C_",null,"WhisperRepliedUsers::Password");			
	}
	function columnImage(){
		if(!Rhaco::isVariable("_R_D_C_","WhisperRepliedUsers::Image")){
			Rhaco::addVariable("_R_D_C_",new Column(parent::columnImage(),__CLASS__),"WhisperRepliedUsers::Image");
		}
		return Rhaco::getVariable("_R_D_C_",null,"WhisperRepliedUsers::Image");			
	}
	function columnImageX(){
		if(!Rhaco::isVariable("_R_D_C_","WhisperRepliedUsers::ImageX")){
			Rhaco::addVariable("_R_D_C_",new Column(parent::columnImageX(),__CLASS__),"WhisperRepliedUsers::ImageX");
		}
		return Rhaco::getVariable("_R_D_C_",null,"WhisperRepliedUsers::ImageX");			
	}
	function columnImageY(){
		if(!Rhaco::isVariable("_R_D_C_","WhisperRepliedUsers::ImageY")){
			Rhaco::addVariable("_R_D_C_",new Column(parent::columnImageY(),__CLASS__),"WhisperRepliedUsers::ImageY");
		}
		return Rhaco::getVariable("_R_D_C_",null,"WhisperRepliedUsers::ImageY");			
	}
	function columnIntroduceId(){
		if(!Rhaco::isVariable("_R_D_C_","WhisperRepliedUsers::IntroduceId")){
			Rhaco::addVariable("_R_D_C_",new Column(parent::columnIntroduceId(),__CLASS__),"WhisperRepliedUsers::IntroduceId");
		}
		return Rhaco::getVariable("_R_D_C_",null,"WhisperRepliedUsers::IntroduceId");			
	}
	function columnPrivateFlag(){
		if(!Rhaco::isVariable("_R_D_C_","WhisperRepliedUsers::PrivateFlag")){
			Rhaco::addVariable("_R_D_C_",new Column(parent::columnPrivateFlag(),__CLASS__),"WhisperRepliedUsers::PrivateFlag");
		}
		return Rhaco::getVariable("_R_D_C_",null,"WhisperRepliedUsers::PrivateFlag");			
	}
	function columnLastLogin(){
		if(!Rhaco::isVariable("_R_D_C_","WhisperRepliedUsers::LastLogin")){
			Rhaco::addVariable("_R_D_C_",new Column(parent::columnLastLogin(),__CLASS__),"WhisperRepliedUsers::LastLogin");
		}
		return Rhaco::getVariable("_R_D_C_",null,"WhisperRepliedUsers::LastLogin");			
	}
	function columnCreatedAt(){
		if(!Rhaco::isVariable("_R_D_C_","WhisperRepliedUsers::CreatedAt")){
			Rhaco::addVariable("_R_D_C_",new Column(parent::columnCreatedAt(),__CLASS__),"WhisperRepliedUsers::CreatedAt");
		}
		return Rhaco::getVariable("_R_D_C_",null,"WhisperRepliedUsers::CreatedAt");			
	}
	function columnUpdatedAt(){
		if(!Rhaco::isVariable("_R_D_C_","WhisperRepliedUsers::UpdatedAt")){
			Rhaco::addVariable("_R_D_C_",new Column(parent::columnUpdatedAt(),__CLASS__),"WhisperRepliedUsers::UpdatedAt");
		}
		return Rhaco::getVariable("_R_D_C_",null,"WhisperRepliedUsers::UpdatedAt");			
	}
	function columnDeleteFlag(){
		if(!Rhaco::isVariable("_R_D_C_","WhisperRepliedUsers::DeleteFlag")){
			Rhaco::addVariable("_R_D_C_",new Column(parent::columnDeleteFlag(),__CLASS__),"WhisperRepliedUsers::DeleteFlag");
		}
		return Rhaco::getVariable("_R_D_C_",null,"WhisperRepliedUsers::DeleteFlag");			
	}
	function columnActKey(){
		if(!Rhaco::isVariable("_R_D_C_","WhisperRepliedUsers::ActKey")){
			Rhaco::addVariable("_R_D_C_",new Column(parent::columnActKey(),__CLASS__),"WhisperRepliedUsers::ActKey");
		}
		return Rhaco::getVariable("_R_D_C_",null,"WhisperRepliedUsers::ActKey");			
	}
}
?>