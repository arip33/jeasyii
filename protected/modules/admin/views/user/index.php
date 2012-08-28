<?php
$this->breadcrumbs=array(
	'Users',
);
$this->createWidget('ext.easyui.dataGrid', 
	array(
		'id'=>'user',
		'url'=>Yii::app()->createUrl('admin/user/index'),
		'crudPopUp'=>true,
		'showFooter'=>"true",
		'deleteUrl'=>array('user/delete'),
		'getDataUrl'=>array('user/getData'),
		'action'=>$this->actions,
		'options'=>array(
			'saveUrl'=>'as',
			'updateUrl'=>'asd'
			),
		'columns'=>array(array(
			array('field'=>'username','title'=>'User Name','width'=>80,'editor'=>'text'),
			))
		)
);

echo $this->renderPartial('_form', array('model'=>$model));
?>
