<?php
class MDataProvider {
	private $sql="";
	private $footer=array(); // footer
	private $respon=array();
	private $rows;
	private $count;
	public function __construct($sql='', $footer=""){
		$this->footer=$footer;
		$this->sql=$sql;
		$this->_setData();
		$this->_getData();
		echo json_encode($this->respon);
		/*
		 * remove current memory proccess
		 */
		unset($this->sql,$this->footer,$this->respon,$this->rows,$this->count,$sql,$footer);
	}
	private function _getData(){
		if(isset($_POST['page']) and $this->sql!==""){
			$this->respon['rows']=$this->rows;
			$this->respon['total']=$this->count;
		}
	}
	private function _setData(){
		$db=Yii::app()->db;
		/*
		 * parameter of query
		 */
		$order=" order by ".$_POST['sort']." ".$_POST['order'];
		$start = ($_POST['page']-1)*$_POST['rows'];
		$limit = $start+$_POST['rows'];
		/*
		 * set query
		 */
		$this->sql=$this->sql." ".$order;
		/*
		 * get result of query by each driver
		 */
		$rows = array(
			'mysql'=>$db->createCommand($this->sql." limit $start, $limit"),
			'oci'=>$db->createCommand("select * from (select  a.*,  rownum  rnum from (".$this->sql.")a  where  rownum  <=  $limit) where  rnum >  $start")
		);
		$count = array(
			'mysql'=>$db->createCommand("select count(*) as total from (".$this->sql.") a"),
			'oci'=>$db->createCommand("select count(*) as total from (".$this->sql.") a")
		);
		/*
		 * set rows and count/total
		 */
		$this->rows = $rows[$db->driverName]->queryAll();
		$this->count = $count[$db->driverName]->queryScalar();
		/*
		 * set footer
		 */
		if($this->footer!==""){
			$this->respon['footer']=$db->createCommand($this->footer)->queryAll();
		}
		/*
		 * remove current memory proccess
		 */
		unset($rows, $count, $order, $db, $start, $limit);
	}
}