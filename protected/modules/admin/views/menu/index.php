<?php
$this->breadcrumbs=array(
	'Menus',
);


$this->createWidget('ext.easyui.dataGrid', 
	array(
		'id'=>'menu',
		'primary'=>'id',
		'crudPopUp'=>true,
		'deleteUrl'=>array('menu/delete'),
		'getDataUrl'=>array('menu/getData'),
		'action'=>$this->actions,
		'options'=>array(
			'title'=>"Grid Menus",
			'nowrap'=> false,
			'striped'=> true,
			'fit'=> true,
			'url'=>CHtml::normalizeUrl(array('menu/index')),
		),
		'columns'=>array(array(
				 array('field'=>'label','title'=>'Labels','width'=>80),
				 array('field'=>'url','title'=>'Urls','width'=>80),
				 array('field'=>'visible','title'=>'Visibles','width'=>80),
				 array('field'=>'parent_id','title'=>'Parent Ids','width'=>80),
				 array('field'=>'template','title'=>'Templates','width'=>80),
		/*
				 array('field'=>'linkOptions','title'=>'Link Options','width'=>80),
				 array('field'=>'ItemOptions','title'=>'Item Options','width'=>80),
				 array('field'=>'submenuOptions','title'=>'Submenu Options','width'=>80),
		*/
	
			))
		)
);

 echo $this->renderPartial('_form', array('model'=>$model));
?>