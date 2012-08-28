<?php
Yii::import('ext.easyui.input');
class numberbox extends input{
	public $value=null;
	public $type='number';
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
			echo CHtml::activeTextField($this->model,$this->attribute,$this->htmlOptions);
		else
			echo CHtml::textField($name,$this->value,$this->htmlOptions);
		
		$typenumber = array(
			'number'=>array(),
			'idrnocoma'=>array('prefix'=>"Rp ", 'groupSeparator'=>".", 'decimalSeparator'=>", "),
			'idr'=>array('prefix'=>"Rp ", 'groupSeparator'=>".", 'decimalSeparator'=>", ", 'precision'=>2),
			'persen'=>array('suffix'=>" %", 'decimalSeparator'=>",", 'precision'=>2),
			);
		
		$this->options = array_merge($typenumber[$this->type], $this->options);
		$options=CJavaScript::encode($this->options);			

		$js = "$('#{$id}').numberbox($options);";
		
		if($this->value == null)
			$js .= "$('#{$id}').numberbox('setValue','');";
		
		$this->cs->registerScript(__CLASS__.'#'.$id, $js);
		
	}
}
?>