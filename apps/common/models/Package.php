<?php

/**
 * This is the model class for table "mw_package".
 *
 * The followings are the available columns in table 'mw_package':
 * @property integer $package_id
 * @property string $package_name
 * @property string $price_per_month
 * @property integer $validity_in_days
 * @property integer $max_listing_per_day
 * @property string $visitors_can_directly
 * @property string $create_profile_picture
 * @property string $statistics
 * @property string $logo
 * @property string $featured
 * @property string $added_date
 * @property string $isTrash
 * @property string $status
 */
class Package extends ActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'mw_package';
    }
 public function getPrimaryField(){
		 return 'package_id';
	 }
    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('package_name,category, price_per_month, validity_in_days,currency_id,p_type,status', 'required'),
            array('validity_in_days, max_listing_per_day', 'numerical', 'integerOnly'=>true),
            array('price_per_month', 'numerical' ),
            array('validity_in_days, max_listing_per_day,no_of_users', 'numerical', 'integerOnly'=>true),
            array('package_name', 'length', 'max'=>250),
            array('max_listing_per_day', 'length', 'max'=>5),
            array('no_of_featured', 'length', 'max'=>3),
            array('price_per_month', 'length', 'max'=>10),
            array('description', 'length', 'max'=>500),
            array('package_uid,rec,valuation,photography,campain,seo,blog,banners,floor,call_of_action,email_campain,is_book,tag', 'safe' ),
            array('visitors_can_directly, create_profile_picture, statistics, logo, featured, isTrash, status', 'length', 'max'=>1),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('package_id, package_name, price_per_month, validity_in_days, max_listing_per_day, visitors_can_directly, create_profile_picture, statistics, logo, featured, added_date, isTrash, status', 'safe', 'on'=>'search'),
        );
    }
     public $ads_allowed;
    public $used_ad;
    public $uap_id;
    public $uap_validity;
	public function castegoryPackage(){
		return array(
		
		'1' => 'Broker / Company Packages',
		'2' => 'Individual Packages',
		'3' => 'Both',
		//'4' => 'Refresh Quota',
		//'5' => 'Owners Exclusive Properties',
		);
	}
	public function type_user_categories($user_type){
		if(in_array($user_type,array('P','A'))) { return array(2,3); }
		else{ return array(1,3);}
	}
 
	public function p_typePackage(){
		return array(
		
		'0' => 'Listing',
		'1' => 'Add-on Features',
		'2' => 'Offer',
	 
		);
	}
	public function getPtypeTitle(){
		$ar = $this->p_typePackage();
		return isset($ar[$this->p_type]) ? $ar[$this->p_type] : ''; 
	}
	public function getCTitle(){
	   switch($this->category){
		   case '1':
		  return  'Normal';
		   break;
		   case '2':
		   return  'Video';
		   break;
		   case '3':
		   return  'Featured';
		   break;
		    case '4':
		   return  'Refresh Quota';
		   break;
		   case '5':
		   return  'Owners Exclusive Proerties';
		   break;
		   
	   }
	}
	
	public function getFeaturedTitle(){
		if(!empty($this->no_of_featured)){ return $this->no_of_featured.' Featured Listing '; }
	}
	public function getpackageTitle(){
		return Yii::t('app',$this->package_name .': SAR. {price} - {validity}',array('{price}'=>(int)$this->price_per_month,'{validity}'=>$this->ValidityTitle ));
	}
	public function getpackageTitle2(){
		return Yii::t('app', '{Featured} {adsCount} Listings at {price} [{validity} validity]',array('{validity}'=>$this->ValidityTitle ,'{adsCount}'=>$this->max_listing_per_day,' {ctitle}' =>$this->cTitle ,'{price}'=>(int)$this->price_per_month,'{Featured}'=>$this->FeaturedTitle));
	}
	public function getCategoryTitle(){
		$ar = $this->castegoryPackage();
		return isset($ar[$this->category]) ? $ar[$this->category] : ''; 
	}
    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        	'currency' => array(self::BELONGS_TO, 'Currency', 'currency_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'package_id' => 'Package',
            'package_name' => 'Package Name',
            'price_per_month' => 'Price (SAR)',
            'validity_in_days' => 'Validity In Days',
            'max_listing_per_day' => 'No. of Property List',
            'no_of_featured' => 'No. Of Featured Listings',
            'visitors_can_directly' => 'Visitors Can Directly',
            'create_profile_picture' => 'Create Profile Picture',
            'statistics' => 'Statistics',
            'logo' => 'Logo',
            'featured' => 'Featured',
            'added_date' => 'Added Date',
            'isTrash' => 'Is Trash',
            'status' => 'Status',
            'currency_id' => 'Currency',
            'price_per_month' => 'Price',
            'rec' => 'Recommanded',
            'no_of_users' => 'No. of Users allowed',
            'valuation' => $this->mTag()->getTag('valuation_and_mortgage','Valuation and Mortgage'),
            'photography' => $this->mTag()->getTag('photography','Photography'),
            'campain' => $this->mTag()->getTag('social_media_campaign_(media_b','Social Media Campaign (Media Buying)'),
            'seo' => $this->mTag()->getTag('seo/sem','SEO/SEM'),
            'blog' => $this->mTag()->getTag('blog_upload_url_for_client','Blog upload URL for client'),
            'banners' => $this->mTag()->getTag('banners','Banners'),
            'floor' => $this->mTag()->getTag('floor_plan','Floor Plan'),
            'email_campain' => $this->mTag()->getTag('email_campain','Email campain'),
            'p_type' => 'Type',
            'category' => 'Package for',
            'is_book' => 'Book an Appointment',
        );
    }
    public function getCurrencyTitle(){
		return number_format($this->price_per_month,0,'.','').' '.$this->currency->code;
	}
    public function getPriceTitle(){
		
		if(defined('BASE_RATE')){
			return CURRENCY_CODE.' '.Yii::t('app',number_format($this->price_per_month*BASE_RATE,2,'.',''),array('.00'=>'')) ;
		}
		else{
		return number_format($this->price_per_month,0,'.','').' '.$this->currency->code;
		}
	}
	 public function getPriceTitleL(){
		
		if(defined('BASE_RATE')){
			return '<span>'.CURRENCY_CODE.' </span>'.Yii::t('app',number_format($this->price_per_month*BASE_RATE,2,'.',''),array('.00'=>'')) ;
		}
		else{
		return  '<span>'.$this->currency->code.'</span>'.number_format($this->price_per_month,0,'.','') ;
		}
	}
    public function getPriceTitleWithTax(){
		$globalTax = Tax::model()->findByAttributes(array('is_global' => Tax::TEXT_YES));
			
		if(defined('BASE_RATE')){
			$total = number_format($this->price_per_month*BASE_RATE,2,'.','');
			if($globalTax){
				$tax_value    = ($globalTax->percent / 100) * $total;
				$total		 +=  $tax_value;
		    }
			return CURRENCY_CODE.' '.Yii::t('app',  $total ,array('.00'=>'')) ;
		}
		else{
			 $total =  number_format($this->price_per_month,0,'.',''); 
			 	if($globalTax){
				$tax_value    = ($globalTax->percent / 100) * $total;
				$total		 +=  $tax_value;
		    }
				return $total.' '.$this->currency->code;
		}
				 
	}
    public function beforeSave(){
		
	   if(parent::beforeSave()) 
	   {
            
              
			if(empty($this->package_uid)) {
				$this->package_uid = $this->generateUid();
			 }
			 return true;
	   }
	return false;
	 
	}
	public function findByUid($order_uid)
    {
        return $this->findByAttributes(array(
            'package_uid' => $order_uid,
        ));    
    }
	public function findByUidFrontend($order_uid)
    {
		
		
		 $criteria=new CDbCriteria;$criteria->select  = 't.*';
		 $criteria->condition = "t.isTrash='0' and t.status='A' and t.package_uid =:package_uid ";
		 $criteria->params[':package_uid'] = $order_uid;
		 
		 $langaugae = defined('LANGUAGE') ? LANGUAGE : 'en';
	 
		if(!empty($langaugae) and  $langaugae != 'en'){
				$criteria->params[':lan'] = $langaugae;
				$criteria->join  .= 'left join `mw_translate` `translate` on (  translate.source_tag = concat("Package_description_",t.package_id) )          left join `mw_translate_relation` `translationRelation` on translationRelation.package_id = t.package_id  and  translationRelation.translate_id = translate.translate_id  LEFT  JOIN mw_translation_data tdata ON (`translationRelation`.translate_id=tdata.translation_id and tdata.lang=:lan  ) ';
				$criteria->join  .= ' left join `mw_translate` `translate1` on ( translate1.source_tag = concat("Package_call_of_action_","",t.package_id) )   left join `mw_translate_relation` `translationRelation1` on translationRelation1.package_id = t.package_id  and  translationRelation1.translate_id = translate1.translate_id  LEFT  JOIN mw_translation_data tdata1 ON (`translationRelation1`.translate_id=tdata1.translation_id and tdata1.lang=:lan  ) ';
				$criteria->join  .= ' left join `mw_translate` `translate3` on ( translate3.source_tag = concat("Package_package_name_","",t.package_id) )   left join `mw_translate_relation` `translationRelation3` on translationRelation3.package_id = t.package_id  and  translationRelation3.translate_id = translate3.translate_id  LEFT  JOIN mw_translation_data tdata3 ON (`translationRelation3`.translate_id=tdata3.translation_id and tdata3.lang=:lan  ) ';
			
				$criteria->distinct = 't.package_id';
				$criteria->select   .= ' ,  CASE WHEN tdata3.message IS NOT NULL AND translate3.source_tag IS NOT NULL    THEN  tdata3.message ELSE t.package_name END	 as  package_name ,  CASE WHEN tdata.message IS NOT NULL AND translate.source_tag IS NOT NULL    THEN  tdata.message ELSE t.description END	 as  description , CASE WHEN tdata1.message IS NOT NULL AND translate1.source_tag IS NOT NULL THEN  tdata1.message    ELSE t.call_of_action END	 as  call_of_action ';
		} 
		
		
	 
		 return $this->find($criteria);
		 
         
    }
    public function getPackageTitleNew(){
			return Yii::t('app', '{Featured} out of {adsCount} Listings at {price} [{validity} validity]',array('{validity}'=>$this->validity_in_days.' days','{adsCount}'=>$this->max_listing_per_day,' {ctitle}' =>$this->cTitle ,'{price}'=>'<b style="white-space:nowrap;">'.$this->priceTitle.'</b>','{Featured}'=>$this->FeaturedTitle));

	}
    public function getPackageDetails(){
		
		$html = '<ul class="package-detail-ul">';
						 	    
									    if(!empty($this->description )){
											  $html.= '<li><b>'. $this->package_name.'</b></li>';
									  
									    $description = explode('/n',$this->description) ;
									    foreach($description as $itm){
											$html.= '<li>'. $itm.'</li>';
										}
									    }else{
									
								 	
										if($this->max_listing_per_day !=''){
											$tot = $this->max_listing_per_day== 0  ? $this->mTag()->gettag('unlimited','Unlimited') :  (int) $this->max_listing_per_day;
										echo '<li>'.Yii::t('app',$this->mTag()->getTag('{fl}_featured_listing_out_of_{','{fl} Featured Listing out of {st}  Standard Listing'),array('{fl}'=>'<b>'.(int) $this->no_of_featured.'</b>','{st}'=>'<b>'.$tot.'</b>')).'</li>';
										}
										if(!empty($this->no_of_users)){
										echo '<li>'.Yii::t('app',$this->mTag()->getTag('{n}_user_accounts','{n} User Accounts'),array('{n}'=>'<b>'.(int) $this->no_of_users.'</b>')).'</li>';
										}
										if(!empty($this->valuation)){
										$html.= '<li>'.$this->getAttributeLabel('valuation').'</li>';
										}
										if(!empty($this->photography)){
										$html.= '<li>'.$this->getAttributeLabel('photography').'</li>';
										}
									
										if(!empty($this->seo)){
										$html.= '<li>'.$this->getAttributeLabel('seo').'</li>';
										}
											if(!empty($this->campain)){
										$html.= '<li>'.$this->getAttributeLabel('campain').'</li>';
										}
										if(!empty($this->blog)){
										$html.= '<li>'.$this->getAttributeLabel('blog').'</li>';
										}
										if(!empty($this->email_campain)){
										$html.= '<li>'.$this->getAttributeLabel('email_campain').'</li>';
										}
										if(!empty($this->floor)){
										$html.= '<li>'.$this->getAttributeLabel('floor').'</li>';
										}
										if(!empty($this->banners)){
										$html.= '<li>'.$this->getAttributeLabel('banners').'</li>';
										}
										}
										if(!empty($this->validity_in_days)){
											$html.= '<li>'.Yii::t('app',$this->mTag()->getTag('{n}_vallidity','{n} vallidity'),array('{n}'=>'<b>'.$this->ValidityTitle.'</b>')).'</li>';
										
										}
								 
							
							 $html.= '</ul>';
						 
		return $html;
		/*
		
		$html='<ul class="package-detail-ul">';
		$html.='<li class="title">'.$this->package_name.'</li>';$html.='<li class="validy">'.$this->packageTitleNew.'</li>';
		$html.='</ul>';
		return $html;
		* */
	}
    
    
	public function generateUid()
    {
        //$unique = date('ydm-His');
        $unique  =  date('dmyHi').rand(1,9);
        $exists = $this->findByUid($unique);
        
        if (!empty($exists)) {
            return $this->generateUid();
        }
        
        return $unique;
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

        $criteria->compare('package_id',$this->package_id);
        $criteria->compare('package_name',$this->package_name,true);
        $criteria->compare('price_per_month',$this->price_per_month,true);
        $criteria->compare('validity_in_days',$this->validity_in_days);
        $criteria->compare('max_listing_per_day',$this->max_listing_per_day);
        $criteria->compare('visitors_can_directly',$this->visitors_can_directly,true);
        $criteria->compare('create_profile_picture',$this->create_profile_picture,true);
        $criteria->compare('statistics',$this->statistics,true);
        $criteria->compare('category',$this->category );
        $criteria->compare('logo',$this->logo,true);
        $criteria->compare('featured',$this->featured,true);
        $criteria->compare('added_date',$this->added_date,true);
        $criteria->compare('isTrash','0',true);
        $criteria->compare('p_type',$this->p_type);
        $criteria->compare('status',$this->status,true);

                return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
             'pagination'    => array(
                'pageSize'  => $this->paginationOptions->getPageSize(),
                'pageVar'   => 'page',
            ),
        ));
    }
 	public function  listData()
    {
		 $criteria=new CDbCriteria;
		 $criteria->condition = "t.isTrash='0' and t.status='A'";
		 return $this->findAll($criteria);
	}
 	public function  findFromID($id)
    {
		 $criteria=new CDbCriteria;
		 $criteria->condition = "t.isTrash='0' and t.status='A' and package_id=:id";
		 $criteria->params[':id'] = $id;
		 return $this->find($criteria);
	}
	public $isRecommended;
	public $active_package;
	public $date_diff;
	public $active_package_validity;
 	public function  findFromCategoryID($type=null,$id_array = array())
    {
		
		 $criteria=new CDbCriteria;$criteria->select  = 't.*';
		 $criteria->condition = "t.isTrash='0' and t.status='A'  ";
		 $criteria->addInCondition('t.category',(array)$id_array);
		 
		 $langaugae = defined('LANGUAGE') ? LANGUAGE : 'en';
	 
		if(!empty($langaugae) and  $langaugae != 'en'){
				$criteria->params[':lan'] = $langaugae;
				$criteria->join  .= 'left join `mw_translate` `translate` on (  translate.source_tag = concat("Package_description_",t.package_id) )          left join `mw_translate_relation` `translationRelation` on translationRelation.package_id = t.package_id  and  translationRelation.translate_id = translate.translate_id  LEFT  JOIN mw_translation_data tdata ON (`translationRelation`.translate_id=tdata.translation_id and tdata.lang=:lan  ) ';
				$criteria->join  .= ' left join `mw_translate` `translate1` on ( translate1.source_tag = concat("Package_call_of_action_","",t.package_id) )   left join `mw_translate_relation` `translationRelation1` on translationRelation1.package_id = t.package_id  and  translationRelation1.translate_id = translate1.translate_id  LEFT  JOIN mw_translation_data tdata1 ON (`translationRelation1`.translate_id=tdata1.translation_id and tdata1.lang=:lan  ) ';
				$criteria->join  .= ' left join `mw_translate` `translate3` on ( translate3.source_tag = concat("Package_package_name_","",t.package_id) )   left join `mw_translate_relation` `translationRelation3` on translationRelation3.package_id = t.package_id  and  translationRelation3.translate_id = translate3.translate_id  LEFT  JOIN mw_translation_data tdata3 ON (`translationRelation3`.translate_id=tdata3.translation_id and tdata3.lang=:lan  ) ';
			
				$criteria->distinct = 't.package_id';
				$criteria->select   .= ' ,  CASE WHEN tdata3.message IS NOT NULL AND translate3.source_tag IS NOT NULL    THEN  tdata3.message ELSE t.package_name END	 as  package_name ,  CASE WHEN tdata.message IS NOT NULL AND translate.source_tag IS NOT NULL    THEN  tdata.message ELSE t.description END	 as  description , CASE WHEN tdata1.message IS NOT NULL AND translate1.source_tag IS NOT NULL THEN  tdata1.message    ELSE t.call_of_action END	 as  call_of_action ';
		} 
		
		
		 $criteria->order = "t.price_per_month asc ";
		 switch($type){
			 case 'L':
			 //$criteria->addInCondition('t.p_type',(array)array('0','2'));
			 $criteria->compare('t.p_type','0');
			 break;
			 case 'O':
			 //$criteria->addInCondition('t.p_type',(array)array('0','2'));
			 $criteria->compare('t.p_type','2');
			 break;
			 case 'A':
			 $criteria->compare('t.p_type','1');
			 break;
		 }
		 /*
		 $criteria->join  = "LEFT JOIN {{user_packages}} uap on uap.category_id = t.category and uap.user_id =:me and uap.latest='1' and uap.status='active' and t.package_id = uap.package_id ";
		 $criteria->order = "t.price_per_month desc ";
		 $criteria->select = "t.*,uap.ads_allowed,uap.used_ad,uap.validity as active_package_validity, CASE WHEN uap.validity ='0' THEN  uap.package_id WHEN  DATEDIFF( NOW(), uap.date_added  ) <   uap.validity THEN uap.package_id  ELSE 0 END   as active_package , DATEDIFF( NOW(), uap.date_added  ) as date_diff ";
		  
		 $criteria->params[':me'] = (int) Yii::app()->user->getId();
		 * */
		 return $this->findAll($criteria);
	}
	
	public function userActivePackage($id,$user_id  ){
		 
		$criteria=new CDbCriteria;
		 $criteria->condition = "t.isTrash='0' and t.status='A' and category=:id";
		 $criteria->join  = "INNER JOIN {{user_packages}} uap on uap.category_id = t.category and uap.user_id =:me and uap.latest='1' and uap.status='active' and t.package_id = uap.package_id ";
		 $criteria->order = "t.price_per_month asc ";
		 $criteria->select = "uap.validity as uap_validity,uap.id as uap_id, uap.ads_allowed ,uap.used_ad , DATEDIFF( NOW(), uap.date_added  ) as date_diff, CASE WHEN uap.validity ='0' THEN  uap.package_id WHEN  DATEDIFF( NOW(), uap.date_added  ) <   uap.validity THEN uap.package_id  ELSE 0 END   as active_package  ";
		  $criteria->condition .= ' and (CASE WHEN uap.validity = "0" THEN  uap.package_id WHEN  DATEDIFF( NOW(), uap.date_added  ) <   uap.validity THEN uap.package_id  ELSE 0 END ) >= 1'; 
		 $criteria->params[':id'] = (int)$id;
		 $criteria->params[':me'] = (int)$user_id;
		 return Package::model()->find($criteria);
	}
	
	
	
	
	
 	public function  defaultPakcage()
    {
		 
		 $criteria=new CDbCriteria;
		 $criteria->condition = "t.isTrash='0' and t.status='A' and package_id=:id";
	 	 $criteria->select = "t.max_listing_per_day";
		 $criteria->params[':id'] = Yii::app()->options->get('system.common.default_ad_package','10');
		 return $this->find($criteria);
	}
	public function  fetchPackage($id)
    {
		 $criteria=new CDbCriteria;
		 $criteria->condition = "t.isTrash='0' and t.status='A' and package_id=:id";
		 $criteria->params[':id'] =(int) $id;
		 return $this->find($criteria);
	}
	public function getstatusTitle(){
	 switch($this->status){
        case 'A' : 
        return 'Active';
        break;
        default: 
        return 'Inactive';
        break;
	 }
	}
	public function getValidityTitle(){
		$ar = $this->getListingPackageMonthly();
		return isset($ar[$this->validity_in_days]) ? $ar[$this->validity_in_days] : '';
	}
	public function getListingPackageMonthly(){
		$nmonths = $this->mTag()->getTag('{n}_months','{n} Months');
		return array(
			'0'=> $this->mTag()->getTag('unlimited','Unlimited'),
			'30'=> Yii::t('app', $this->mTag()->getTag('{n}_month','{n} Month'),array('{n}'=>'1')),
			'90'=> Yii::t('app',$nmonths,array('{n}'=>'3')),
			'180'=>Yii::t('app',$nmonths,array('{n}'=>'6')),
			'270'=> Yii::t('app',$nmonths,array('{n}'=>'9')),
			'360'=> Yii::t('app',$nmonths,array('{n}'=>'12')),
			'720'=> Yii::t('app',$nmonths,array('{n}'=>'24')),
			'1080'=> Yii::t('app',$nmonths,array('{n}'=>'36')),
		);
	}
    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Package the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    public function tag_Array(){
		return array(
		''=>'no tag',
		'1'=>'Most Popular',
		'2'=>'Economy',
		'3'=>'Elite',
		);
	}
}
