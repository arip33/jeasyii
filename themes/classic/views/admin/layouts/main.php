<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<body>
<?php 
// print_r($this->menu);
$cs=Yii::app()->clientScript;
$cs->registerCoreScript('yiiactiveform');
$this->createWidget('ext.easyui.layout');?>
	<div region="north" title="North Title" split="true" style="height:100px;padding:10px;">
		<p>The north content.</p>
	</div>
	<div region="south" title="South Title" split="true" style="height:100px;padding:10px;background:#efefef;">

	</div>
	<div region="west" iconCls="icon-reload" title="Tree Menu" split="true" style="width:180px;">
		<?php $this->widget('ext.ECMenu',array(
			'items'=>$this->menu,
			'htmlOptions'=>array('class'=>'easyui-tree', 'animate'=>'true'),
		)); ?>
	</div>
	<div region="east" split="true" title="West Menu" style="width:280px;padding1:1px;overflow:hidden;">
		<div class="easyui-accordion" fit="true" border="false">
			<div title="Title1" style="padding:10px;overflow:auto;">
				<p>content1</p>
				<p>content1</p>
				<p>content1</p>
				<p>content1</p>
				<p>content1</p>
				<p>content1</p>
				<p>content1</p>
				<p>content12</p>
			</div>
			<div title="Title2" selected="true" style="padding:10px;">
				content2
			</div>
			<div title="Title3" style="padding:10px">
				content3
			</div>
		</div>
	</div>
	<div region="center" title="Main Title" style="overflow:hidden;">
		<?php $this->beginWidget('ext.easyui.tabs',array('id'=>'tab_layout', 'options'=>array('fit'=>true), 'htmlOptions'=>array('border'=>"false")));?>
			<div title="Tab1"> 
					<?php echo $content; ?>
			</div>
		<?php $this->endWidget();?>
	</div>

</body>
</html>