<?php
Yii::import('zii.widgets.CMenu');
class ECMenu extends CMenu
{
	protected function renderMenuItem($item)
	{
		if(isset($item['url']))
		{
			$label=$this->linkLabelWrapper===null ? $item['label'] : '<'.$this->linkLabelWrapper.'>'.$item['label'].'</'.$this->linkLabelWrapper.'>';
			return CHtml::tag('span',array(),CHtml::link($label,$item['url'],isset($item['linkOptions']) ? $item['linkOptions'] : array()));
		}
		else
			return CHtml::tag('span',isset($item['linkOptions']) ? $item['linkOptions'] : array(), $item['label']);
	}
}