<?php
/**
 * This is the template for generating a controller class file for CRUD feature.
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php echo "<?php\n"; ?>

class <?php echo $this->controllerClass; ?> extends <?php echo $this->baseControllerClass."\n"; ?>
{

	public function actionSave()
	{
		if(isset($_POST['<?php echo $this->modelClass; ?>']['<?php echo $this->primaryKey; ?>']) and !empty($_POST['<?php echo $this->modelClass; ?>']['<?php echo $this->primaryKey; ?>']))
			$model=$this->loadModel($_POST['<?php echo $this->modelClass; ?>']['id']);
		else
			$model=new <?php echo $this->modelClass; ?>;

		$this->performAjaxValidation($model);
		if(isset($_POST['<?php echo $this->modelClass; ?>']))
		{
			$model->attributes=$_POST['<?php echo $this->modelClass; ?>'];
			if($model->save())
				echo json_encode(array("return"=>"success"));
		}
	}

	public function actionDelete()
	{
		if(Yii::app()->request->isPostRequest)
		{
			if($this->loadModel($_POST['<?php echo $this->primaryKey; ?>'])->delete())
				echo json_encode(array("return"=>"success"));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	public function actionIndex()
	{
		$model=new <?php echo $this->modelClass; ?>;
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
			if($respon=$this->loadModel($_POST['<?php echo $this->primaryKey; ?>']))
			{
				$r='';
				foreach($respon->attributes as $key=>$val){
					$r["<?php echo $this->modelClass; ?>[$key]"]=$val;
				}
				echo json_encode($r);
			}
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	public function loadModel($<?php echo $this->modelClass; ?>)
	{
		$model=<?php echo $this->modelClass; ?>::model()->findByPk($<?php echo $this->modelClass; ?>);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='<?php echo $this->class2id($this->modelClass); ?>Form')
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
