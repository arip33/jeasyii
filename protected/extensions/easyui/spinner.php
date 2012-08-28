<?php
Yii::import('ext.easyui.input');
class spinner extends input{
	public $type="numberspinner";
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
			echo CHtml::activeTextField($this->model,$this->attribute,$this->htmlOptions);
		else
			echo CHtml::textField($name,$this->value,$this->htmlOptions);
		
		$options=CJavaScript::encode($this->options);			

		$js = "$('#{$id}').{$this->type}($options);";
		
		if($this->value == null)
			$js .= "$('#{$id}').{$this->type}('setValue','');";
		
		$this->cs->registerScript(__CLASS__.'#'.$id, $js);
		
	}
}
?>