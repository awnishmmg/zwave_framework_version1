<?php

include 'class.tag.php';


class Form{

	public $tagobj=null;
	public $form=array(
	'close' => '</form>',
	);
	public function __construct($formparams){

		$this->tagobj = new Tag($formparams);
		$this->form['open']="<form{$this->tagobj->formtag}>";
	}

	public function tag(string $tag,array $options){
		
		#to set the label tag
		$label=isset($options['label'])?"\n".'<label>'.$options['label']."</label>\n":"";
		unset($options['label']);

		#to render the code inside the innerTag
		$innercode=isset($options['innercode'])?">".$options['innercode']:"";
		if($tag=="option"){
			foreach ($options as $key => $value) {
				$innercode.='<option value='.'"'.$key.''.'">'.$value.'</option>';
			}
			return $innercode;
		}

		unset($options['innercode']);
		$this->tagobj->tagbuilder($options);
		$unique_param=rand(111111,999999);
	
		#random key is array so that every time random number is generated;
		$this->form['formtag'][$tag.$unique_param]="\n <p>{$label}<{$tag}{$this->tagobj->formtag}{$innercode}".$this->tagobj->define_tag[$tag]."</p>\n";

	}//input


	public function checkbox($options){

		$tag="input";
		$options['type']=__FUNCTION__;

			#to set the label tag
		$label=isset($options['label'])?"\n".'<label>'.$options['label']."</label>\n":"";
		unset($options['label']);

			$suffix_arr=$options['suffix'];
			unset($options['suffix']);

			$suffix="";	
			if(is_array($suffix_arr)){
					foreach ($suffix_arr as $attribvalue => $suffix){

								$this->tagobj->tagbuilder($options);
						$unique_param=rand(111111,999999);
	
		$this->form['formtag'][$tag.'check_label']="\n <p>{$label}</p>\n";	

				$this->form['formtag'][$tag.$unique_param]="<{$tag}{$this->tagobj->formtag} value=\"{$attribvalue}\" ".$this->tagobj->define_tag[$tag]."{$suffix}\n";	

					}
			}
						
}//end function


#function for the radio

public function radio($options){

		$tag="input";
		$options['type']=__FUNCTION__;

			#to set the label tag
		$label=isset($options['label'])?"\n".'<label>'.$options['label']."</label>\n":"";
		unset($options['label']);

			$suffix_arr=$options['suffix'];
			unset($options['suffix']);

			$suffix="";	
			if(is_array($suffix_arr)){
					foreach ($suffix_arr as $attribvalue => $suffix){

								$this->tagobj->tagbuilder($options);
						$unique_param=rand(111111,999999);
	
		$this->form['formtag'][$tag.'radio_label']="\n <p>{$label}</p>\n";	

				$this->form['formtag'][$tag.$unique_param]="<{$tag}{$this->tagobj->formtag} value=\"{$attribvalue}\" ".$this->tagobj->define_tag[$tag]."{$suffix}\n";	

					}
			}
						
}//end function

	public function embed($code){
		$unique_param=rand(111111,999999);
		$this->form['formtag']['embeded_code'.$unique_param]=$code;

	
	}

	public function render_form(){

		echo $this->form['open'];

		#formbody
		if(array_key_exists('formtag',$this->form)){
			foreach ($this->form['formtag'] as $tag => $tagvalue) {
				echo $tagvalue;
			}
		}
		else{
			echo 'no form-controls found  pass tag array in loadform() ';	
		}

		echo $this->form['close'];

	}//end __form__

}




?>