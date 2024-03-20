<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * PricePlanPromoCode
 *
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com>
 * @link http://www.mailwizz.com/
 * @copyright 2013-2017 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 * @since 1.3.4.4
 */

/**
 * This is the model class for table "{{price_plan_promo_code}}".
 *
 * The followings are the available columns in table '{{price_plan_promo_code}}':
 * @property integer $promo_code_id
 * @property string $code
 * @property string $type
 * @property string $discount
 * @property string $total_amount
 * @property integer $total_usage
 * @property integer $customer_usage
 * @property string $date_start
 * @property string $date_end
 * @property string $status
 * @property string $date_added
 * @property string $last_updated
 *
 * The followings are the available model relations:
 * @property PricePlanOrder[] $pricePlanOrders
 */
class PricePlanPromoCode extends ActiveRecord
{
    const TYPE_PERCENTAGE = 'percentage';

    const TYPE_FIXED_AMOUNT = 'fixed amount';

    public $pickerDateStartComparisonSign;

    public $pickerDateEndComparisonSign;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{price_plan_promo_code}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		$rules = array(
			array('code, type, discount, total_amount, total_usage, customer_usage, date_start, date_end, status', 'required','on'=>'insert,update'),

            array('code', 'length', 'min' => 1, 'max' => 15),
             array('code', 'unique','on'=>'insert,update'),
            array('code', 'required',"on"=>'applycode,applycodeoffer',  'message'=>$this->mTag()->gettag('required','Required')),
            array('code', 'validatePromoC',"on"=>'applycode'),
            array('code', 'validatePromoCOffer',"on"=>'applycodeoffer'),
            array('assigned_to,plan_id,offer_title,offer_title_ar', 'safe'),
            array('type', 'in', 'range' => array_keys($this->getTypesList())),
            array('discount, total_amount', 'numerical'),
            array('discount, total_amount', 'type', 'type' => 'float'),
            array('total_usage, customer_usage', 'length', 'min' => 1),
            array('total_usage, customer_usage', 'numerical', 'integerOnly' => true, 'min' => 0, 'max' => 9999),
            array('date_start, date_end', 'date', 'format' => 'yyyy-MM-dd'),

            array('pickerDateStartComparisonSign, pickerDateEndComparisonSign', 'in', 'range' => array_keys($this->getComparisonSignsList())),
			array('code, type, discount, total_amount, total_usage, customer_usage, date_start, date_end, status', 'safe', 'on'=>'search'),
		);
        return CMap::mergeArray($rules, parent::rules());
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
	 
          $relations = array(
          'plan'           => array(self::BELONGS_TO, 'Package', 'plan_id'),
             'pricePlanOrders' => array(self::HAS_MANY, 'PricePlanOrder', 'promo_code_id'),
             'assigned'                 => array(self::BELONGS_TO, 'User', 'assigned_to'),
            //'autoLoginTokens' => array(self::HAS_MANY, 'UserAutoLoginToken', 'user_id'),
        );
        
