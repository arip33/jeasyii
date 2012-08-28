<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php
echo "<?php\n";
$label=$this->pluralize($this->class2name($this->modelClass));
echo "\$this->breadcrumbs=array(
	'$label',
);\n";
?>


$this->createWidget('ext.easyui.dataGrid', 
	array(
		'id'=>'<?php echo $this->class2id($this->modelClass); ?>',
		'url'=>CHtml::normalizeUrl(array('<?php echo $this->class2id($this->modelClass); ?>/index')),
		'primary'=>'<?php echo $this->primaryKey;?>',
		'crudPopUp'=>true,
		'showFooter'=>"false",
		'deleteUrl'=>array('<?php echo $this->class2id($this->modelClass); ?>/delete'),
		'getDataUrl'=>array('<?php echo $this->class2id($this->modelClass); ?>/getData'),
		'action'=>$this->actions,
		'title'=>"Grid <?php echo $label?>",
		'options'=>array(),
		'columns'=>array(array(
<?php $count=0;
foreach($this->tableSchema->columns as $column)
{
	if(++$count==7)
		echo "\t\t/*\n";
	
	if($column->autoIncrement)
		continue;
	
	echo "\t\t\t\t array('field'=>'".$column->name."','title'=>'".$this->pluralize($this->class2name($column->name))."','width'=>80),\n";
}
if($count>=7)
	echo "\t\t*/\n";
?>	
			))
		)
);

echo $this->renderPartial('_form', array('model'=>$model));
?>