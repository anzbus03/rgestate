<?php

/**
 * This is the model class for table "{{user_login_log}}".
 *
 * The followings are the available columns in table '{{user_login_log}}':
 * @property integer $user_id
 * @property string $date_added
 * @property string $user_ip
 */
class UserLoginLog extends ActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{user_login_log}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('user_id', 'required'),
            array('user_id', 'numerical', 'integerOnly'=>true),
            array('user_ip', 'length', 'max'=>11),
            array('l_type', 'length', 'max'=>1),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('user_id, date_added, user_ip', 'safe', 'on'=>'search'),
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
            'user_id' => 'User',
            'date_added' => 'Date Added',
            'user_ip' => 'User Ip',
            'time' =>'Date/Time'
        );
    }
    public function getLoginTitle(){
		switch($this->l_type){
			case 'I':
			return 'Log In';
			break;
			case 'O':
			return 'Log Out';
			break;
		}
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
     public $first_name;
     public $last_name;
     public $email;public $full_number; 
     public function getFullName(){
		 $html =  $this->first_name.' '.$this->last_name;
		 $html .= '<br />'.$this->email;
		 if(!empty($this->full_number)){ 
		  $html .= '<br />'.$this->full_number;
		 }
		 return  $html  ; 
	 }
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;
        $criteria->select = 't.*,usr.first_name,usr.last_name,usr.email,usr.full_number';
		$criteria->join = ' INNER JOIN {{listing_users}} usr  ON usr.user_id = t.user_id  '; 
       
		 $criteria->compare('user_ip',$this->user_ip,true);
		$formData1 = $_GET; 
		if(isset($formData1['user_m']) and !empty($formData1['user_m'])   ){
		$criteria->compare('t.user_id',$formData1['user_m']);
		}
		if(isset($formData1['log']) and !empty($formData1['log'])   ){
		$criteria->compare('t.l_type',$formData1['log']);
		}
		if(isset($formData1['f_date']) and !empty($formData1['f_date'])   ){
			$formData1['f_date'] = $formData1['f_date'].' 00:00:00';
			$from_date = OptionCommon::convert_to_utc($formData1['f_date'],'Y-m-d H:i:s');
			$criteria->compare('t.date_added>',$from_date);
		}
		if(isset($formData1['t_date']) and !empty($formData1['t_date'])   ){
			$formData1['t_date'] = $formData1['t_date'].' 23:59:59';
			$to_date = OptionCommon::convert_to_utc($formData1['t_date'],'Y-m-d H:i:s');
			$criteria->compare('t.date_added<',$to_date);
		}
		
        $criteria->order = 'date_added desc';
        return new CActiveDataProvider(get_class($this), array(
            'criteria'      => $criteria,
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
     * @return RsUserLoginLog the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    public function getDateNew(){
     return date('d-m-Y h:i:s A',strtotime($this->dateAdded));
    }
}