        return CMap::mergeArray($relations, parent::relations());
	}
	public function getAssignedOwner()
	{
	  if(!empty($this->assigned_to)){
	      $cus = User::model()->findByPk($this->assigned_to);
	      if(!empty( $cus)){ return  $cus->fullName; }
	  }
        
       
	}
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		$labels = array(
			'code_id'        => Yii::t('promo_codes', 'Code'),
			'code'           => Yii::t('promo_codes', 'Code'),
			'type'           => Yii::t('promo_codes', 'Type'),
			'discount'       => Yii::t('promo_codes', 'Discount'),
			'total_amount'   => Yii::t('promo_codes', 'Total amount'),
			'total_usage'    => Yii::t('promo_codes', 'Total usage'),
			'customer_usage' => Yii::t('promo_codes', 'Customer usage'),
			'date_start'     => Yii::t('promo_codes', 'Date start'),
			'date_end'       => Yii::t('promo_codes', 'Date end'),
			'plan_id'       => Yii::t('promo_codes', 'Offer Package'),
			'offer_title'       => Yii::t('promo_codes', 'Offer Title'),
			'offer_title_ar'       => Yii::t('promo_codes', 'Offer Title (Arabic)'),
		);
        return CMap::mergeArray($labels, parent::attributeLabels());
	}
	public function getOfferTitle(){
		
        if(defined('LANGUAGE')){
			 if(LANGUAGE=='en'){
				  return $this->offer_title;  }
			 }
			 if(LANGUAGE=='ar'){
				 if(!empty($this->offer_title_ar)){ return $this->offer_title_ar;  }
				 if($this->offer_title=='Pre-Launch'){return 'قبل الانشاء'; }
				 return $this->getTranslateCurl('offer_title');
			 }
		 
		 return $this->offer_title;
	}
	
	 public function getTranslateCurl($field){
			$handle = curl_init();

			if (FALSE === $handle)
			throw new Exception('failed to initialize');

			curl_setopt($handle, CURLOPT_URL,'https://www.googleapis.com/language/translate/v2');
			curl_setopt($handle, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
			 $source = 'en';$target = 'ar';  
			curl_setopt($handle, CURLOPT_POSTFIELDS, array('key'=> 'AIzaSyAY0-OgH2OLDs25xXI_Ei8hP4sTje0Wva4', 'format'=>'text','q' => $this->$field, 'source' => $source , 'target' => $target));
			curl_setopt($handle,CURLOPT_HTTPHEADER,array('X-HTTP-Method-Override: GET'));
			$response = curl_exec($handle);

			$data = json_decode($response,true); 
			if(isset($data['data']['translations']['0']['translatedText'])){
				return   $data['data']['translations']['0']['translatedText']; 
			}

	 }

    /**
     * @return array help text for attributes
     */
    public function attributeHelpTexts()
    {
        $texts = array(
            'code_id'        => Yii::t('promo_codes', 'Code'),
			'code'           => Yii::t('promo_codes', 'The promotional code'),
			'type'           => Yii::t('promo_codes', 'The type of the promotional code'),
			'discount'       => Yii::t('promo_codes', 'The discount received after applying this promotional code'),
			'total_amount'   => Yii::t('promo_codes', 'The amount of the price plan in order for this promotional code to apply'),
			'total_usage'    => Yii::t('promo_codes', 'The maximum number of usages for this promotional code. Set it to 0 for unlimited'),
			'customer_usage' => Yii::t('promo_codes', 'How many times a customer can use this promotional code. Set it to 0 for unlimited'),
			'date_start'     => Yii::t('promo_codes', 'The start date for this promotional code'),
			'date_end'       => Yii::t('promo_codes', 'The end date for this promotional code'),
		);

        return CMap::mergeArray($texts, parent::attributeHelpTexts());
    }

    /**
     * @return array attribute placeholders
     */
    public function attributePlaceholders()
    {
        $placeholders = array(
            'code_id'        => '',
			'code'           => Yii::t('promo_codes', $this->mTag()->getTag('example:','Example:').' FREE100'),
			'type'           => '',
			'discount'       => Yii::t('promo_codes', 'i.e: 10'),
			'total_amount'   => Yii::t('promo_codes', 'i.e: 30'),
			'total_usage'    => Yii::t('promo_codes', 'i.e: 10'),
			'customer_usage' => Yii::t('promo_codes', 'i.e: 1'),
			'date_start'     => Yii::t('promo_codes', Yii::t('promo_codes', 'i.e: {date}', array('{date}' => date('Y-m-d')))),
			'date_end'       => Yii::t('promo_codes', Yii::t('promo_codes', 'i.e: {date}', array('{date}' => date('Y-m-d', strtotime('+30 days'))))),
		);

        return CMap::mergeArray($placeholders, parent::attributePlaceholders());
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
		 
		$criteria=new CDbCriteria;

        $comparisonSigns   = $this->getComparisonSignsList();
        $originalDateStart = $this->date_start;
        $originalDateEnd   = $this->date_end;
        if (!empty($this->pickerDateStartComparisonSign) && in_array($this->pickerDateStartComparisonSign, array_keys($comparisonSigns))) {
            $this->date_start = $comparisonSigns[$this->pickerDateStartComparisonSign] . $this->date_start;
        }
        if (!empty($this->pickerDateEndComparisonSign) && in_array($this->pickerDateEndComparisonSign, array_keys($comparisonSigns))) {
            $this->date_end = $comparisonSigns[$this->pickerDateEndComparisonSign] . $this->date_end;
        }

		$criteria->compare('code', $this->code, true);
		$criteria->compare('type', $this->type);
		$criteria->compare('discount', $this->discount);
		$criteria->compare('assigned_to', $this->assigned_to);
		$criteria->compare('total_amount', $this->total_amount);
		$criteria->compare('total_usage', $this->total_usage);
		$criteria->compare('customer_usage', $this->customer_usage);
		$criteria->compare('date_start', $this->date_start);
		$criteria->compare('date_end', $this->date_end);
		$criteria->compare('status', $this->status);

        $this->date_start = $originalDateStart;
        $this->date_end   = $originalDateEnd;

		return new CActiveDataProvider(get_class($this), array(
            'criteria'      => $criteria,
            'pagination'    => array(
                'pageSize'  => $this->paginationOptions->getPageSize(),
                'pageVar'   => 'page',
            ),
            'sort'=>array(
                'defaultOrder' => array(
                    'promo_code_id'  => CSort::SORT_DESC,
                ),
            ),
        ));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PricePlanPromoCode the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getTypesList()
    {
        return array(
            self::TYPE_FIXED_AMOUNT => ucfirst(Yii::t('promo_codes', self::TYPE_FIXED_AMOUNT)),
            self::TYPE_PERCENTAGE   => ucfirst(Yii::t('promo_codes', self::TYPE_PERCENTAGE)),
        );
    }

    public function getTypeName($type = null)
    {
        if ($type === null) {
            $type = $this->type;
        }
        $types = $this->getTypesList();
        return isset($types[$type]) ? $types[$type] : null;
    }

    public function getCurrency()
    {
        return Currency::model()->findDefault();
    }

    public function getFormattedDiscount()
    {
        if ($this->type == self::TYPE_FIXED_AMOUNT) {
            return Yii::app()->numberFormatter->formatCurrency($this->discount, $this->getCurrency()->code);
        }
        return Yii::app()->numberFormatter->formatDecimal($this->discount) . '%';
    }

    public function getFormattedTotalAmount()
    {
        return Yii::app()->numberFormatter->formatCurrency($this->total_amount, $this->getCurrency()->code);
    }

    public function getDateStart()
    {
        return $this->dateTimeFormatter->formatLocalizedDate($this->date_start);
    }

    public function getDateEnd()
    {
        return $this->dateTimeFormatter->formatLocalizedDate($this->date_end);
    }

    public function getDatePickerFormat()
    {
        return 'yy-mm-dd';
    }

    public function getDatePickerLanguage()
    {
        $language = Yii::app()->getLanguage();
        if (strpos($language, '_') === false) {
            return $language;
        }
        $language = explode('_', $language);

        // commented since 1.3.5.9
        // return $language[0] . '-' . strtoupper($language[1]);
        return $language[0];
    }
     public function validatePromoC()
    {
        $request = Yii::app()->request;
        $notify  = Yii::app()->notify;
        $session = Yii::app()->session;
        
        $session->remove('promo_code');
         
        $promoCode = $this->code;
        if (empty($promoCode)) {
            			$this->addError('code',  Yii::t('app','Required',array('{attribute}'=>$this->getAttributeLabel('code'))));
		
        }

        $criteria = new CDbCriteria();
        $criteria->compare('code', $promoCode);
        $criteria->compare('status', PricePlanPromoCode::STATUS_ACTIVE);
        $criteria->addCondition('date_start <= NOW() AND date_end >= NOW()');
        $promoCodeModel = PricePlanPromoCode::model()->find($criteria);
        
        if (empty($promoCodeModel)) {
             $this->addError('code', $this->mTag()->gettag('the_provided_promotional_code_','The provided promotional code does not exists anymore!'));
        }

         
        
        $customer = Yii::app()->user->getModel();
        if ($promoCodeModel->customer_usage > 0) {
            $usedByThisCustomer = PricePlanOrder::model()->countByAttributes(array(
                'promo_code_id' => $promoCodeModel->promo_code_id,
                'customer_id'   => $customer->user_id,
            ));
            if ($usedByThisCustomer >= $promoCodeModel->customer_usage) {
                 $this->addError('code', $this->mTag()->gettag('you_have_reached_the_maximum_u','You have reached the maximum usage times for this promo code!'));
            }
        }
        
        if ($promoCodeModel->total_usage > 0) {
            $usedTimes = PricePlanOrder::model()->countByAttributes(array(
                'promo_code_id' => $promoCodeModel->promo_code_id,
            ));
            if ($usedTimes >= $promoCodeModel->total_usage) {
               	$this->addError('code','');
                          $this->addError('code', $this->mTag()->gettag('this_promo_code_has_reached_th','This promo code has reached the maximum usage times!'));
        
            }
        }
        $session->add('promo_code', $promoCodeModel->code);
        
         
    }
     public function validatePromoCOffer()
    {
        $request = Yii::app()->request;
        $notify  = Yii::app()->notify;
        $session = Yii::app()->session;
        
        $session->remove('promo_code');
         
        $promoCode = $this->code;
        if (empty($promoCode)) {
            			$this->addError('code',  Yii::t('app','Required',array('{attribute}'=>$this->getAttributeLabel('code'))));
		
        }
 
        $criteria = new CDbCriteria();
        $criteria->compare('code', $promoCode);
        $criteria->compare('status', PricePlanPromoCode::STATUS_ACTIVE);
        $criteria->addCondition('date_start <= NOW() AND date_end >= NOW()');
        $criteria->condition .= ' and t.plan_id is not null ';
        $promoCodeModel = PricePlanPromoCode::model()->find($criteria);
        
        if (empty($promoCodeModel)) {
              $this->addError('code', $this->mTag()->gettag('the_provided_promotional_code_','The provided promotional code does not exists anymore1!'));
        }

          
        $customer = Yii::app()->user->getModel();
        if ($promoCodeModel->customer_usage > 0) {
            $usedByThisCustomer = PricePlanOrder::model()->countByAttributes(array(
                'promo_code_id' => $promoCodeModel->promo_code_id,
                'customer_id'   => $customer->user_id,
            ));
            if ($usedByThisCustomer >= $promoCodeModel->customer_usage) {
				         $this->addError('code', $this->mTag()->gettag('you_have_reached_the_maximum_u','You have reached the maximum usage times for this promo code!'));
        
                
            }
        }
        
        if ($promoCodeModel->total_usage > 0) {
            $usedTimes = PricePlanOrder::model()->countByAttributes(array(
                'promo_code_id' => $promoCodeModel->promo_code_id,
            ));
            if ($usedTimes >= $promoCodeModel->total_usage) {
                               $this->addError('code', $this->mTag()->gettag('this_promo_code_has_reached_th','This promo code has reached the maximum usage times!'));
        
                 
            }
        }
        
        
        
        
         
    }
}
