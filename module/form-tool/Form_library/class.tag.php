<?php

class Tag{

	public $define_tag = array(
		'select' => '</select>',
		'textarea' => '</textarea>',
		#for the empty tags
		'input' => '/>',
	);

	public $formtag;

	public function __construct($formparams){		

		self::tagbuilder($formparams);

	}

	public function tagbuilder($formparams){
		$attribs = "";
		foreach($formparams as $key => $value){
			$attribs.=' '.$key.'="'.$value.'"';
		}//endforeach
		$this->formtag=$attribs;

	}//end of tagbuilder




} //end of tagbuilder


?>