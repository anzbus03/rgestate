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
class FooterLinks extends  ActiveRecord
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
            array('parent_master,title', 'required'),
            array('master_name', 'length', 'max'=>250),
            array('f_type', 'length', 'max'=>10),
            array('status, is_trash', 'length', 'max'=>1),
            array('parent_master', 'safe'),
            array('master_name', 'validateMaster'),
            array('master_array,master_generated', 'safe'),
          //  array('master_name', 'validateMaster'),
            //array('master_name', 'url'),
            array('title', 'length', 'max'=>150),
            array('section_id,listing_type,category_id,country,state,city', 'safe' ),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('master_id, master_name, f_type, status, is_trash, last_updated', 'safe', 'on'=>'search'),
        );
    }
    
    public function  validatefieldsArray(){
		 return array('section_id','listing_type','category_id','country','state','city');
	 }
    public function  createUrlMaster($ar){
		 if(!empty($ar)){
		$url = 'listing/index/';
		foreach($ar  as $k=>$v) 
		 switch($k){
			case 'section_id':
			 $model =  Section::model()->findByPk($v);
			 if($model){
				$url .= 'sec/'.$model->slug.'/';
			 }
			 break;
			case 'listing_type':
			 $url .= 'listing_type/'.$v.'/';;
			 break;
			case 'category_id':
			  $url .= 'type_of[]/'.$v.'/';
			 break;
			case 'state':
			  $model =  States::model()->findByPk($v);
			 if($model){
				$url .= 'state/'.$model->slug.'/';
			 }
			 break;
			case  'city':
			 $url .= 'locations[]/'.$v.'/';
			 break;
		 }
		 return  $url;
	 }
	 }
	public function validateMaster($attribute,$params){
			if( empty($this->master_name)){
				$ar = $this->validatefieldsArray();
				$validatedd = false; 
				foreach($ar as $k ){
					if(!empty($this->$k)){
						$validatedd = true; 
					}
				}
				if(!$validatedd){
				$this->addError($attribute,  Yii::t('app','Please select field values .',array('{attribute}'=>$this->getAttributeLabel($attribute))));
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
            'master_name' => 'URL',
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
        $criteria->compare('t.f_type','FL');
        $criteria->compare('t.master_name',$this->master_name,true);
        $criteria->compare('t.title',$this->title,true);
        $criteria->compare('t.category_id',$this->category_id);
        $criteria->compare('t.status',$this->status,true);
        $criteria->compare('t.is_trash',0);
        $criteria->compare('t.last_updated',$this->last_updated,true);
 $criteria->order = 't.master_id desc';
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
             'pagination'    => array(
                'pageSize'  => $this->paginationOptions->getPageSize(),
                'pageVar'   => 'page',
            ),
        ));
    }
    public $section_id;
    public $listing_type;
    public $category_id;
    public $country;
    public $state;
    public $city;
    public function  createUrlMasterLive($ar){
		 if(!empty($ar)){
		$url = 'listing/index';$url1 = array();
		$listing = ''; 
		foreach($ar  as $k=>$v) 
		 switch($k){
			case 'section_id':
			 $model =  Section::model()->findByPk($v);
			 if($model){
				switch($v){
					case '1':
					$url1['sec'] =  'for-sale';
					break;
					case '2':
					$url1['sec'] =  'for-rent';
					break;
					default:
					$url1['sec'] =  $model->slug ;
					break;
				
				}
			 }
			 break;
			case 'listing_type':
			 $model =  Category::model()->findByPk($v);
			 if($model){
			$url1['type_of'] =  $model->slug ;  
			 }
			 break;
			case 'category_id':
			$model =  Category::model()->findByPk($v);
			if($model){
				if(isset($url1['type_of'])){
					$url1['type_of'] =  $url1['type_of'].'_'.$model->slug ;  
				}else{
					$url1['type_of'] =  'residential_'. $model->slug ;  
				}
			}
			 break;
			case 'state':
			  $model =  States::model()->findByPk($v);
			 if($model){
				$url1['state'] =  $model->slug ;
			 }
			 break;
			 
		 }
		 if(!isset($url1['state'])){
			 $url1['state'] = 'all' ;
		 }
		 if(!isset($url1['sec'])){
			 $url1['sec'] = 'for-sale-and-rent' ;
		 }
		 if(!isset($url1['type_of'])){
			 $url1['type_of'] = 'property-' ;
		 }
		 if(defined('LANGUAGE') and defined('COUNTRY_SLUG')){
		 $replace =      LANGUAGE.'/'.COUNTRY_SLUG.'/' ; 
		 return  Yii::t('app',Yii::app()->createUrl($url,$url1),array( $replace=>''));
		 }
	 }
	 }
    public function generateLink($parent_id)
    {
        // @todo Please modify the following code to remove attributes that should not be searched.
//echo CHTml::link('lahore',Yii::App()->createUrl('listing/index/sec/property-for-sale',array('type_of[]'=>'114','state'=>'lahore')));
        $criteria=new CDbCriteria;

        $criteria->select = 't.*';
        $criteria->compare('t.parent_master',(int)$parent_id);
        $criteria->compare('t.status','A');
        $criteria->compare('t.is_trash',0);
         $criteria->compare('t.f_type','FL');
        $criteria->compare('t.last_updated',$this->last_updated,true);
		 $idModel  = self::model()->findAll( $criteria);
		 $ar_return = array(); 
		 if($idModel){
			 foreach($idModel as $k=>$v){
				 if(!empty($v->master_name)){
					 $url = Yii::app()->createUrl($v->master_name);
				 }
				 else{
					  $url = Yii::app()->createUrl($v->master_generated);
				 }
				 $ar_return[] = array('title'=>$v->title,'url'=>$url);
			 }
		 }
		 return $ar_return;
    }
    public function getMasterUrl(){
		if(!empty($this->master_name)){
					 $url = Yii::app()->createUrl($this->master_name);
				 }
				 else{
					  $url = Yii::app()->createUrl($this->master_generated);
				 }
				 return $url ; 
	}
    public function getMasterFullLink(){
		return $this->master_name.' - '.$this->parent_name; 
	}
    public function findFooterLinksSubcategory()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;

        $criteria->select = 't.*';
       // $criteria->join .= ' LEFT JOIN {{master}} mp ON mp.master_id = t.parent_master ';
        //  $criteria->join .= ' LEFT JOIN {{master}} mp ON mp.master_id = t.parent_master ';
       //  $criteria->join = ' LEFT JOIN {{master_category}} mc ON mc.category_id = t.category_id ';
     
        
       // $criteria->join = ' LEFT JOIN {{master_category}} mc ON mc.category_id = mp.category_id ';
        $criteria->compare('t.category_id','1');
        
		$ar =  self::model()->findAll($criteria);
		$return_array = array();
		if(!empty($ar)){
			foreach($ar as $k=>$v){
				$return_array[$v->master_id] = $v->master_name;
			}
		}
 
		return $return_array;
    }
    public function generateFooterLinksView($re=0)
    {
		
		if($re=='1'){
			$cacheKey =  'custom_field_typeds2211111221111111'.time().Yii::app()->options->get('system.common.footer_updation','234');
		}else{
		$cacheKey =  'custom_field_typeds221111122112111'.Yii::app()->options->get('system.common.footer_updation','234');
		}
		if(defined('COUNTRY_ID')){ $cacheKey .=	COUNTRY_ID;	}
		if(defined('LANGUAGE')){$cacheKey .= LANGUAGE .'ln';   }
		if ($items = Yii::app()->cache->get($cacheKey)) {
			 return $items;
		}
		
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;
		$criteria->condition = '1'; 
        $criteria->select = 't.*';
        $criteria->join .= ' INNER JOIN {{master}} mp ON mp.master_id = t.parent_master and mp.status ="A"';
        //  $criteria->join .= ' LEFT JOIN {{master}} mp ON mp.master_id = t.parent_master ';
       //  $criteria->join = ' LEFT JOIN {{master_category}} mc ON mc.category_id = t.category_id ';
     
        if(defined('COUNTRY_ID')){  
			
				$criteria->join .= ' LEFT  JOIN {{states}} st ON st.state_id  = t.state ' ;
				$criteria->condition .= ' and CASE WHEN t.state is NULL THEN 1 ELSE st.country_id = :COUNTRY END'; 
				$criteria->params[':COUNTRY'] = COUNTRY_ID; 
			
				}
				
		if(defined('LANGUAGE') and LANGUAGE != 'en'){ 
			$criteria->params[':lan'] = LANGUAGE;
			
			$criteria->distinct = 't.master_id'; 
			
			$criteria->join  .= ' left join `mw_translate_relation` `translationRelation` on translationRelation.master_id = t.parent_master   LEFT  JOIN mw_translation_data tdata ON (`translationRelation`.translate_id=tdata.translation_id and tdata.lang=:lan) ';
			$criteria->select .= ' ,CASE WHEN tdata.message IS NOT NULL THEN    tdata.message ELSE mp.master_name    END  AS parent_name ';
			
			$criteria->join  .= ' left join `mw_translate_relation` `translationRelation1` on translationRelation1.master_id = t.master_id   LEFT  JOIN mw_translation_data tdata1 ON (`translationRelation1`.translate_id=tdata1.translation_id and tdata1.lang=:lan) ';
			$criteria->select .= ' ,CASE WHEN tdata1.message IS NOT NULL THEN    tdata1.message ELSE t.title    END  AS title ';

			
			}
			else{
				$criteria->select .= ' ,mp.master_name as parent_name';
			}		
				
       // $criteria->join = ' LEFT JOIN {{master_category}} mc ON mc.category_id = mp.category_id ';
        $criteria->compare('t.f_type','FL');
        $criteria->order = '-mp.priority desc,-t.priority desc';
        
		$ar =  self::model()->findAll($criteria);
		
		
		 $return_array = array();
		if(!empty($ar)){
			foreach($ar as $k=>$v){
				
				 if(!empty($v->master_name)){
					 $url = Yii::app()->createUrl($v->master_name);
				 }
				 else{
					  if($re=='1'){
					  $url = $v->createUrlMasterLive(json_decode($v->master_array));
					 FooterLinks::model()->updateByPk($v->primaryKey,array('master_generated'=>$url));
					 }else{
						  $url =   $v->master_generated ;
					 }
				 }
				 
				$return_array[$v->parent_name][$v->master_id] = array('title'=>$v->title,'links'=> $url);
			}
		}
		
		 
		
		$items = $return_array;
		Yii::app()->cache->set($cacheKey, $items,60 * 60 * 24 * 360  );
		return $return_array; 
		 
    }
	public function beforeSave(){
		parent::beforeSave();
		if(empty($this->master_name)){
			$ar = $this->validatefieldsArray();
			$ar_values = array();
			foreach($ar as $k){
				$ar_values[$k] = $this->$k;
			}
			$ar = (array)array_filter($ar_values);
			$this->master_array = json_encode($ar);
			$this->master_generated = $this->createUrlMaster($ar);
			$this->master_name = null; 
		}
		else{
			$this->master_array = null; 
			$this->master_generated = null; 
		}
		$this->category_id =  NULL;
		$this->f_type = 'FL';
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
