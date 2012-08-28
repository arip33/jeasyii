<?php

class MenuController extends MController
{
	public $layout='column';
	public function actionSave()
	{
		if(isset($_POST['Menu']['id']) and !empty($_POST['Menu']['id']))
			$model=$this->loadModel($_POST['Menu']['id']);
		else
			$model=new Menu;

		$this->performAjaxValidation($model);
		if(isset($_POST['Menu']))
		{
			$model->attributes=$_POST['Menu'];
			if($model->save())
				echo json_encode(array("return"=>"success"));
		}
	}

	public function actionDelete()
	{
		if(Yii::app()->request->isPostRequest)
		{
			if($this->loadModel($_POST['id'])->delete())
				echo json_encode(array("return"=>"success"));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	public function actionIndex()
	{
		$model=new Menu;
		if(isset($_POST['page'])){
			$model->getDataGrid();
			return;
		}
		$data['model']=$model;
		$this->render('index',$data);
	}

	public function actionGetData(){
		if(Yii::app()->request->isPostRequest)
		{
			if($respon=$this->loadModel($_POST['id']))
			{
				$r='';
				foreach($respon->attributes as $key=>$val){
					$r["Menu[$key]"]=$val;
				}
				echo json_encode($r);
			}
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	public function loadModel($Menu)
	{
		$model=Menu::model()->findByPk($Menu);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='menuForm')
		{
			$validate = CActiveForm::validate($model);
			if($validate <>'[]')
			{
				echo $validate ;
				Yii::app()->end();
			}
		}
	}
}
