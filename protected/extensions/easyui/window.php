<?php
Yii::import('ext.easyui.easyui');
class window extends easyui{
	public $id="window";
	public $closed="false";
	public $onClose="js:function(){}";
	public $modal="true";
	public $title="Title Window";
	public $style="width:auto;height:auto;";
	public $collapsible="true";
	public $minimizable="false";
	public $maximizable="true";
	public $resizable="true";
	public $options=array();
	public function init(){
		parent::init();
		echo 
		"<div 
		collapsible=\"{$this->collapsible}\"
		minimizable=\"{$this->minimizable}\"
		maximizable=\"{$this->maximizable}\"
		resizable=\"{$this->resizable}\"
		id=\"".$this->id."\" 
		closed=\"".$this->closed."\" 
		modal=\"".$this->modal."\" 
		title=\"".$this->title."\" 
		style=\"".$this->style."\">
		";
		$this->options=array_merge(array('onClose'=>$this->onClose),$this->options);
		$this->options=CJavaScript::encode($this->options);
	}
	public function run(){
		echo"</div>";
		$this->cs->registerScript($this->id,
			"$('#".$this->id."').window(".$this->options.")"
		);
	}
}
?>