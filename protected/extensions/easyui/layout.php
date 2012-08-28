<?php
Yii::import('ext.easyui.easyui');
class layout extends easyui{
	public $options=array();
	public $element="body";
	public function init(){
		parent::init();

		$options=CJavaScript::encode($this->options);			

		$js = "$('{$this->element}').layout($options);";
		
		$this->cs->registerScript(__CLASS__.'#'.$this->element, $js);
	}
}
?>