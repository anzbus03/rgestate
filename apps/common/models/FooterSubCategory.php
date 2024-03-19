<?php

/**
 * This is the model class for table "{{master}}".
 *
 * The followings are the available columns in table '{{master}}':
 * @property integer $master_id
 * @property string $master_name
 * @property string $f_type
 * @property string $status
 * @property string $is_trash
 * @property string $last_updated
 */
class FooterSubCategory extends  ActiveRecord
{
	 
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{master}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('master_name,parent_master', 'required'),
            array('master_name', 'length', 'max'=>250),
            array('f_type', 'length', 'max'=>10),
            array('status, is_trash', 'length', 'max'=>1),
            array('parent_master', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('master_id, master_name, f_type, status, is_trash, last_updated', 'safe', 'on'=>'search'),
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
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'master_id' => 'Master',
            'master_name' => 'Master Name',
            'f_type' => 'F Type',
            'status' => 'Status',
            'is_trash' => 'Is Trash',
            'last_updated' => 'Last Updated',
            'category_id' => 'Category',
        );
    }
    public function getMasterName(){
		return !empty($this->master_other) ? $this->master_other : $this->master_name; 
	}
    public $master_other;
    public $category_name;
    public $parent_name;
public function getPrimaryField(){
		 return 'master_id';
	 }
	 public function findName($id=null)
    {	 
		 $criteria=new CDbCriteria;
		 $criteria->condition = "t.is_trash='0' and status='A'   and t.master_id = :master_id   ";
		 $criteria->params[':master_id'] = $id;
		 $criteria->select ="t.master_id,master_name";
		 
		  
		return   $this->find($criteria);
	}
	 public function listData($category_id=null)
    {	 
		 $criteria=new CDbCriteria;
		 $criteria->condition = "t.is_trash='0' and status='A'   and t.category_id = :category_id   ";
		 $criteria->params[':category_id'] = $category_id;
		 $criteria->select ="t.master_id,master_name";
		 return   $this->findAll($criteria);
	}
	 public function findAllChild($category_id=null)
    {	 
		 $criteria=new CDbCriteria;
		 $criteria->condition = "t.is_trash='0' and status='A'   and t.parent_master = :category_id   ";
		 $criteria->params[':category_id'] = $category_id;
		 $criteria->select ="t.master_id,master_name";
		 return   $this->findAll($criteria);
	}
    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;

        $criteria->select = 't.*,mc.category_name,mp.master_name as parent_name';
        $criteria->join = ' LEFT JOIN {{master_category}} mc ON mc.category_id = t.category_id ';
        $criteria->join .= ' LEFT JOIN {{master}} mp ON mp.master_id = t.parent_master ';
        $criteria->compare('t.master_id',$this->master_id);
        $criteria->compare('t.f_type','FS');
        $criteria->compare('t.master_name',$this->master_name,true);
        $criteria->compare('t.category_id',$this->category_id);
        $criteria->compare('t.status',$this->status,true);
        $criteria->compare('t.is_trash',0);
        $criteria->compare('t.last_updated',$this->last_updated,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
             'pagination'    => array(
                'pageSize'  => $this->paginationOptions->getPageSize(),
                'pageVar'   => 'page',
            ),
        ));
    }
	public function beforeSave(){
		parent::beforeSave();
		$this->f_type = 'FS';
		return true; 
	}
    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Master the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    public function ageArray(){
		$ar = array();
		for($i=18;$i<=60;$i++){
			$ar[$i] = $i;
		}
		return $ar;
	}
}
