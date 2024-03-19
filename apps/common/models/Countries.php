<?php

/**
 * This is the model class for table "mw_countries".
 *
 * The followings are the available columns in table 'mw_countries':
 * @property integer $country_id
 * @property string $country_name
 * @property string $country_code
 * @property integer $isTrash
 */
class Countries extends ActiveRecord
{
	 
    /**
     * @return string the associated database table name
     */
    public $location ; 
    public $code ; 
    public function tableName()
    {
        return '{{countries}}';
    }
	protected function afterValidate()
    {
        parent::afterValidate();
        $this->handleUploadedAvatar();
    }
    public function getPrimaryField(){
		 return 'country_id';
	 }
    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        $email_logorMimes = null;
        if (CommonHelper::functionExists('finfo_open')) {
          //  $email_logorMimes = Yii::app()->extensionMimes->get(array('png', 'jpg', 'gif'))->toArray();
        }
        return array(
            array('country_name,cords', 'required'),
            array('isTrash', 'numerical', 'integerOnly'=>true),
            array('country_name', 'length', 'max'=>250),
            array('cords', 'length', 'max'=>2),
            array('country_code', 'length', 'max'=>5),
            array('show_on_listing', 'length', 'max'=>1),
            array('enable_all_cities', 'length', 'max'=>1),
            array('default_currency', 'length', 'max'=>11),
            array('slug', 'length', 'max'=>250),
            array('footer_links,popular_links_sale,popular_links_rent', 'safe'),
             array('flag', 'file', 'types' => array('png', 'jpg', 'gif'),   'allowEmpty' => true),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('country_id, country_name, country_code, isTrash,image,cords', 'safe', 'on'=>'search'),
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
          'statelist'=>array(self::HAS_MANY, 'States', 'country_id','on'=>'statelist.isTrash=0'),
          'currency'=>array(self::BELONGS_TO, 'Currency', 'default_currency' ),
          
        );
    }
     protected function handleUploadedAvatar()
    {
        if ($this->hasErrors()) {
            return;
        }
      

        if (!($avatar = CUploadedFile::getInstance($this, 'flag'))) {
            return;
        }
 
        $storagePath = Yii::getPathOfAlias('root.uploads.logo');
        if (!file_exists($storagePath) || !is_dir($storagePath)) {
            if (!@mkdir($storagePath, 0777, true)) {
                $this->addError('flag', Yii::t('users', 'The logo storage directory({path}) does not exists and cannot be created!', array(
                    '{path}' => $storagePath,
                )));
                return;
            }
        }

        $newAvatarName = uniqid(rand(0, time())) . '-' . $avatar->getName();
        if (!$avatar->saveAs($storagePath . '/' . $newAvatarName)) {
            $this->addError('flag', Yii::t('users', 'Cannot move the avatar into the correct storage folder!'));
            return;
        }

        $this->flag = '/uploads/logo/' . $newAvatarName;
    }
   public function behaviors(){
    return array_merge(parent::behaviors(),array(
        'SlugBehavior' => array(
            'class' => 'common.models.SlugBehavior.SlugBehavior',
            'slug_col' => 'slug',
            'title_col' => 'country_name',
            'overwrite' => true
        ))
    );
   }
    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'country_id' => 'Country',
            'country_name' => 'Country Name',
            'cords' => 'Country Short  Code [ISO2]',
            'country_code' => 'Country Code',
            'isTrash' => 'Is Trash',
        );
    }
  public function getGravatarUrl($width = 50, $height = 50, $forceSize = false)
    {
	 
         if (empty($this->flag)) {
            return  false;
         }
         return ImageHelper::resize($this->flag, $width, $height, $forceSize);
 }
  public function getGravatarUrlFromCookie($width = 50, $height = 50, $forceSize = false)
    {
	  
         if (empty($this->defaultFlag)) {
            return  false;
         }
         return ltrim($this->defaultFlag,'/');
         //return ImageHelper::resize($this->defaultFlag, $width, $height, $forceSize);
 }
  public function getDefaultCountry()
  {
	 
			 if(   Yii::app()->request->cookies['country_id'] !=""  and   Yii::app()->request->cookies['country_name'] !="" ){
				 return Yii::app()->request->cookies['country_name'] ;
			 }
			 else{
				 
				$country =  self::model()->findByPk(Yii::app()->options->get('system.common.default_country',65946));
				if(!empty($country)){
					$cookie = new CHttpCookie('country_name', $country->country_name);
					$cookie->expire = time()+60*60*24*180; 
					Yii::app()->request->cookies['country_name'] = $cookie;
					
					$cookie = new CHttpCookie('country_id', $country->country_id);
					$cookie->expire = time()+60*60*24*180; 
					Yii::app()->request->cookies['country_id'] = $cookie;
					$cookie = new CHttpCookie('flag', $country->flag);
					$cookie->expire = time()+60*60*24*180; 
					Yii::app()->request->cookies['flag'] = $cookie;
				}
				return $country->country_name;
				}
 }
 
  public function getDefaultCountryId()
  {
			 if( Yii::app()->request->cookies['country_id'] !=""  and   Yii::app()->request->cookies['country_name'] != "" ){
				 return Yii::app()->request->cookies['country_id'] ;
			 }
			 else{
				 
				$country =  self::model()->findByPk(Yii::app()->options->get('system.common.default_country',65946));
				if(!empty($country)){
					$cookie = new CHttpCookie('country_name', $country->country_name);
					$cookie->expire = time()+60*60*24*180; 
					Yii::app()->request->cookies['country_name'] = $cookie;
					
					$cookie = new CHttpCookie('country_id', $country->country_id);
					$cookie->expire = time()+60*60*24*180; 
					Yii::app()->request->cookies['country_id'] = $cookie;
					$cookie = new CHttpCookie('flag', $country->flag);
					$cookie->expire = time()+60*60*24*180; 
					Yii::app()->request->cookies['flag'] = $cookie;
				}
				return $country->country_id;
				}
 }
  public function getDefaultFlag()
  {
			 if(Yii::app()->request->cookies['flag'] !="" ){
				 return Yii::app()->request->cookies['flag'] ;
			 }
			  return false;
	 
	  
 }
   public function getShow_on_listingHtml(){
	   
	  return CHtml::CheckBox('update_listing',($this->show_on_listing=='1')? true : false, array ( 'onChange'=>'return ChangeListing(this)' , 'value'=> $this->country_id ));
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
     public $currency_name;
     const DREFUALT_CURRENCY = 'USD'; 
     public function  getDefaultCurrencyTitle(){
		 return  !empty($this->currency_name) ? $this->currency_name : self::DREFUALT_CURRENCY ;  
	 }
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;

        $criteria->select  = 't.*,currency.name as currency_name ';
        $criteria->join  = 'left join {{currency}} currency  on currency.currency_id = t.default_currency ';
        $criteria->compare('country_id',$this->country_id);
        $criteria->compare('country_name',$this->country_name,true);
        $criteria->compare('country_code',$this->country_code,true);
        $criteria->compare('isTrash',$this->isTrash);
        $criteria->order = "show_on_listing=1,-t.priority desc , country_name" ;
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
     * @return Countries the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    public function Countrylist2()
    {
		  $criteria=new CDbCriteria;
		  $criteria->condition="isTrash='0'  and  show_on_listing='1'";
		  $criteria->order="t.country_name";
		  //$criteria->select="country_id,country_name";
		  return $this->findAll($criteria);
		
	}
    public function Countrylist()
    {
		  $criteria=new CDbCriteria;
		  $criteria->condition="isTrash='0'";
		  $criteria->order="t.country_name";
		  //$criteria->select="country_id,country_name";
		  return $this->findAll($criteria);
		
	}
    public function CountrylistFromCookie()
    {
		  $criteria=new CDbCriteria;
		  if(Yii::app()->request->cookies['country'])
		  {
			  $criteria->condition="isTrash='0' and country_id!=:para";
			  $criteria->params[":para"] = Yii::app()->request->cookies['country'];
		  }
		  else
		  {
			  $criteria->condition="isTrash='0'";
		  }
		  
		 // $criteria->select="country_id,country_name";
		  return $this->findAll($criteria);
		
	}
	 public function getCountryByclass($country)
    {
		  $criteria=new CDbCriteria;
		  $criteria->condition="isTrash='0' and image=:params";
		  $criteria->params[":params"] =$country;
		 // $criteria->select="country_id,country_name";
		  return $this->find($criteria);
		
	}
		 public function getCountryFromCookie()
    {
		  $criteria=new CDbCriteria;
		  $criteria->condition="isTrash='0' and country_id=:params";
		  $criteria->params[":params"] = Yii::app()->request->cookies['country'];
		 // $criteria->select="country_id,country_name";
		  return $this->find($criteria);
		
	}
	 function getCountry_1()
	{
		 static $_options = array();
		 
		 $r= $this->findAll(array("condition"=>"isTrash='0' " ,"order"=>"country_name"));
	 
		 if($r)
		 {
			 foreach($r as $k=>$v)
			 {
				  $_options[$v->country_id] =  $v->country_name; 
			 }
	     }
	     return $_options;
		 
	}
   	public function getStateWithCountry()
	{
		$criteria=new CDbCriteria;
		$criteria->with =array("statelist","statelist.hotelCount"=>array("condition"=>"t.isTrash='0' and t.status='A'"));
		$criteria->condition="t.isTrash=0";
		$criteria->order = "t.country_name";
		$ar =  $this->findAll($criteria);
		$listarray =array();
		 if($ar)
		 {
			 foreach ($ar as $k=>$v)
			 {
				 if($v->statelist)
				 {
					  
					 foreach($v->statelist as $k1=>$v1)
					 {
						  $listarray[$v->country_id.':'.$v1->state_id] = $v->country_name.','.$v1->state_name."(".$v1->hotelCount.")";
					 }
				
			     }
			     else
			     {
					  $listarray[$v->country_id.':0']  = $v->country_name."(0)";
				 }
		      }
		  }
		  return  $listarray;
		 
	}
	public function  ListDataForJSON()
    {
		 $criteria=new CDbCriteria;
		 $criteria->condition = "t.isTrash='0' and  show_on_listing='1'";
		 $criteria->select ="country_id,country_name";
		 $criteria->order="country_name";
		 $arra =  $this->findAll($criteria);
		 $ar =array();
		 if($arra)
		 {
			 foreach($arra as $k=>$v)
			 {
				 $ar[]= array("id"=>$v->country_id , "name" => $v->country_name );
			 }
		 }
	  return CJSON::encode(array_merge(array("0"=>"Select Country"), $ar));
	}
 
	public function  countriesOtherThanDefault()
    {
		 $criteria=new CDbCriteria;
		 $criteria->condition = "t.isTrash='0' and  show_on_listing='1' and t.country_id !=:default";
		 $criteria->select ="country_id,country_name,flag";
		 $criteria->order="country_name";
		 $criteria->params= array(':default'=>$this->defaultCountryId);
		 return  $this->findAll($criteria);
		 
	}
	public $currency_code;
	public $base_rate;
	public function listingCountries(){
			$criteria = new CDbCriteria();
			$criteria->select= 't.country_id,priority,enable_all_cities,show_region,slug,cords,cur.code as currency_code,cur.base_rate';
			$criteria->join .= ' INNER JOIN {{currency}} cur on cur.currency_id = t.default_currency ';
			$criteria->compare('t.show_on_listing','1');
			$criteria->compare('t.isTrash','0');
			if(defined('LANGUAGE') and LANGUAGE != 'en'){ 
	    	$criteria->params[':lan'] = LANGUAGE;
			$criteria->distinct = 't.country_id'; 
			$criteria->join  .= ' left join `mw_translate` `translate` on (  translate.source_tag = concat("Countries_country_name_",t.country_id) )   left join `mw_translate_relation` `translationRelation` on translationRelation.country_id = t.country_id  and  translationRelation.translate_id = translate.translate_id  LEFT  JOIN mw_translation_data tdata ON (`translationRelation`.translate_id=tdata.translation_id and tdata.lang=:lan) ';
			$criteria->select .= ' ,CASE WHEN tdata.message IS NOT NULL THEN    tdata.message ELSE t.country_name END  AS country_name ';
			}
			else{
				$criteria->select .= ' ,t.country_name';
			}
			$criteria->order = '-t.priority desc , country_name asc';
			return self::model()->findAll($criteria);
	}
	
	public    function cacheListingCountries()
    {
		 
		$cacheKey =  'custom_field_typed12'.Yii::app()->options->get('system.common.country_cache','12');
		if(defined('LANGUAGE')){$cacheKey .= LANGUAGE ;   }
		if ($items = Yii::app()->cache->get($cacheKey)) {
			  
			 return $items;
		}
		$items = $this->listingCountries();
		Yii::app()->cache->set($cacheKey, $items,60 * 60 * 24 * 360  );
		return $items; 
	}
 
 public   function list_array_country(){
	 $countries = $this->cacheListingCountries();
	 $items = array(); 
	 foreach($countries as $k=>$v){
		 $items[$v->country_id] = array('slug'=>$v->slug,'country_id'=>$v->country_id,'country_name'=>$v->country_name,'code'=>$v->cords,'currency_code'=>$v->currency_code,'base_rate'=>$v->base_rate);
	 }
	 return $items;
	 
 }
 public   function list_array_country2(){
	 $countries = $this->cacheListingCountries();
	 $items = array();
	 foreach($countries as $k=>$v){
		 $items[] = array('slug'=>$v->slug,'country_id'=>$v->country_id,'country_name'=>$v->country_name);
	 }
	 return $items;
	 
 }
	public function  checkEnableForlisting($country)
    { 
		$criteria=new CDbCriteria;
		$criteria->select = 't.country_id,t.country_name,t.slug';
		$criteria->condition = ' t.slug = :slug and t.show_on_listing="1" and t.isTrash="0"  ';
		$criteria->params[':slug'] = $country ;
		return self::model()->find($criteria);
	}
	public function  getCountryWithShortCode()
    { 	 if(!empty($this->cords)){
		 return $this->country_name .' ('.$this->cords.')';
		 }
		 return $this->country_name ;
	}
	public function  getCountryWithShortCodeFlag()
    { 	 if(!empty($this->cords)){
		 $country =  $this->country_name .' ('.$this->cords.')';		 
		 }
		 else{
		 $country =  $this->country_name ;
		 }
		 if(!empty($this->cords)){
			 $flag = Yii::App()->apps->getBaseUrl('assets/flags/'.strtolower($this->cords).'.svg');
		 }
		 else {
			  $flag = Yii::App()->apps->getBaseUrl('assets/flags/blank.svg');
		 }
		 $name = $country.'<img src="'.$flag.'" width="20px" />';
		 return $name;
	}
		public function  ListData()
    {
		 $criteria=new CDbCriteria;
		 $criteria->condition = "t.isTrash='0' and  show_on_listing='1'";
		 $criteria->select ="country_id,country_name";
		 $criteria->order="country_name";
		 $arra =  $this->findAll($criteria);
		 $ar =array();
		 if($arra)
		 {
			 foreach($arra as $k=>$v)
			 {
				 $ar[$v->country_id]=   $v->country_name  ;
			 }
		 }
	  return  $ar  ;
	}
	public function  ListDataForJSON2()
    {
		 $criteria=new CDbCriteria;
		 $criteria->condition = "t.isTrash='0' and  show_on_listing='1'";
		 $criteria->select ="country_id,country_name";
		 $criteria->order="country_name";
		 $arra =  $this->findAll($criteria);
		 $ar =array();
		 if($arra)
		 {
			 foreach($arra as $k=>$v)
			 {
				 $ar[]= array("id"=>$v->country_id , "name" => $v->country_name );
			 }
		 }
	  return  $ar  ;
	}
	public function defaultInternetCountry($code=null){
			if(Yii::app()->request->cookies['internet_country_default'] !=""  and   Yii::app()->request->cookies['internet_country_default'] !="" ){
			 
				 return Yii::app()->request->cookies['internet_country_default'] ;
			 }
			 else{
				$criteria=new CDbCriteria;
				$criteria->select= 't.country_name,t.slug,cords';
				$criteria->compare('t.show_on_listing','1');
				$criteria->compare('t.isTrash','0');
				$criteria->order = 't.cords="'.$code.'" desc , -t.priority desc , country_name asc';
				$defaultCountryModel = Countries::model()->find($criteria);
				$default_c = !empty($defaultCountryModel) ? $defaultCountryModel->slug : '' ; 
				$cookie = new CHttpCookie('internet_country_default', $default_c);
				$cookie->expire = time()+60*60*24; 
				Yii::app()->request->cookies['internet_country_default'] = $cookie;
				return $default_c;
			}
	}
	public function  ListDataN()
    {
		 $criteria=new CDbCriteria;
		 $criteria->condition = "t.isTrash='0' and t.cords !='' ";
		 $criteria->select ="country_id,country_name,cords";
		 $criteria->order="country_name";
		 $arra =  $this->findAll($criteria);
		 $ar =array();
		 if($arra)
		 {
			 foreach($arra as $k=>$v)
			 {
				if(!empty($v->cords)){
				$flag = Yii::App()->apps->getBaseUrl('assets/flags/'.strtolower($v->cords).'.svg',true);
				}
				else {
				$flag = Yii::App()->apps->getBaseUrl('assets/flags/blank.svg',true);
				}
				 $ar[]= array("id"=>$v->country_id , "name" => $v->country_name ,'flag' => $flag  );
			 }
		 }
	  return  $ar  ;
	}
	public function listingCountriesNew($offset=0,$limit=5){
			$criteria = new CDbCriteria();
			$criteria->select= 't.country_name,t.country_id,priority,enable_all_cities,show_region,slug,cords';
			$criteria->compare('t.show_on_listing','1');
			$criteria->compare('t.isTrash','0');
			$criteria->offset = $offset;
			$criteria->limit = $limit;
			$criteria->order = '-t.priority desc , country_name asc';
			$countries  =  self::model()->findAll($criteria);
			
			$items = array();
			foreach($countries as $k=>$v){
				$items[] = array('slug'=>$v->slug,'country_id'=>$v->country_id,'country_name'=>$v->country_name);
			}
			return $items;
	}
	protected function afterConstruct()
    {
		
        $this->fieldDecorator->onHtmlOptionsSetup = array($this, '_setDefaultEditorForContent');
        parent::afterConstruct();
    }
    
    protected function afterFind()
    {
		//$this->content = Yii::app()->ioFilter->purify($this->content);
        $this->fieldDecorator->onHtmlOptionsSetup = array($this, '_setDefaultEditorForContent');
        parent::afterFind();
    }
     public function _setDefaultEditorForContent(CEvent $event)
    {
        if ($event->params['attribute'] == 'footer_links') {
            $options = array();
            if ($event->params['htmlOptions']->contains('wysiwyg_editor_options')) {
                $options = (array)$event->params['htmlOptions']->itemAt('wysiwyg_editor_options');
            }
            $options['id'] = CHtml::activeId($this, 'footer_links');
            $event->params['htmlOptions']->add('wysiwyg_editor_options', $options);
        }
        if ($event->params['attribute'] == 'popular_links_sale') {
            $options = array();
            if ($event->params['htmlOptions']->contains('wysiwyg_editor_options')) {
                $options = (array)$event->params['htmlOptions']->itemAt('wysiwyg_editor_options');
            }
            $options['id'] = CHtml::activeId($this, 'popular_links_sale');
            $event->params['htmlOptions']->add('wysiwyg_editor_options', $options);
        }
        if ($event->params['attribute'] == 'popular_links_rent') {
            $options = array();
            if ($event->params['htmlOptions']->contains('wysiwyg_editor_options')) {
                $options = (array)$event->params['htmlOptions']->itemAt('wysiwyg_editor_options');
            }
            $options['id'] = CHtml::activeId($this, 'popular_links_rent');
            $event->params['htmlOptions']->add('wysiwyg_editor_options', $options);
        }
    }
    public    function footerLinkdb()
    {
		 if(defined('COUNTRY_ID')){
			$cacheKey =  'custom_field_typed1-footer111'.COUNTRY_ID.Yii::app()->options->get('system.common.country_cache','12');
			if(defined('LANGUAGE')){$cacheKey .= LANGUAGE ;   }
			if ($items = Yii::app()->cache->get($cacheKey)) {
				  
				 return $items;
			}
			$criteria = new CDbCriteria();
			$criteria->compare('t.country_id',COUNTRY_ID);
			$criteria->compare('t.isTrash','0');
			if(defined('LANGUAGE') and LANGUAGE != 'en'){ 
				$criteria->params[':lan'] = LANGUAGE;
				$criteria->distinct = 't.country_id'; 
				$criteria->join  .= ' left join `mw_translate` `translate` on (  translate.source_tag = concat("Countries_footer_links_",t.country_id) )   left join `mw_translate_relation` `translationRelation` on translationRelation.country_id = t.country_id  and  translationRelation.translate_id = translate.translate_id  LEFT  JOIN mw_translation_data tdata ON (`translationRelation`.translate_id=tdata.translation_id and tdata.lang=:lan) ';
				$criteria->select = 'CASE WHEN tdata.message IS NOT NULL THEN    tdata.message ELSE t.footer_links END  AS footer_links ';
			}
			else{
				$criteria->select = '  t.footer_links';
			}
			$result = self::model()->find($criteria);
			$items = $result->footer_links;
			Yii::app()->cache->set($cacheKey, $items,60 * 60 * 24 * 360  );
			return $items; 
		}
	}
	public    function saleLeftLinkdb()
    {
		 if(defined('COUNTRY_ID')){
			$cacheKey =  'custom_field_typed1-footer1-sale-left'.Yii::app()->options->get('system.common.country_cache','12');
			if(defined('LANGUAGE')){$cacheKey .= LANGUAGE ;   }
			if ($items = Yii::app()->cache->get($cacheKey)) {
				  
				 return $items;
			}
			$criteria = new CDbCriteria();
			$criteria->compare('t.country_id',COUNTRY_ID);
			$criteria->compare('t.isTrash','0');
			if(defined('LANGUAGE') and LANGUAGE != 'en'){ 
				$criteria->params[':lan'] = LANGUAGE;
				$criteria->distinct = 't.country_id'; 
				$criteria->join  .= ' left join `mw_translate` `translate` on (  translate.source_tag = concat("Countries_popular_links_sale_",t.country_id) )   left join `mw_translate_relation` `translationRelation` on translationRelation.country_id = t.country_id  and  translationRelation.translate_id = translate.translate_id  LEFT  JOIN mw_translation_data tdata ON (`translationRelation`.translate_id=tdata.translation_id and tdata.lang=:lan) ';
				$criteria->select = 'CASE WHEN tdata.message IS NOT NULL THEN    tdata.message ELSE t.popular_links_sale END  AS popular_links_sale ';
			}
			else{
				$criteria->select = '  t.popular_links_sale';
			}
			$result = self::model()->find($criteria);
			$items = $result->popular_links_sale;
			Yii::app()->cache->set($cacheKey, $items,60 * 60 * 24 * 360  );
			return $items; 
		}
	}
	public    function rentLeftLinkdb()
    {
		 if(defined('COUNTRY_ID')){
			$cacheKey =  'custom_field_typed1-footer1-rent'.Yii::app()->options->get('system.common.country_cache','12');
			if(defined('LANGUAGE')){$cacheKey .= LANGUAGE ;   }
			if ($items = Yii::app()->cache->get($cacheKey)) {
				  
				 return $items;
			}
			$criteria = new CDbCriteria();
			$criteria->compare('t.country_id',COUNTRY_ID);
			$criteria->compare('t.isTrash','0');
			if(defined('LANGUAGE') and LANGUAGE != 'en'){ 
				$criteria->params[':lan'] = LANGUAGE;
				$criteria->distinct = 't.country_id'; 
				$criteria->join  .= ' left join `mw_translate` `translate` on (  translate.source_tag = concat("Countries_popular_links_rent_",t.country_id) )   left join `mw_translate_relation` `translationRelation` on translationRelation.country_id = t.country_id  and  translationRelation.translate_id = translate.translate_id  LEFT  JOIN mw_translation_data tdata ON (`translationRelation`.translate_id=tdata.translation_id and tdata.lang=:lan) ';
				$criteria->select = 'CASE WHEN tdata.message IS NOT NULL THEN    tdata.message ELSE t.popular_links_rent END  AS popular_links_rent ';
			}
			else{
				$criteria->select = '  t.popular_links_rent';
			}
			$result = self::model()->find($criteria);
			$items = $result->popular_links_rent;
			Yii::app()->cache->set($cacheKey, $items,60 * 60 * 24 * 360  );
			return $items; 
		}
	}
}
