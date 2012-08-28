<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php 
$label=$this->pluralize($this->class2name($this->modelClass));
echo"<?php \$this->beginWidget('ext.easyui.window',
	array(
		'closed'=>\"true\",
		'onClose'=>'js:function(){\$(\"#".$this->class2id($this->modelClass)."Form\").form(\"clear\"); \$(\"#".$this->class2id($this->modelClass)."Form\").reset();}',
		'id'=>\"".$this->class2id($this->modelClass)."Add\",
		'title'=>\"Form ".$label."\",
		'style'=>\"width:auto;height:auto;\"
		)
	);\n ?> \n";
?>
	<div class="form">
	<?php echo"	<?php \$form=\$this->beginWidget('CActiveForm', array(
			'id'=>'".$this->class2id($this->modelClass)."Form',
			'enableAjaxValidation'=>TRUE,
			'clientOptions'=>array(
			'afterValidate'=>
				'js:function(form, data, hasError){
					if(data.return != undefined && data.return==\"success\"){
						\$.messager.alert(\'Info\',\'Insert success !\',\'info\');
						$(\"#".$this->class2id($this->modelClass)."Form\").form(\"clear\");
						$(\"#".$this->class2id($this->modelClass)."Add\").window(\"close\");
						$(\"#".$this->class2id($this->modelClass)."\").datagrid(\"reload\");
					}
					return false;
				}',
			'validateOnSubmit'=>true,
			'validateOnChange'=>false
			),
			'action'=>array('".$this->class2id($this->modelClass)."/save')
		)); ?> \n"; 
	?>

		<p class="note">Fields with <span class="required">*</span> are required.</p>

		<?php echo "<?php echo \$form->errorSummary(\$model); ?>\n"; ?>
		<?php echo "<?php echo \$form->hiddenField(\$model,'".$this->primaryKey."'); ?>\n"; ?>

	<?php
	foreach($this->tableSchema->columns as $column)
	{
		if($column->autoIncrement)
			continue;
	?>
		<div class="row">
			<?php echo "<?php echo ".$this->generateActiveLabel($this->modelClass,$column)."; ?>\n"; ?>
			<?php echo "<?php echo ".$this->generateActiveField($this->modelClass,$column)."; ?>\n"; ?>
			<?php echo "<?php echo \$form->error(\$model,'{$column->name}'); ?>\n"; ?>
		</div>

	<?php
	}
	?>
		<div class="row buttons">
			<?php echo "<?php echo CHtml::submitButton(\$model->isNewRecord ? 'Create' : 'Save'); ?>\n"; ?>
		</div>

	<?php echo "<?php \$this->endWidget(); ?>\n"; ?>

	</div><!-- form -->
<?php echo "<?php \$this->endWidget(); ?>\n";
?>