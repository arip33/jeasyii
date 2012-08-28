<?php $this->beginWidget('ext.easyui.window',
	array(
		'closed'=>"true",
		'onClose'=>'js:function(){$("#menuForm").form("clear"); $("#menuForm").reset();}',
		'id'=>"menuAdd",
		'title'=>"Form Menus",
		'style'=>"width:500px; height:auto;"
		)
	);
 ?> 
	<div class="form">
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'menuForm',
			'enableAjaxValidation'=>TRUE,
			'clientOptions'=>array(
			'afterValidate'=>
				'js:function(form, data, hasError){
					if(data.return != undefined && data.return=="success"){
						$.messager.alert(\'Info\',\'Insert success !\',\'info\');
						$("#menuForm").form("clear");
						$("#menuAdd").window("close");
						$("#menu").datagrid("reload");
					}
					return false;
				}',
			'validateOnSubmit'=>true,
			'validateOnChange'=>false
			),
			'action'=>array('menu/save')
		)); ?> 

		<p class="note">Fields with <span class="required">*</span> are required.</p>

		<?php echo $form->errorSummary($model); ?>
		<?php echo $form->hiddenField($model,'id'); ?>

		<div class="row">
			<?php echo $form->labelEx($model,'label'); ?>
			<?php echo $form->textField($model,'label',array('size'=>60,'maxlength'=>128)); ?>
			<?php echo $form->error($model,'label'); ?>
		</div>

			<div class="row">
			<?php echo $form->labelEx($model,'url'); ?>
			<?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>128)); ?>
			<?php echo $form->error($model,'url'); ?>
		</div>

			<div class="row">
			<?php echo $form->labelEx($model,'visible'); ?>
			<?php echo $form->textField($model,'visible',array('size'=>60,'maxlength'=>128)); ?>
			<?php echo $form->error($model,'visible'); ?>
		</div>

			<div class="row">
			<?php echo $form->labelEx($model,'parent_id'); ?>
			<?php echo $form->textField($model,'parent_id'); ?>
			<?php echo $form->error($model,'parent_id'); ?>
		</div>

			<div class="row">
			<?php echo $form->labelEx($model,'template'); ?>
			<?php echo $form->textField($model,'template',array('size'=>60,'maxlength'=>128)); ?>
			<?php echo $form->error($model,'template'); ?>
		</div>

			<div class="row">
			<?php echo $form->labelEx($model,'linkOptions'); ?>
			<?php echo $form->textField($model,'linkOptions',array('size'=>60,'maxlength'=>128)); ?>
			<?php echo $form->error($model,'linkOptions'); ?>
		</div>

			<div class="row">
			<?php echo $form->labelEx($model,'ItemOptions'); ?>
			<?php echo $form->textField($model,'ItemOptions',array('size'=>60,'maxlength'=>128)); ?>
			<?php echo $form->error($model,'ItemOptions'); ?>
		</div>

			<div class="row">
			<?php echo $form->labelEx($model,'submenuOptions'); ?>
			<?php echo $form->textField($model,'submenuOptions',array('size'=>60,'maxlength'=>128)); ?>
			<?php echo $form->error($model,'submenuOptions'); ?>
		</div>

			<div class="row buttons">
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
		</div>

	<?php $this->endWidget(); ?>

	</div><!-- form -->
<?php $this->endWidget(); ?>
