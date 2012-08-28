<?php

/**
 * This is the model class for table "sys_menu".
 *
 * The followings are the available columns in table 'sys_menu':
 * @property integer $id
 * @property string $label
 * @property string $url
 * @property string $visible
 * @property integer $parent_id
 * @property string $template
 * @property string $linkOptions
 * @property string $ItemOptions
 * @property string $submenuOptions
 *
 * The followings are the available model relations:
 * @property Action[] $actions
 * @property Menu $parent
 * @property Menu[] $menus
 * @property MenuUserAssignment[] $menuUserAssignments
 */
class Menu extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Menu the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sys_menu';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('label, url, visible', 'required'),
			array('parent_id', 'numerical', 'integerOnly'=>true),
			array('label, url, visible, template, linkOptions, ItemOptions, submenuOptions', 'length', 'max'=>128),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, label, url, visible, parent_id, template, linkOptions, ItemOptions, submenuOptions', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'actions' => array(self::HAS_MANY, 'Action', 'menu_id'),
			'parent' => array(self::BELONGS_TO, 'Menu', 'parent_id'),
			'menus' => array(self::HAS_MANY, 'Menu', 'parent_id'),
			'menuUserAssignments' => array(self::HAS_MANY, 'MenuUserAssignment', 'menu_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'label' => 'Label',
			'url' => 'Url',
			'visible' => 'Visible',
			'parent_id' => 'Parent',
			'template' => 'Template',
			'linkOptions' => 'Link Options',
			'ItemOptions' => 'Item Options',
			'submenuOptions' => 'Submenu Options',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('label',$this->label,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('visible',$this->visible,true);
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('template',$this->template,true);
		$criteria->compare('linkOptions',$this->linkOptions,true);
		$criteria->compare('ItemOptions',$this->ItemOptions,true);
		$criteria->compare('submenuOptions',$this->submenuOptions,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	/**
	 * Retrives a list of models for jeasyui datagrid
	 */
	public function getDataGrid(){
		return new MDataProvider(
			"select * from sys_menu"
			);
	}
	public function getMenu($parentid=0,$admin=true){
		$return=array();
		$items='';
		$db=Yii::app()->db;
		$user=Yii::app()->user->name;
		if($admin)
		{
		$sql = "SELECT c.*
		FROM sys_user a
		RIGHT JOIN sys_menu_user_assignment b ON a.id=b.user_id
		LEFT JOIN sys_menu c ON b.menu_id=c.id where c.parent_id=$parentid and a.username = '$user'";
		}
		else
		{
		$sql = "SELECT * from
		sys_menu
		WHERE parent_id=$parentid";
		}
		$command=$db->createCommand($sql);
		$i=0;
		foreach($command->queryAll() as $row){
			$return[$i]['label']=(empty($row['label']))?null:$row['label'];
			$return[$i]['visible']=(empty($row['visible']))?null:$row['visible'];
			$return[$i]['template']=(empty($row['template']))?null:$row['template'];
			$return[$i]['linkOptions']=(empty($row['linkOptions']))?null:$row['linkOptions'];
			$return[$i]['itemOptions']=(empty($row['ItemOptions']))?null:$row['ItemOptions'];
			$return[$i]['submenuHtmlOptions']=(empty($row['submenuOptions']))?null:$row['submenuOptions'];
			$items=$this->getMenu($row['id']);
			if($admin)
			{
				$url = Yii::app()->createUrl($row['url']);
				if(strtolower($row['label'])=='logout')
				{
				$return[$i]['url']=$url;
				}
				else
				{
				$return[$i]['url']="#";
				$return[$i]['linkOptions']=array(
					'onclick'=>"addTabtab_layout('$row[label]','$url');"
					);
				if($items!=array())
				{
				$return[$i]['itemOptions']=array(
					'state'=>"closed"
					);
				}
				}
			}
			else
			{
				$return[$i]['url']=array('/'.$row['url']);
			}
			unset($return[$i]['id']);
			unset($return[$i]['parent_id']);
			if($items!=array())
			{
				$return[$i]['items']=$items;
			}
			$i++;
		}
		return $return;
	}
	public function getAccess($url=''){
		$return=array('');
		$db=Yii::app()->db;
		$user=Yii::app()->user->name;
		$command=$db->createCommand("SELECT e.name
		FROM sys_user a
		RIGHT JOIN sys_menu_user_assignment b ON a.id=b.user_id
		LEFT JOIN sys_menu c ON b.menu_id=c.id
		right join sys_action_assignment d on b.id=d.menu_user_assignment_id
		left JOIN sys_action e ON d.action_id=e.id
		WHERE a.username='$user' AND c.url='$url'")->queryAll();
		$i=0;
		foreach($command as $row){
			$return[$i]=$row['name'];
			$i++;
		}
		return $return;
	}
}