<?php

/**
 * This is the model class for table "{{advertisement_layout}}".
 *
 * The followings are the available columns in table '{{advertisement_layout}}':
 * @property integer $advertisemen_id
 * @property string $advertising_title
 * @property string $layout
 * @property string $isTrash
 * @property string $status
 * @property string $date_added
 * @property string $last_updated
 */
class AdvertisementLayout extends  ActiveRecord
{
    /**
     * @return string the associated database table name
     */
    const HOME_FEATURED_BANNER = '4';
    public function tableName()
    {
        return '{{advertisement_layout}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('advertising_title, layout,max_items,position_banner', 'required'),
            array('advertisemen_id', 'numerical', 'integerOnly'=>true),
            array('advertising_title', 'length', 'max'=>250),
            array('layout, isTrash, status', 'length', 'max'=>5),
             array('header_text', 'safe'),
            array('max_items', 'numerical', 'integerOnly'=>true, 'max'=>'8','min'=>'3'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('advertisemen_id, advertising_title, layout, isTrash, status, date_added, last_updated', 'safe', 'on'=>'search'),
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
    
    public function layout_arry(){
		return array(
		'R1' => 'Rows1',
		'R2' => 'Rows2',
		'R2M1' => 'Rows2 Middle1',
		'R1S' => 'Row 1 Slider',
		);
	}
	public function banner_positon(){
		$ar =  array(
		'T' => 'Home Top Banner With Slider',
		'HB' => 'Home  Advertisement Section',
		);
		if($this->position_banner=='T'){
				$ar =  array(
				'T' => 'Home Top Banner With Slider',
				);
		}
		else{
			unset($ar['T']);
		}
		return $ar;
	}
	public function banner_positon_array(){
		$ar =  array(
		'T' => 'Home Top Banner With Slider',
		'HB' => 'Home  Advertisement Section',
		);
		return $ar;
	}
    public function getLayoutTitle(){
		$ar = $this->layout_arry();
		return isset($ar[$this->layout]) ? $ar[$this->layout] : ''; 
		 
	}

    public function getPositionTitle(){
		$ar = $this->banner_positon_array();
		return isset($ar[$this->position_banner]) ? $ar[$this->position_banner] : ''; 
		 
	}

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'advertisemen_id' => 'Advertisemen',
            'advertising_title' => 'Advertising Title',
            'layout' => 'Layout',
            'max_items' => 'Maximum Ads In a Row [ Min 3 and Max 8 ]',
            'isTrash' => 'Is Trash',
            'status' => 'Status',
            'date_added' => 'Date Added',
            'last_updated' => 'Last Updated',
        );
    }
    public function afterConstruct(){
		parent::afterConstruct();
		$this->max_items = '3';
		return true; 
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

        $criteria->compare('advertisemen_id',$this->advertisemen_id);
        $criteria->compare('advertising_title',$this->advertising_title,true);
        $criteria->compare('layout',$this->layout,true);
        $criteria->compare('position_banner!','Li');
        $criteria->compare('isTrash',$this->isTrash,true);
        $criteria->compare('status',$this->status,true);
        $criteria->compare('date_added',$this->date_added,true);
        $criteria->compare('last_updated',$this->last_updated,true);
		$criteria->order = '-t.priority desc,advertising_title asc';
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return AdvertisementLayout the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    public function featured_text(){
	    $criteria=new CDbCriteria;
	    $criteria->select = 't.header_text';
        $criteria->compare('advertisemen_id',self::HOME_FEATURED_BANNER);
        return $this->find($criteria);
       
	}
    public function findHomeAdvertisementLayout(){
	    $criteria=new CDbCriteria;
	    $criteria->select = 't.advertisemen_id,t.header_text';
        $criteria->compare('position_banner','HB');
        $criteria->compare('isTrash','0');
        $criteria->compare('status','A');
        $criteria->order = '-t.priority desc,advertising_title asc';
        return $this->findAll($criteria);
       
	}
}
