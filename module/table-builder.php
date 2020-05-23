<?php


class Table{
	public $table=array();

	public function __construct(){
		$this->table['id']=self::pk();

	}//end

	public function pk(){

	$constraint=' int primary key auto_increment';

	return $constraint;
}//end


public function char($fieldname,$size){

	$this->table[$fieldname]=" varchar({$size})";
}//end


}

#print_r($table);

function table($tableobj,$fieldname,$methodname,$size){
	$params=array($fieldname,$size);
	call_user_func_array(array($tableobj, $methodname), $params);
}




?>