<?php 
$this->beginWidget('ext.easyui.window',
	array(
		'closed'=>"true",
		'onClose'=>'js:function(){$("#userForm").form("clear"); $("#userForm").reset();}',
		'id'=>"userAdd",
		'title'=>"Add ",
		'style'=>"width:450px;height:220px;"
		)
	);
?>
	<div class="form">

	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'userForm',
		'enableAjaxValidation'=>TRUE,
		'clientOptions'=>array(
		'afterValidate'=>
			'js:function(form, data, hasError){
				if(data.return != undefined && data.return=="success"){
					$.messager.alert(\'Info\',\'Insert success !\',\'info\');
					$("#userForm").form("clear");
					$("#userAdd").window("close");
					$("#user").datagrid("reload");
				}
				return false;
			}',
		'validateOnSubmit'=>true,
		'validateOnChange'=>false
		),
		'action'=>array('user/create')
	)); ?>

		<p class="note">Fields with <span class="required">*</span> are required.</p>

		<?php echo $form->errorSummary($model); ?>
		<?php echo $form->hiddenField($model,'id'); ?>

		<div class="row">
			<?php echo $form->labelEx($model,'username'); ?>
			<?php echo $form->textField($model,'username',array('size'=>60,'maxlength'=>64)); ?>
			<?php echo $form->error($model,'username'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($model,'password'); ?>
			<?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>128)); ?>
			<?php echo $form->error($model,'password'); ?>
		</div>

		<div class="row buttons">
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
		</div>

	<?php $this->endWidget(); ?>

	</div><!-- form -->
<?php
$this->endWidget();
?>