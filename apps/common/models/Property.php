<?php

/**
 * This is the model class for table "mw_banner".
 *
 * The followings are the available columns in table 'mw_banner':
 * @property integer $banner_id
 * @property integer $position_id
 * @property string $image
 * @property string $status
 * @property string $isTrash
 * @property integer $priority
 *
 * The followings are the available model relations:
 * @property BannerPosition $position
 */
class Property extends ActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'mw_property';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name,description,', 'required'),
            array('status, isTrash', 'length', 'max'=>1),
          
           array('slug', 'safe' ),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, name, description, status, isTrash', 'safe', 'on'=>'search'),
        );
    }
      public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
             'project' => array(self::HAS_MANY, 'Project', 'property_id','on'=>"project.isTrash='0' and project.status='A'",'joinType'=>'INNER JOIN'),
        );
    }
    /**
     * @return array relational rules.
     */
 
    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'Banner',
            'name' => 'Property Name',
            'description' => 'Description',
            'status' => 'Status',
            'isTrash' => 'Is Trash',
          
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
    public function  listData()
    {
		 $criteria=new CDbCriteria;
		 $criteria->condition = "t.isTrash='0' and status='A'";
		 
		  $criteria->order="name";
		  return $this->findAll($criteria);
	}
 
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('id',$this->id);
        $criteria->compare('name',$this->name,true);
        $criteria->compare('t.isTrash',0,true);
        $criteria->compare('t.status',$this->status,true);
        $criteria->order="t.id desc";
        

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
               'pagination'    => array(
                'pageSize'  => $this->paginationOptions->getPageSize(),
                'pageVar'   => 'page',
            ),
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Banner the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    public function _setDefaultEditorForContent(CEvent $event)
    {
        if ($event->params['attribute'] == 'description') {
            $options = array();
            if ($event->params['htmlOptions']->contains('wysiwyg_editor_options')) {
                $options = (array)$event->params['htmlOptions']->itemAt('wysiwyg_editor_options');
            }
            $options['id'] = CHtml::activeId($this, 'description');
            $options['height'] = 400;
            $options['toolbar']= 'Default';
            $event->params['htmlOptions']->add('wysiwyg_editor_options', $options);
        }
    }
    
     protected function afterConstruct()
    {
        $this->fieldDecorator->onHtmlOptionsSetup = array($this, '_setDefaultEditorForContent');
        parent::afterConstruct();
    }
    function getProperty()
	{
		 static $_options = array();
		 
		 $r= $this->findAll(array("condition"=>"isTrash='0' and t.status='A'" ,"order"=>"name"));
	 
		 if($r)
		 {
			 foreach($r as $k=>$v)
			 {
				  $_options[$v->id] =  $v->name; 
			 }
	     }
	     return $_options;
		 
	}
    protected function afterFind()
    {
        $this->fieldDecorator->onHtmlOptionsSetup = array($this, '_setDefaultEditorForContent');
        parent::afterFind();
    }
     public function behaviors(){
		 
    return array_merge(parent::behaviors(),array(
        'SlugBehavior' => array(
            'class' => 'common.models.SlugBehavior.SlugBehavior',
            'slug_col' => 'slug',
            'title_col' => 'name',
            
            'overwrite' => false
        ))
    );
  }
      public function getDelvelopmentList($notid="")
    {
		$criteria = new CDbCriteria();
        $criteria->order = 't.name asc';
        $criteria->select = 't.name,t.slug'; ;
        $criteria->condition = 't.status=:pub and  t.isTrash=:isTrash and   t.id !=:notin';
		$criteria->params[':isTrash']   = '0'  ;
		$criteria->params[':notin']   = $notid  ;
		$criteria->params[':pub']      = "A" ;
        $criteria->limit = 10; 
       return  $this->findAll($criteria);
	}
}
