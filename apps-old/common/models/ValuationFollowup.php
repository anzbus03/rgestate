<?php

/**
 * This is the model class for table "{{insurance_followup}}".
 *
 * The followings are the available columns in table '{{insurance_followup}}':
 * @property integer $id
 * @property integer $form_id
 * @property string $status
 * @property string $details
 * @property string $date_added
 * @property string $last_updated
 * @property integer $updated_by
 *
 * The followings are the available model relations:
 * @property InsuranceForm $form
 * @property User $updatedBy
 */
class ValuationFollowup extends  ActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{valuation_followup}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('status', 'required'),
            array('form_id, updated_by,proposed_price', 'numerical', 'integerOnly'=>true),
            array('status', 'length', 'max'=>1),
            array('proposed_price', 'length', 'max'=>10),
            array('status', 'validateStatus' ),
            
            
            array('details', 'length', 'max'=>250),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, form_id, status, details, date_added, last_updated, updated_by', 'safe', 'on'=>'search'),
        );
    }
public function status_array(){
		return array(
				''=>'No Action',
				'R'=>'Rejected',
				'A'=>'Accepted',
				'U'=>'Update Feedback',
		);
	}
	
	 protected function beforeSave()
    {
        if (!parent::beforeSave()) {
            return false;
        }
        
		$this->updated_by = Yii::app()->user->getId();
        return true;
    }
    
	
	
	
	 public function validateStatus($attribute,$params){
      
			if($this->status=='Ac' and empty($this->proposed_price)) {  
				$this->addError('proposed_price',  'Please enter proposed price');
		 
			}
			if($this->status=='U' and empty($this->details)) {  
				$this->addError('details',  'Feedback cannot be blank');
		 
			}
		 
	}
	
	
    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'form' => array(self::BELONGS_TO, 'PropertyValuation', 'form_id'),
            'updatedBy' => array(self::BELONGS_TO, 'User', 'updated_by'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'form_id' => 'Form',
            'status' => 'Status',
            'details' => 'Feedback/Details',
            'date_added' => 'Date Added',
            'last_updated' => 'Last Updated',
            'updated_by' => 'Updated By',
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

        $criteria->compare('id',$this->id);
        $criteria->compare('form_id',$this->form_id);
        $criteria->compare('status',$this->status,true);
        $criteria->compare('details',$this->details,true);
        $criteria->compare('date_added',$this->date_added,true);
        $criteria->compare('last_updated',$this->last_updated,true);
        $criteria->compare('updated_by',$this->updated_by);
        $criteria->join .= ' LEFT JOIN {{user}} usr on usr.user_id = t.updated_by' ;
		$criteria->select = 't.*,usr.first_name,usr.last_name';
         return new CActiveDataProvider(get_class($this), array(
            'criteria'      => $criteria,
            'pagination'    => array(
                'pageSize'  => $this->paginationOptions->getPageSize(),
                'pageVar'   => 'page',
            ),
            'sort'  => array(
                'defaultOrder'  => array(
                    'id'   => CSort::SORT_DESC,
                ),
            ),
        ));
    }
    public $first_name;
    public $last_name;
    public function getuserName(){
		return $this->first_name.' '.$this->last_name; 
	}
    public function getstatusTitle(){
		$ar = $this->status_array();
		return isset($ar[$this->status]) ? $ar[$this->status] : '';
	}
  public function getfeedbackDetails(){
	  $html = '<b>'.$this->statusTitle;if($this->status=='A'){ $html.= '<br /> Proposed Price : <span class="text-red">'.number_format($this->proposed_price,2,'.','') .'</span>'; } $html.='</b>';
	  $html .= '<p>'.nl2br($this->details).'<br ><span style="color:#999">'.$this->dateAdded.' <br ><i class="fa fa-user"></i> '.$this->userName.'</span></p>';
	  return $html;
  }
    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return InsuranceFollowup the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
