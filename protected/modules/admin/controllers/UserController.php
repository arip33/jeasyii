<?php

class UserController extends MController
{
	public function actionCreate()
	{
		if(isset($_POST['User']['id']) and !empty($_POST['User']['id']))
			$model=$this->loadModel($_POST['User']['id']);
		else
			$model=new User;

		$this->performAjaxValidation($model);
		if(isset($_POST['User']))
		{
			$model->username=$_POST['User']['username'];
			$model->password=sha1($_POST['User']['password']).md5($_POST['User']['password']);
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
	public function actionGetData(){
		if(Yii::app()->request->isPostRequest)
		{
			if($respon=$this->loadModel($_POST['id']))
			{
				$r='';
				foreach($respon->attributes as $key=>$val){
					if($key=="password") continue;
					$r["User[$key]"]=$val;
				}
				echo json_encode($r);
			}
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
	public function actionIndex()
	{
		$model=new User;
		if(isset($_POST['page'])){
			$model->getDataGrid();
			return;
		}
		$data['model']=$model;
		$this->render('index',$data);
	}
	public function loadModel($id)
	{
		$model=User::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='userForm')
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
