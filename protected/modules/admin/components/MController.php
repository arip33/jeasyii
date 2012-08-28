<?php
class MController extends CController
{
	public $layout='column';
	public $menu=array();
	public $button=array();
	public $breadcrumbs=array();
	public $actions=array();
	private $_access=array();
	public function init(){
		$model = new Menu;
		$this->menu=$model->getMenu(6);
		// echo "<pre>";
		// print_r($model->getAccess($this->uniqueId));
		// echo "</pre>";
		$this->actions=$model->getAccess($this->uniqueId);
		$this->_access=
		array(
			array('allow',
				'actions'=>$this->actions,
				'users'=>array('@'),
			),
			array('deny',
				'users'=>array('*'),
			),
		);
	}
	public function filters()
	{
		return array(
			'accessControl',
		);
	}
	public function accessRules()
	{
		return $this->_access;
	}
}