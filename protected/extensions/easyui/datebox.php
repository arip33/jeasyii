<?php
Yii::import('ext.easyui.input');
class datebox extends input{
	public $value=null;
	public $indonesian=true;
	public $showTime=false;
	public function init(){
		parent::init();
		list($name,$id)=$this->resolveNameID();
		$type = "datebox";
		if($this->showTime)
			$type = "datetimebox";
		
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
			
		if(!isset($this->options['editable']))
			$this->options['editable']=false;

		$options=CJavaScript::encode($this->options);			

		$js = "$('#{$id}').".$type."($options);";
		
		if($this->value == null)
			$js .= "$('#{$id}').".$type."('setValue','');";
		
		$this->cs->registerScript(__CLASS__.'#'.$id, $js);
		
		if($this->indonesian)
		{
			$this->cs->registerScript($id."IndonesiaFormatter","
			$.fn.datebox.defaults.formatter = function(date){
				var y=date.getFullYear();
				var m=date.getMonth()+1;
				var d=date.getDate();
				return d+\"-\"+m+\"-\"+y;
			}
			$.fn.datebox.defaults.parser = function(s){
				if (!s) return new Date();
				var ss = s.split('-');
				var d = parseInt(ss[0],10);
				var m = parseInt(ss[1],10);
				var y = parseInt(ss[2],10);
				if (!isNaN(y) && !isNaN(m) && !isNaN(d)){
					return new Date(y,m-1,d);
				} else {
					return new Date();
				}
			}",CClientScript::POS_BEGIN);
		}
	}
}
?>