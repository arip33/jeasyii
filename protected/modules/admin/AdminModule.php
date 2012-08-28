<?php

class AdminModule extends CWebModule
{
	public function init()
	{
		parent::init();
		
		$this->defaultController="index";
		
		$this->setImport(array(
			'admin.models.*',
			'admin.components.*',
		));
		
		$this->layout = 'main';
		
		Yii::app()->setComponents(array(
			'errorHandler'=>array(
				'class'=>'CErrorHandler',
				'errorAction'=>$this->getId().'/index/error',
			),
			'user'=>array(
				'class'=>'CWebUser',
				'loginUrl'=>Yii::app()->createUrl($this->getId().'/login'),
			),
		), false);
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
}
