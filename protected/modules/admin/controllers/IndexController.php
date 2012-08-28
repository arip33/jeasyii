<?php

class IndexController extends MController
{
	public $layout='column1';
	public function accessRules()
	{
		return array(
			array('allow',
				'actions'=>array('error','index'),
				'users'=>array('@'),
			),
			array('deny',
				'users'=>array('*'),
			),
		);
	}
	public function actionIndex()
	{
		if(isset($_POST['page'])){
			new MDataProvider(
			"select * from sys_user",
			"select count(*) as username from sys_user"
			);
			return;
		}
		$this->render('index');
	}
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}
}