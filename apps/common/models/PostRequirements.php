<?php

/**
* This is the model class for table '{{post_requirements}}'.
*
* The followings are the available columns in table '{{post_requirements}}':
* @property integer $id
* @property integer $property_type
* @property string $budget_min
* @property string $budget_max
* @property string $area_min
* @property string $area_max
* @property integer $unit
* @property integer $city_id
* @property string $name
* @property string $email
* @property string $phone
* @property string $owner_type
*/

class PostRequirements extends  ActiveRecord
 {
    /**
    * @return string the associated database table name
    */
    public $_recaptcha ;
    public $agree;
    public $is_phone_validated ;

    public function tableName()
 {
        return '{{post_requirements}}';
    }

    /**
    * @return array validation rules for model attributes.
    */

    public function rules()
 {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        $required = $this->mTag()->gettag( 'required', 'Required' );
        return array(
            array( 'name, email, phone, owner_type,p_for,property_type,budget_min', 'required',  'message'=>$required ),
            array( 'agree', 'required',  'message'=>$this->mTag()->getTag( 'please_select', 'Please select.' ) ),
            array( 'property_type, unit, city_id', 'numerical', 'integerOnly'=>true ),
            array( 'is_phone_validated', 'validateHiddenInput' ),
            array( 'budget_min, budget_max, area_min, area_max', 'length', 'max'=>10 ),
            array( '_recaptcha', 'validateRecaptcha', 'on'=>'insert' ),
            array( 'name, email', 'length', 'max'=>250 ), array( 'email', 'email' ),
            array( 'phone', 'length', 'max'=>20 ),
            array( 'owner_type', 'length', 'max'=>1 ),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array( 'id, date_added, property_type, budget_min, budget_max, area_min, area_max, unit, city_id, name, email, phone, owner_type', 'safe', 'on'=>'search' ),
        );
    }

    public function getemailDetails() {
        $html = '<table class="table table-bordered table-hover table-striped">
<thead>
<tr>
<th  colspan="2">Requirement Details</th>
</thead> 
<tbody> 
<tr class="even">
<td style="width:100px;">'.$this->getAttributeLabel( 'p_for' ).'</td>
<td>'.@$this->PforTitle.'</td>
</tr>
<tr class="even">
<td style="width:70px;">'.$this->getAttributeLabel( 'property_type' ).'</td>
<td>'.@$this->PropertyTitle.'</td>
</tr>
<tr class="odd">
<td style="width:70px;">Budget</td>
<td>'.@$this->BudgetTitle.'</td>
</tr>
<tr class="odd">
<td style="width:70px;">Built Up Area</td>
<td>'.@$this->BuitTitle.' </td>
</tr>
<tr class="odd">
<td style="width:70px;">City/Community</td>
<td>'.@$this->CityTitle.' </td>
</tr>
<td colspan="2">Contact Details</td></tr>
<tr class="even"> 
<td colspan="2">'.$this->name.'('.$this->OtypeTitle.')<br />
<a href="tel:'.$this->phone.'">'.$this->phone.'</a><br /><a href="mailto:'.$this->email.'">'.$this->email.'</a><br /></td>
</tr> 
</tbody> 
</table>';
        return $html;

    }

    public function afterSave() {
        parent::afterSave();

        $options = Yii::app()->options;
        $emailTemplate =  CustomerEmailTemplate::model()->getTemplateByUid( 'py004dn1x7534' );
        ;
        $emailTemplate_customer =  CustomerEmailTemplate::model()->getTemplateByUid( 'hf203h4tska52' );
        ;
        $emailTemplate_common = $this->commonTemplate()   ;
        if ( $emailTemplate )
        {
            if ( !empty( $emailTemplate->receiver_list ) ) {
                $list_receivers = array_filter( explode( ',', $emailTemplate->receiver_list ) );
            }
            $subject		 = $emailTemplate->subject;
            $emailTemplate  = $emailTemplate->content;
            $emailTemplate = str_replace( '[DETAILS]', $this->emailDetails, $emailTemplate );

            $emailTemplate = str_replace( '[CONTENT]', $emailTemplate, $emailTemplate_common );
            $status = 'S';

            $adminEmail = new Email();

            $adminEmail->subject = $subject ;
            $adminEmail->message = $emailTemplate;
            if ( !empty( $list_receivers ) ) {
                $receipeints = serialize( $list_receivers );
            } else {
                $receipeints = serialize( array( $options->get( 'system.common.admin_email' ) ) );
            }
            $adminEmail->status = $status;
            $adminEmail->receipeints = $receipeints;
            $adminEmail->sent_on =   1;
            $adminEmail->type =   'REGISTER';
            $adminEmail->sent_on_utc =   new CDbExpression( 'NOW()' );
            $adminEmail->save( false );

            $adminEmail->send;
        }
        if ( $emailTemplate_customer ) {
            $subject		 = $emailTemplate_customer->subject;
            $emailTemplate = $emailTemplate_customer->content;

            $emailTemplate = str_replace( '[NAME]', $this->name, $emailTemplate );
            //$emailTemplate = str_replace( '[CONTENT]', $emailTemplate, $emailTemplate_common );

            $status = 'S';

            $adminEmail = new Email();

            $adminEmail->subject = $subject ;
            $adminEmail->message =   Yii::t( 'app', $emailTemplate_common, array( '[CONTENT]'=>$emailTemplate ) );

            $receipeints = serialize( array( $this->email ) );
            $adminEmail->status = $status;
            $adminEmail->receipeints = $receipeints;
            $adminEmail->sent_on =   1;
            $adminEmail->type =   'REGISTER';
            $adminEmail->sent_on_utc =   new CDbExpression( 'NOW()' );
            $adminEmail->save( false );

            $adminEmail->send;
        }
    }

    public function validateHiddenInput( $attribute, $params )
    {

        if ( $this->is_phone_validated != '1' ) {
            $this->addError( 'phone',  'Please enter valid phone number' );
        }

    }

    public function validateRecaptcha( $attribute, $params ) {

        if ( !Yii::app()->request->isAjaxRequest ) {

            $captcha = '';
            if ( isset( $_POST[ 'g-recaptcha-response' ] ) ) {
                $captcha = $_POST[ 'g-recaptcha-response' ];
            }

            if ( !$captcha ) {
                $this->addError( $attribute, Yii::app()->tags->getTag( 'captcha_check', 'Please check the   captcha form.' ) );
            }

            $data = array(
                'secret' => Yii::app()->options->get( 'system.common.re_captcha_secret', '6Ldsl2IaAAAAAO_jFA_V7ldxyoDUnZLeIvNZ8owG' ),
                'response' => $captcha,
                'remoteip' => $_SERVER[ 'REMOTE_ADDR' ]
            );

            $verify = curl_init();
            curl_setopt( $verify, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify' );
            curl_setopt( $verify, CURLOPT_POST, true );
            curl_setopt( $verify, CURLOPT_POSTFIELDS, http_build_query( $data ) );
            curl_setopt( $verify, CURLOPT_SSL_VERIFYPEER, false );
            curl_setopt( $verify, CURLOPT_RETURNTRANSFER, true );
            $res = curl_exec( $verify );

            $captcha = json_decode( $res );

            if ( $captcha->success ) {

            } else {
                $this->addError( $attribute,  'Spam suspect. Please try again.' );
            }

        }

    }

    /**
    * @return array relational rules.
    */

    public function relations()
 {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array();
    }

    public function getOtypeTitle() {
        $ar = $this->ownerarray();
        return isset( $ar[ $this->owner_type ] ) ? $ar[ $this->owner_type ] : '';

    }

    public function getPforTitle() {
        $ar = $this->p_forarray();
        return isset( $ar[ $this->p_for ] ) ? $ar[ $this->p_for ] : '';

    }

    public function getCityTitle() {
        $type = States::model()->findbyPk( $this->city_id );
        if ( $type ) {
            return $type->state_name;
        }
    }

    public function getPropertyTitle() {
        $type = Category::model()->findbyPk( $this->property_type );
        if ( $type ) {
            return $type->category_name;
        }
    }

    public function getBudgetTitle() {
        $html = '';

        if ( ( !empty( $this->budget_min ) and $this->budget_min != '0.00' ) or ( !empty( $this->budget_max ) and $this->budget_max != '0.00' ) ) {
            if ( ( !empty( $this->budget_min ) and $this->budget_min != '0.00' ) ) {
                $html = Yii::t( 'app', $this->budget_min, array( '.00'=>'' ) ). '(min)';

            }
            if ( ( !empty( $this->budget_max ) and $this->budget_max != '0.00' ) ) {
                if ( !empty( $html ) ) {
                    $html .= ' and ';
                }
                $html .= Yii::t( 'app', $this->budget_max, array( '.00'=>'' ) ).'(max)';

            }
        }
        return $html ;

    }

    public function getBuitTitle() {
        $html = '';
        $unit = $this->unitTitle;

        if ( ( !empty( $this->area_min ) and $this->area_min != '0.00' ) or ( !empty( $this->area_max ) and $this->area_max != '0.00' ) ) {
            if ( ( !empty( $this->area_min ) and $this->area_min != '0.00' ) ) {
                $html = Yii::t( 'app', $this->area_min, array( '.00'=>'' ) ).' '.$unit. ' (min) ';

            }
            if ( ( !empty( $this->area_max ) and $this->area_max != '0.00' ) ) {
                if ( !empty( $html ) ) {
                    $html .= ' and ';
                }
                $html .= Yii::t( 'app', $this->area_max, array( '.00'=>'' ) ).' '.$unit. ' (max) ';

            }
        }
        return $html ;

    }

    public function getunitTitle() {
        $type = AreaUnit::model()->findbyPk( $this->unit );
        if ( $type ) {
            return $type->master_name;
        }
    }

    public function p_forarray() {
        return array(
            '1' => $this->mTag()->getTag( 'buy', 'Buy' ),
            '2' => $this->mTag()->getTag( 'rent', 'Rent' ),
        );
    }

    public function ownerarray() {
        return array(
            '1' => $this->mTag()->getTag( 'owner', 'Owner' ),
            '2' => $this->mTag()->getTag( 'agent', 'Agent' ),
        );
    }
    /**
    * @return array customized attribute labels ( name=>label )
    */

    public function attributeLabels()
 {
        $mTag = $this->mTag();
        return array(
            'id' => 'ID',
            'p_for' => $mTag->getTag( 'property_for', 'Property for' ),
            'property_type' => $mTag->getTag( 'property_type', 'Property Type' ),
            'budget_min' => $mTag->getTag( 'budget_min', 'Budget Min' ),
            'budget_max' =>  $mTag->getTag( 'budget_max', 'Budget Max' ),
            'area_min' =>  $mTag->getTag( 'area_min', 'Area Min' ),
            'area_max' => $mTag->getTag( 'area_max', 'Area Max' ),
            'unit' => 'Unit',
            'city_id' => $mTag->getTag( 'city', 'City' ),
            'email'         => $mTag->getTag( 'email', 'Email' ),
            'name'         => $mTag->getTag( 'full_name', 'Name' ),
            'phone' => $mTag->getTag( 'phone', 'Phone' ),
            'owner_type' => $mTag->getTag( 'i_am', 'I am' ),
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

        $criteria = new CDbCriteria;
        // print_r(5);
        if (isset($this->date_added['start'], $this->date_added['end'])) {
            
            $criteria->addCondition('t.date_added >= :startDate AND t.date_added <= :endDate');
            $criteria->params[':startDate'] = $this->date_added['start'];
            $criteria->params[':endDate'] = $this->date_added['end'];
        }
        $criteria->compare( 'id', $this->id );
        $criteria->compare( 'property_type', $this->property_type );
        $criteria->compare( 'budget_min', $this->budget_min, true );
        $criteria->compare( 'budget_max', $this->budget_max, true );
        $criteria->compare( 'area_min', $this->area_min, true );
        $criteria->compare( 'area_max', $this->area_max, true );
        $criteria->compare( 'unit', $this->unit );
        $criteria->compare( 'city_id', $this->city_id );
        $criteria->compare( 'name', $this->name, true );
        $criteria->compare( 'email', $this->email, true );
        $criteria->compare( 'phone', $this->phone, true );
        $criteria->compare( 'owner_type', $this->owner_type, true );

        $criteria->order = 'id desc';
        return new CActiveDataProvider( $this, array(
            'criteria'=>$criteria,
            'pagination'    => array(
                'pageSize'  => $this->paginationOptions->getPageSize(),
                'pageVar'   => 'page',
            ),
        ) );
    }

    /**
    * Returns the static model of the specified AR class.
    * Please note that you should have this exact method in all your CActiveRecord descendants!
    * @param string $className active record class name.
    * @return PostRequirements the static model class
    */
    public static function model( $className = __CLASS__ )
 {
        return parent::model( $className );
    }

}
