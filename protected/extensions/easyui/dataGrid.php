<?php 
Yii::import('ext.easyui.easyui');
class dataGrid extends easyui{
	public $id="tt";
	public $primary="id";
	public $deleteUrl="";
	public $getDataUrl="";
	public $datagrid="datagrid";
	public $crudInline=false;
	public $crudPopUp=false;
	public $toolbar="tolbar";
	public $columns=array();
	public $action=array();
	public $options=array();
	public $htmlOptions=array();
	public function init(){
		$this->_getToolbar();
		parent::init();
		$options['striped']=true;
		$options['url']="";
		$options['idField']="id";
		$options['showFooter']=false;
		$options['title']="Data Grid";
		$options['fitColumns']=true;
		$options['rownumbers']=true;
		$options['pagination']=true;
		$options['singleSelect']=true;
		$options['sortName']="id";
		$options['toolbar']=$this->toolbar;
		$options['sortOrder']="asc";
		$options['pageList']="js:[50,100,150,200,250]";
		foreach($this->options as $ky => $vl){
		$options[$ky] = $vl;
		}
		$options['toolbar']="#".$options['toolbar'];
		echo
		"<table id='".$this->id."' ".CHtml::renderAttributes($this->htmlOptions)."></table>";
		$options=array_merge(array('columns'=>$this->columns),$options);
		$this->options=CJavaScript::encode($options);
		$this->_getScript();
	}
	private function _getToolbar(){
		if(isset($this->options['toolbar']))
			$this->toolbar = $this->options['toolbar'];
		else
			$this->toolbar = $this->id."CrudToolbar";
		
		if($this->crudPopUp){
			if(in_array('save',$this->action) || in_array('delete',$this->action)){
			echo"
			<div id=".$this->toolbar."> ";
				if(in_array('save',$this->action)){
					echo"
					<a href=\"#\" class=\"easyui-linkbutton\" iconCls=\"icon-add\" plain=\"true\" onclick=\"add_".$this->toolbar."()\">Add</a>  
					<a href=\"#\" class=\"easyui-linkbutton\" iconCls=\"icon-edit\" plain=\"true\" onclick=\"edit_".$this->toolbar."()\">Edit</a>  
					";
				}
				if(in_array('delete',$this->action)){
					echo"
					<a href=\"#\" class=\"easyui-linkbutton\" iconCls=\"icon-remove\" plain=\"true\" onclick=\"delete_".$this->toolbar."()\">Remove</a> 
					";
				}
			echo"
			</div>";
			}
		}
		else if($this->crudInline)
		{
			if(in_array('save',$this->action) || in_array('delete',$this->action)){
			echo"
			<div id=".$this->toolbar."> ";
				if(in_array('save',$this->action)){	
					echo"
					<a href=\"#\" class=\"easyui-linkbutton\" iconCls=\"icon-add\" plain=\"true\" onclick=\"javascript:$('#".$this->id."').edatagrid('addRow');\">Add</a>  
					<a href=\"#\" class=\"easyui-linkbutton\" iconCls=\"icon-save\" plain=\"true\" onclick=\"javascript:$('#".$this->id."').edatagrid('saveRow');\">Save</a> 
					<a href=\"#\" class=\"easyui-linkbutton\" iconCls=\"icon-undo\" plain=\"true\" onclick=\"javascript:$('#".$this->id."').edatagrid('cancelRow');\">Cancel</a> 
					";
				}
				if(in_array('delete',$this->action)){
					echo"
					<a href=\"#\" class=\"easyui-linkbutton\" iconCls=\"icon-remove\" plain=\"true\" onclick=\"delete_".$this->toolbar."()\">Remove</a> 
				";
				}
			echo"
			</div>";
			}
		}
	}
	private function _getScript(){
		
		if($this->crudPopUp){
			$this->cs->registerScript($this->id."_toolbar",
			"
			function delete_".$this->toolbar."(){
				var row = $('#".$this->id."').datagrid('getSelected');
				if(row!=null){
					$.messager.confirm(
					'Delete Confirmation',
					'Are you sure want to delete this ?',
					function(r){
						if(r==true){
							".
							CHtml::ajax(array(
								'url'=>$this->deleteUrl,
								'success'=>'js:function(data){
									if(data.return != undefined && data.return == "success")
									{
										$("#'.$this->id.'").datagrid("reload");
									}
								}',
								'dataType'=>'json',
								'data'=>'js:{'.$this->primary.':row.'.$this->primary.',ajaxDelete:true}',
								'type'=>'post'
							))
							."
						}
					}
					);
				}
			}
			function add_".$this->toolbar."(){
				$('#".$this->id."Add').window('open');
			}
			function edit_".$this->toolbar."(){
				var row = $('#".$this->id."').datagrid('getSelected');
				if(row!=null){
				".
				CHtml::ajax(array(
					'url'=>$this->getDataUrl,
					'success'=>"js:function(data){
						$('#".$this->id."Add').window('open');
						$(\"#".$this->id."Form\").form(\"load\",data);
					}",
					'dataType'=>'json',
					'data'=>'js:{'.$this->primary.':row.'.$this->primary.',getData:true}',
					'type'=>'post'
				))
				."
				}
			}
			"
			,CClientScript::POS_BEGIN);
		}
		else if($this->crudInline){
			$this->datagrid="edatagrid";
			$this->cs->registerScriptFile($this->assets . '/plugins/jquery.edatagrid.js');
			$this->cs->registerScript($this->id."_toolbar",
			"function delete_".$this->toolbar."(){
				if(confirm('Are you sure want to delete this ?')){
				}
			}"
			,CClientScript::POS_BEGIN);
		}
		$this->cs->registerScript($this->id,
			"$('#".$this->id."').".$this->datagrid."(".$this->options.")"
		);
	}
}
?>