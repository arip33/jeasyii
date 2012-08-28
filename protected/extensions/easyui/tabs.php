<?php
Yii::import('ext.easyui.easyui');
class tabs extends easyui{
	public $id="tab";
	public $htmlOptions=array();
	public $options=array();
	public function init(){
		parent::init();
		echo "<div id='".$this->id."' ".CHtml::renderAttributes($this->htmlOptions).">";
		$this->options=CJavaScript::encode($this->options);
	}
	public function run(){
		echo"</div>";
		$this->cs->registerScript($this->id,"
		function addTab{$this->id}(title, url){
			if ($('#{$this->id}').tabs('exists', title)){
				$('#{$this->id}').tabs('select', title);
			} else {
				$('#{$this->id}').tabs('add',{
					title:title,
					href:url,
					closable:true
					
				});
			}
		}
		",CClientScript::POS_BEGIN);
		$this->cs->registerScript($this->id,
			"$('#".$this->id."').tabs(".$this->options.")"
		);
	}
}
?>