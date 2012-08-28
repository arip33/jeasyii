<h1><?php echo $this->uniqueId . '/' . $this->action->id; ?></h1>

<p>
This is the view content for action "<?php echo $this->action->id; ?>".
The action belongs to the controller "<?php echo get_class($this); ?>"
in the "<?php echo $this->module->id; ?>" module.
</p>
<p>You may change the content of this page by modifying the following two files:</p>
<ul>
	<li>View file: <tt><?php echo __FILE__; ?></tt></li>
	<li>Layout file: <tt><?php echo $this->getLayoutFile('main'); ?></tt></li>
</ul>
<?php 


$this->createWidget('ext.easyui.spinner',array('name'=>'numberspiner', 'type'=>'timespinner'));
$this->createWidget('ext.easyui.dataGrid', 
	array(
		'id'=>'inline',
		
		'crudInline'=>true,
		
		'options'=>array(
			'saveUrl'=>'as',
			'updateUrl'=>'asd',
			'url'=>Yii::app()->createUrl('admin/index/index'),
			'showFooter'=>true,
			'fit'=>true
			),
		'columns'=>array(array(
			array('field'=>'username','title'=>'User Name','width'=>80,'editor'=>'text'),
			))
		)
);
$this->createWidget('ext.easyui.dataGrid', 
	array(
		'id'=>'popup',
		
		'crudPopUp'=>true,
		
		'options'=>array(
			'saveUrl'=>'as',
			'updateUrl'=>'asd',
			'url'=>Yii::app()->createUrl('admin/index/index'),
			'showFooter'=>true,
			'fit'=>true
			),
		'columns'=>array(array(
			array('field'=>'username','title'=>'User Name','width'=>80,'editor'=>'text'),
			))
		)
);
$this->beginWidget('ext.easyui.window',
	array(
		'closed'=>"true",
		'id'=>"popupAdd",
		'title'=>"Add "
		)
	);
$this->endWidget();
?>