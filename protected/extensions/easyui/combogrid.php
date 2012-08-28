<?php
Yii::import('ext.easyui.input');
class combogrid extends input{
	public $url=array();
	public $data=array();
	public $columns=array();
	public $value=null;
	public function init(){
		parent::init();
		list($name,$id)=$this->resolveNameID();

		if(isset($this->htmlOptions['id']))
			$id=$this->htmlOptions['id'];
		else
			$this->htmlOptions['id']=$id;

		if(isset($this->htmlOptions['name']))
			$name=$this->htmlOptions['name'];
		
		if($this->hasModel())
			echo CHtml::activeDropDownList($this->model,$this->attribute,$this->data,$this->htmlOptions);
		else
			echo CHtml::dropDownList($name,$this->value,$this->data,$this->htmlOptions);

		if($this->url!==null)
			$this->options['url']=CHtml::normalizeUrl($this->url);

		$options=CJavaScript::encode($this->options);			

		$js = "$('#{$id}').combogrid($options);";
		
		if($this->value == null)
			$js .= "$('#{$id}').combogrid('setValue','');";
		
		$this->cs->registerScript(__CLASS__.'#'.$id, $js);
	}
}
?>