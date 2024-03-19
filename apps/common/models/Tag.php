<?php

/**
 * This is the model class for table "{{tag}}".
 *
 * The followings are the available columns in table '{{tag}}':
 * @property integer $tag_id
 * @property string $tag_name
 * @property string $date_added
 * @property string $last_update
 * @property string $tag_sub_title
 * @property string $tag_type
 */
class Tag extends  ActiveRecord
{
    /**
     * @return string the associated database table name
     */
     
    public $used_in_section;
    public $used_in_category;
    public $used_in_type;
    public function tableName()
    {
        return '{{tag}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('tag_name,tag_sub_title,color_code,tag_type   ', 'required'),
            array('tag_id,priority,now_of_rows,limit_p', 'numerical', 'integerOnly'=>true),
            array('tag_name,  ', 'length', 'max'=>250),
            array('  tag_sub_title', 'length', 'max'=>10),
            array('color_code', 'length', 'max'=>7),
            array('tag_type,limit_p,enable_all', 'length', 'max'=>1),
            array('used_in_section,used_in_category,used_in_type', 'safe' ),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('tag_id, tag_name, date_added, last_update, tag_sub_title, tag_type', 'safe', 'on'=>'search'),
        );
    }
    
    public function afterSave(){
		parent::afterSave();
		if(!$this->isNewRecord){
			TagSection::model()->deleteAllByAttributes(array('tag_id'=>$this->primaryKey));
			TagCategory::model()->deleteAllByAttributes(array('tag_id'=>$this->primaryKey));
			TagType::model()->deleteAllByAttributes(array('tag_id'=>$this->primaryKey));
		}
			if(!empty($this->used_in_section)){
				$TagSection =new TagSection();
				foreach($this->used_in_section as $section_id){
					$TagSectionModel = clone $TagSection ;
					$TagSectionModel->section_id = $section_id;
					$TagSectionModel->tag_id     = $this->primaryKey;
					$TagSectionModel->save();
				}
				
			}
			 
			if(!empty($this->used_in_category)){
				$TagCategory =new TagCategory();
				foreach($this->used_in_category as $category_id){
					$TagCategoryModel		  = clone $TagCategory ;
					$TagCategoryModel->category_id = $category_id;
					$TagCategoryModel->tag_id = $this->primaryKey;
					$TagCategoryModel->save();
				}
				
			}
			if(!empty($this->used_in_type)){
				$TagCategory =new TagType();
				foreach($this->used_in_type as $category_id){
					$TagCategoryModel		  = clone $TagCategory ;
					$TagCategoryModel->type_id = $category_id;
					$TagCategoryModel->tag_id = $this->primaryKey;
					$TagCategoryModel->save();
				}
				
			}
		
	}
    public function beforeSave(){
		parent::beforeSave();
	//	$this->tag_type = 'L';
		return true ; 
	}
	
	public function getTagType(){
		return array(
		'L' => 'Properties',
		'C' => 'Agencies/Featured',
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
            'tag_id' => 'Tag',
            'tag_name' => 'Tag Name',
            'date_added' => 'Date Added',
            'last_update' => 'Last Update',
            'tag_sub_title' => 'Tag Short Code',
            'tag_sub_title' => 'Tag Short Code',
            'tag_type' => 'Tag Type',
            'now_of_rows' => 'No Of Properties in one row',
            'limit_p' => 'Maximum Number Of Properties',
            'enable_all' => 'Enable on all category when no section',
            'used_in_category' => 'Exclude category',
        );
    }
   public function arrayList(){
	   return array(
	   '5'=>'5 Coloumns',
	   '3'=>'3 Coloumns',
	   '4'=>'4 Coloumns /No Slider',
	   '6'=>'3 Coloumns /No Slider',
	   
	   );
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

        $criteria->compare('tag_id',$this->tag_id);
        $criteria->compare('tag_name',$this->tag_name,true);
        $criteria->compare('date_added',$this->date_added,true);
        $criteria->compare('last_update',$this->last_update,true);
        $criteria->compare('tag_sub_title',$this->tag_sub_title,true);
   //     $criteria->compare('tag_type','L');
$criteria->order = '-t.priority desc';
         return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
             'pagination'    => array(
                'pageSize'  => $this->paginationOptions->getPageSize(),
                'pageVar'   => 'page',
            ),
        ));
    }
	public function getTagCodeWithColor(){
		return $this->tag_sub_title.'|'.$this->color_code;
	}
	public function listData($section_id=null,$ccat_id=null,$third=null){
		 $criteria=new CDbCriteria;
		 $criteria->condition = '1';
		 $criteria->order = '-t.priority desc';
		 if(!empty($section_id)){
			$criteria->join  .= ' INNER  JOIN {{tag_section}} ts on ts.tag_id =t.tag_id  and ts.section_id = :section_id '  ;
			$criteria->params[':section_id'] = $section_id;
		 }
		 else if(!empty($ccat_id)){
			 $criteria->join  .= ' LEFT  JOIN {{tag_category}} tc on tc.tag_id =t.tag_id  and tc.category_id = :category_id '  ;
			 $criteria->params[':category_id'] = $ccat_id;
			 $criteria->condition  .= '  and t.enable_all = "1" and tc.tag_id IS NULL '  ;
			 $criteria->order = '-t.c_priority desc';
		 }
		 else if(!empty($third)){
			 $criteria->join  .= ' INNER  JOIN {{tag_type}} tt on tt.tag_id =t.tag_id  and tt.type_id = :type '  ;
			 $criteria->params[':type'] = $third;
			 $criteria->order = '-t.c_priority desc';
		 }
		 $criteria->condition .= ' and t.tag_type="L" ';
		return self::model()->findAll($criteria);
	}
    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Tag the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
