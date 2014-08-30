<?php
Rhaco::import("resources.Message");
Rhaco::import("database.model.TableObjectBase");
Rhaco::import("database.model.DbConnection");
Rhaco::import("database.TableObjectUtil");
Rhaco::import("database.model.Table");
Rhaco::import("database.model.Column");
/**
 * #ignore
 * Counter
 */
class CounterTable extends TableObjectBase{
	/**  */
	var $id;
	/**  */
	var $year;
	/**  */
	var $month;
	/**  */
	var $day;
	/**  */
	var $yesterday;
	/**  */
	var $today;
	/**  */
	var $total;
	/**  */
	var $host;


	function CounterTable($id=null){
		$this->__init__($id);
	}
	function __init__($id=null){
		$this->id = null;
		$this->year = null;
		$this->month = null;
		$this->day = null;
		$this->yesterday = null;
		$this->today = null;
		$this->total = null;
		$this->host = null;
		$this->setId($id);
	}
	function connection(){
		if(!Rhaco::isVariable("_R_D_CON_","utatanebiyori")){
			Rhaco::addVariable("_R_D_CON_",new DbConnection("utatanebiyori"),"utatanebiyori");
		}
		return Rhaco::getVariable("_R_D_CON_",null,"utatanebiyori");
	}
	function table(){
		if(!Rhaco::isVariable("_R_D_T_","Counter")){
			Rhaco::addVariable("_R_D_T_",new Table(Rhaco::constant("DATABASE_utatanebiyori_PREFIX")."counter",__CLASS__),"Counter");
		}
		return Rhaco::getVariable("_R_D_T_",null,"Counter");
	}


	/**
	 * 
	 * @return database.model.Column
	 */
	function columnId(){
		if(!Rhaco::isVariable("_R_D_C_","Counter::Id")){
			$column = new Column("column=id,variable=id,type=serial,size=22,primary=true,",__CLASS__);
			$column->label(Message::_("id"));
			Rhaco::addVariable("_R_D_C_",$column,"Counter::Id");
		}
		return Rhaco::getVariable("_R_D_C_",null,"Counter::Id");
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
	function columnYear(){
		if(!Rhaco::isVariable("_R_D_C_","Counter::Year")){
			$column = new Column("column=year,variable=year,type=integer,size=22,",__CLASS__);
			$column->label(Message::_("年"));
			Rhaco::addVariable("_R_D_C_",$column,"Counter::Year");
		}
		return Rhaco::getVariable("_R_D_C_",null,"Counter::Year");
	}
	/**
	 * 
	 * @return integer
	 */
	function setYear($value){
		$this->year = TableObjectUtil::cast($value,"integer");
	}
	/**
	 * 
	 */
	function getYear(){
		return $this->year;
	}
	/**
	 * 
	 * @return database.model.Column
	 */
	function columnMonth(){
		if(!Rhaco::isVariable("_R_D_C_","Counter::Month")){
			$column = new Column("column=month,variable=month,type=integer,size=22,",__CLASS__);
			$column->label(Message::_("月"));
			Rhaco::addVariable("_R_D_C_",$column,"Counter::Month");
		}
		return Rhaco::getVariable("_R_D_C_",null,"Counter::Month");
	}
	/**
	 * 
	 * @return integer
	 */
	function setMonth($value){
		$this->month = TableObjectUtil::cast($value,"integer");
	}
	/**
	 * 
	 */
	function getMonth(){
		return $this->month;
	}
	/**
	 * 
	 * @return database.model.Column
	 */
	function columnDay(){
		if(!Rhaco::isVariable("_R_D_C_","Counter::Day")){
			$column = new Column("column=day,variable=day,type=integer,size=22,",__CLASS__);
			$column->label(Message::_("day"));
			Rhaco::addVariable("_R_D_C_",$column,"Counter::Day");
		}
		return Rhaco::getVariable("_R_D_C_",null,"Counter::Day");
	}
	/**
	 * 
	 * @return integer
	 */
	function setDay($value){
		$this->day = TableObjectUtil::cast($value,"integer");
	}
	/**
	 * 
	 */
	function getDay(){
		return $this->day;
	}
	/**
	 * 
	 * @return database.model.Column
	 */
	function columnYesterday(){
		if(!Rhaco::isVariable("_R_D_C_","Counter::Yesterday")){
			$column = new Column("column=yesterday,variable=yesterday,type=integer,size=22,",__CLASS__);
			$column->label(Message::_("昨日のアクセス数"));
			Rhaco::addVariable("_R_D_C_",$column,"Counter::Yesterday");
		}
		return Rhaco::getVariable("_R_D_C_",null,"Counter::Yesterday");
	}
	/**
	 * 
	 * @return integer
	 */
	function setYesterday($value){
		$this->yesterday = TableObjectUtil::cast($value,"integer");
	}
	/**
	 * 
	 */
	function getYesterday(){
		return $this->yesterday;
	}
	/**
	 * 
	 * @return database.model.Column
	 */
	function columnToday(){
		if(!Rhaco::isVariable("_R_D_C_","Counter::Today")){
			$column = new Column("column=today,variable=today,type=integer,size=22,",__CLASS__);
			$column->label(Message::_("今日のアクセス数"));
			Rhaco::addVariable("_R_D_C_",$column,"Counter::Today");
		}
		return Rhaco::getVariable("_R_D_C_",null,"Counter::Today");
	}
	/**
	 * 
	 * @return integer
	 */
	function setToday($value){
		$this->today = TableObjectUtil::cast($value,"integer");
	}
	/**
	 * 
	 */
	function getToday(){
		return $this->today;
	}
	/**
	 * 
	 * @return database.model.Column
	 */
	function columnTotal(){
		if(!Rhaco::isVariable("_R_D_C_","Counter::Total")){
			$column = new Column("column=total,variable=total,type=integer,size=22,",__CLASS__);
			$column->label(Message::_("全体のアクセス数"));
			Rhaco::addVariable("_R_D_C_",$column,"Counter::Total");
		}
		return Rhaco::getVariable("_R_D_C_",null,"Counter::Total");
	}
	/**
	 * 
	 * @return integer
	 */
	function setTotal($value){
		$this->total = TableObjectUtil::cast($value,"integer");
	}
	/**
	 * 
	 */
	function getTotal(){
		return $this->total;
	}
	/**
	 * 
	 * @return database.model.Column
	 */
	function columnHost(){
		if(!Rhaco::isVariable("_R_D_C_","Counter::Host")){
			$column = new Column("column=host,variable=host,type=text,",__CLASS__);
			$column->label(Message::_("host"));
			Rhaco::addVariable("_R_D_C_",$column,"Counter::Host");
		}
		return Rhaco::getVariable("_R_D_C_",null,"Counter::Host");
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


}
?>