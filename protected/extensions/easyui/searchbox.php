<?php
Yii::import('ext.easyui.input');
class searchbox extends input{
	public $value=null;
	public $menu=array();
	public $widthMenu="150px";
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
		
		$this->options = array_merge(array('menu'=>'#menu'.$id), $this->options);
		$options=CJavaScript::encode($this->options);			
		echo "<div id='menu".$id."' style=\"width:".$this->widthMenu."\">";
		foreach($this->menu as $keys=>$value){
			$att=array();
			$content="";
			if (isset($value['content']))
				$content = $value['content'];
				
			if(is_array($value))
			{	foreach($value as $key=>$val) {
					if ($key=='content') continue;
					$att[] = "{$key} = '{$val}'";
					}
			}
			
			$att = implode($att, ' ');
			echo "<div {$att}>{$content}</div>";
		}
		echo "</div>";
		$js = "$('#{$id}').searchbox($options);";
		
		if($this->value == null)
			$js .= "$('#{$id}').searchbox('setValue','');";
		
		$this->cs->registerScript(__CLASS__.'#'.$id, $js);
		
	}
}
?>