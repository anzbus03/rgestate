<?php

/**
 * This is the model class for table "mw_states".
 *
 * The followings are the available columns in table 'mw_states':
 * @property integer $state_id
 * @property integer $country_id
 * @property string $state_name
 * @property integer $isTrash
 */
class States extends ActiveRecord
{
	public $location;public $mul_city;
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{states}}';
    }
    public $region_name;
    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('country_id, state_name', 'required','on'=>'insert,update'),
            array('country_id,mul_city', 'required', 'on'=>'mul_city'),
               array('region_id', 'safe'),
            array('mul_city', 'safe', 'on'=>'insert'),
            array('country_id, isTrash', 'numerical', 'integerOnly'=>true),
            array('state_name,icon,p_name', 'length', 'max'=>250),
             array('icon', 'file', 'types'=>'jpg,jpeg, gif, png,ico','allowEmpty'=>true),
               array('slug', 'length', 'max'=>250),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('state_id, country_id, state_name, isTrash', 'safe', 'on'=>'search'),
        );
    }
public function getPrimaryField(){
		 return 'state_id';
	 }
    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
          'con' => array(self::BELONGS_TO, 'Countries', 'country_id','on'=>"con.isTrash='0'"),
          'hotelCount' => array(self::STAT, 'Hotel','state'),
        );
    }
  public function behaviors(){
    return array_merge(parent::behaviors(),array(
        'SlugBehavior' => array(
            'class' => 'common.models.SlugBehavior.SlugBehavior',
            'slug_col' => 'slug',
            'title_col' => 'state_name',
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
            'p_name' => 'Prospace title',
            'state_id' => 'State',
            'country_id' => 'Country',
               'state_name' => 'City Name',
            'region_id' => 'Region',
            'isTrash' => 'Is Trash',
            'mul_city' =>'Mulitple Cities(split-by-each-line)',
        );
    }
    public function StatelistFromCookie()
    {
		  $criteria=new CDbCriteria;
		  if(Yii::app()->request->cookies['country'])
		  {
			  $criteria->condition="isTrash='0' and country_id=:para";
			  $criteria->params[":para"] = Yii::app()->request->cookies['country'];
		  }
		  else
		  {
			  $criteria->condition="isTrash='0'";
		  }
		  
		 // $criteria->select="country_id,country_name";
		 $criteria->order ="t.state_name";
		  return $this->findAll($criteria);
		
	}
	public function getStateFromCookie()
    {
		 
		  $criteria=new CDbCriteria;
		  $criteria->condition="isTrash='0' and state_id=:params";
		  $criteria->params[":params"] = Yii::app()->request->cookies['state'];
		 // $criteria->select="country_id,country_name";
		  return $this->find($criteria);
		
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
        $criteria->select ='t.*,mr.name as region_name';
        $criteria->compare('state_id',$this->state_id);
       // $criteria->compare('t.country_id',$this->country_id);
         if(!empty($this->country_id)){
			 $criteria->with = array('con');
			 $criteria->compare('con.country_name',$this->country_id,true);
		 }
	    if(!empty($this->region_id)){
			 $criteria->compare('mr.name',$this->region_id,true);
		}
		$criteria->join .=' LEFT JOIN {{main_region}} mr on mr.region_id = t.region_id ';
        $criteria->compare('state_name',$this->state_name,true);
        $criteria->compare('t.isTrash','0');
        $criteria->with ="con";
        $criteria->order="country_name";
        $criteria->order="state_name";
         $criteria->order = "mr.region_id desc ,  t.country_id =  '65949'  desc ,t.country_id =  '65946'  desc  , t.state_name asc    " ;
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
     * @return States the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    public function getStateList($val=null)
    {
		 $criteria=new CDbCriteria;
		 $criteria->select="state_id,state_name";
		 $criteria->condition="country_id=:con";
		 $criteria->order="t.state_name";
		 $criteria->params[':con'] = $val;
		 return $this->findAll($criteria);
	}
    public function  StateList()
    {
		 $criteria=new CDbCriteria;
		 $criteria->select="state_id,state_name";
		 $criteria->order="isTrash='0'";
		 $criteria->order="state_name";
		 return $this->findAll($criteria);
	}
	function getState_1()
	{
		 static $_options = array();
		 
		 $r= $this->findAll(array("condition"=>"isTrash='0' " ,"order"=>"state_name"));
	 
		 if($r)
		 {
			 foreach($r as $k=>$v)
			 {
				  $_options[$v->state_id] =  $v->state_name; 
			 }
	     }
	     return $_options;
		 
	}
   public function getStateWithCountry()
	{
		 $criteria=new CDbCriteria;
		// $criteria->select="con.country_name,state_name,state_id";
		 $criteria->with ="con";
		 $criteria->condition="t.isTrash=0";
		 $criteria->order ="t.country_id";
		 return $this->findAll($criteria);
		 
	}
   public function getState($id=null)
	{
		 $criteria=new CDbCriteria;
		 $criteria->condition="t.isTrash='0' and state_id=:id";
		 $criteria->params[":id"] = $id;
		 return $this->find($criteria);
		 
	}
	
    public function getStateWithCountry_2($id)
	{
		 $criteria=new CDbCriteria;
		 $criteria->select="state_name,state_id";
		 $criteria->condition="t.isTrash=0 and country_id=:con";
		 $criteria->params[":con"]= $id ;
		 $criteria->order ="t.state_name";
		 return $this->findAll($criteria);
	}

    public function getStateWithCountry_3($cid, $rid)
    {
        $criteria=new CDbCriteria;
        $criteria->select="state_id, state_name";
        $criteria->condition="t.isTrash=0 and region_id=:con1";
//        $criteria->params[":con"]= $cid;
        $criteria->params[":con1"]= $rid;
        $criteria->order ="t.state_name";
        return $this->findAll($criteria);
    }
	
	public function getFirstState($id)
	{
		 $criteria=new CDbCriteria;
		 $criteria->select="state_id";
		 $criteria->condition="t.isTrash=0 and country_id=:con";
		 $criteria->params[":con"]= $id ;
		 $criteria->order ="t.state_name";
		 return $this->find($criteria);
	}
	public $country_name;
	public $community_name;
	public $community_id;
	public $country_slug;
	public function  checkEnableForlisting($state)
    { 
		$criteria=new CDbCriteria;
		$criteria->select = 't.country_id,t.state_id,t.state_name,cn.country_name';
		$criteria->join = 'LEFT JOIN {{countries}} cn ON t.country_id  = cn.country_id  ';
		$criteria->condition = ' t.slug = :slug and cn.show_on_listing="1" and case WHEN cn.enable_all_cities="1" THEN 1  WHEN t.enable_listing="1" THEN 1 ELSE 0 END   ';
		$criteria->params[':slug'] = $state ;
		return self::model()->find($criteria);
	}
	public function beforeSave(){
		parent:: beforeSave();
		
	 		$cacheKey =  'pak_city_cache'.Yii::app()->options->get('system.common.city_cache','123s421');
			Yii::app()->cache->delete($cacheKey);
			Yii::app()->options->set('system.common.city_cache',date('Ymdhis').time());
		 
		return true; 
	}
	public $reg_slug; 
	public function  AllListingStatesOfCountry($country_id=null,$limit=0,$only_photos=0)
    { 
		if($limit==0 and !empty($country_id) and !isset($_GET['refresh'])){
			$cacheKey =  'pak_city_cache12'.Yii::app()->options->get('system.common.city_cache','123s421').$country_id;
			if(defined('LANGUAGE')){$cacheKey .= LANGUAGE ;   }
			if ($items = Yii::app()->cache->get($cacheKey)) { 
		 
				 return $items;
			}
		}else if($limit==11 and !empty($country_id) and !isset($_GET['refresh'])){  
		        $cacheKey =  $limit.'pak_city_cache12'.Yii::app()->options->get('system.common.city_cache','123s421').$country_id;
			if(defined('LANGUAGE')){$cacheKey .= LANGUAGE ;   }
			if ($items = Yii::app()->cache->get($cacheKey)) { 
	 
				 return $items;
			}
		}
 
		$criteria=new CDbCriteria;
		$criteria->select = 't.country_id,t.state_id ,cn.slug as country_slug,t.slug,t.icon,t.region_id,rg.slug as reg_slug';
		$criteria->join = 'LEFT JOIN {{countries}} cn ON t.country_id  = cn.country_id  ';
		$criteria->join .= 'LEFT JOIN {{main_region}} rg ON t.region_id  = rg.region_id  ';
		$criteria->condition = ' t.country_id = :country_id and cn.show_on_listing="1" and case WHEN cn.enable_all_cities="1" THEN 1  WHEN t.enable_listing="1" THEN 1 ELSE 0 END  and t.isTrash!="1" ';
		$criteria->params[':country_id'] = $country_id ;
		if(defined('LANGUAGE') and LANGUAGE != 'en'){ 
			$criteria->params[':lan'] = LANGUAGE;
			$criteria->distinct = 't.state_id'; 
			$criteria->join  .= ' left join `mw_translate_relation` `translationRelation` on translationRelation.state_id = t.state_id   LEFT  JOIN mw_translation_data tdata ON (`translationRelation`.translate_id=tdata.translation_id and tdata.lang=:lan) ';
			$criteria->select .= ' ,CASE WHEN tdata.message IS NOT NULL THEN    tdata.message ELSE t.state_name END  AS state_name ';
			}
			else{
				$criteria->select .= ' ,t.state_name';
			}
		$criteria->order = '-t.priority desc,state_name asc';
		if(!empty($limit)){ $criteria->limit = $limit; }
		if(!empty($only_photos)){
		    	$criteria->condition .= ' and t.icon is not null ';
		}
		$result =  self::model()->findAll($criteria);
		if(in_array($limit,array('0','11')) and !empty($country_id )){
			
			  Yii::app()->cache->set($cacheKey, $result,60 * 60 * 24 * 360  );
		}
		return  $result; 
		
	}
	public function byIdIterate(){
    	$cacheKey =  'pak_city_cache12_item2s'.Yii::app()->options->get('system.common.city_cache','123s421').$country_id;
		if(defined('LANGUAGE')){$cacheKey .= LANGUAGE ;   }
		if ($items = Yii::app()->cache->get($cacheKey)) { 
	 
			 return $items;
		}
	    $data = self::model()->AllListingStatesOfCountry(COUNTRY_ID);
	    $ar = array();
	    foreach($data as $k=>$v){
	        $ar[$v->state_id] =  array('name'=>$v->state_name,'slug'=>$v->slug);
	    }
	     Yii::app()->cache->set($cacheKey, $ar,60 * 60 * 24 * 360  );
	     return  $ar;
	}
	public function  AllListingStatesOfEnabledCountry($country_id=null,$limit=0)
    { 
		 
		$criteria=new CDbCriteria;
		$criteria->select = 't.country_id,t.state_id,t.state_name,cn.slug as country_slug,t.slug,t.icon';
		$criteria->join = 'LEFT JOIN {{countries}} cn ON t.country_id  = cn.country_id  ';
		$criteria->condition = '  cn.show_on_listing="1" and case WHEN cn.enable_all_cities="1" THEN 1  WHEN t.enable_listing="1" THEN 1 ELSE 0 END   ';
		$criteria->params[':country_id'] = $country_id ;
		if(!empty($limit)){ $criteria->limit = $limit; }
		
		$result =  self::model()->findAll($criteria);
		 
		return  $result; 
		
	}
	public function  AllStatesOfCountry($country_id=null,$limit=0)
    { 
		$criteria=new CDbCriteria;
		$criteria->select = 't.country_id,t.state_id,t.state_name ';
		$criteria->condition = ' t.country_id = :country_id  ';
		$criteria->params[':country_id'] = $country_id ;
		if(!empty($limit)){ $criteria->limit = $limit; }
		return self::model()->findAll($criteria);
	}
	public function  ListDataForJSON($country)
    {
		 /*
		 $criteria=new CDbCriteria;
		 $criteria->condition = "t.isTrash='0' and t.country_id=:con";
		 $criteria->params[':con']=$country;
		 $criteria->select ="state_id,state_name";
		 $criteria->order="state_name";
		 */
		 $arra =  $this->AllListingStatesOfCountry($country);
		 $ar = array();
		 if($arra)
		 {
			 foreach($arra as $k=>$v)
			 {
				 $ar[]= array("id"=>$v->state_id , "name" => $v->state_name );
			 }
		 }
		 
	 	 return CJSON::encode(array_merge(array("0"=>"Select Region"),$ar));
	}
		public function findListingCountries($country_id=null){
		$countryModel = Countries::model()->findByAttributes(array('slug'=>$country_id));
		$country_id = null;
		if($countryModel){
			$country_id = $countryModel->country_id;
		}
		$limit = 30;
		$request = Yii::app()->request;
		$criteria=new CDbCriteria;
		$criteria->compare('t.isTrash','0');
		$criteria->join  = ' LEFT JOIN {{countries}} cn on t.country_id = cn.country_id  ' ;
		$criteria->condition .= ' and CASE WHEN cn.enable_all_cities = "1" THEN 1 ELSE t.enable_listing="1" END and t.country_id = :country_id  ';
		$criteria->params['country_id'] = $country_id ;
        $criteria->select = 't.slug,state_name'; 
        return States::model()->findAll($criteria);
	}
		
	public function  ListDataForJSON2($country)
    {
		 
		 $arra =  $this->AllListingStatesOfCountry($country);
		 $ar = array();
		 if($arra)
		 {
			 foreach($arra as $k=>$v)
			 {
				 $ar[]= array("id"=>$v->state_id , "name" => $v->state_name );
			 }
		 }
		 
	 	 return  array();
	}
	public function search_by_term($terms)
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

			$criteria=new CDbCriteria;
			$criteria->select = 't.state_id,t.country_id';
			$criteria->condition = '  LOWER(t.state_name) like  :term ';
			$criteria->params[':term']  = '%'.$terms.'%';
			return $this->find($criteria);
    }
      public function findByLocation($terms){
		$criteria=new CDbCriteria;
			$criteria->select = 't.state_id,t.country_id';
			$criteria->condition = '  LOWER(t.state_name) like  :term  and t.country_id="66099"';
			$criteria->params[':term']  = '%'.trim(strtolower($terms)).'%';
			return $this->find($criteria);
	 }
	 public function  getStatebySlug($slug=null)
    { 
		 
		$criteria=new CDbCriteria;
		$criteria->condition  = '1 and t.slug = :slug';
		$criteria->params[':slug']  = $slug;
		$criteria->select = 't.state_name,t.state_id';
 
		if(defined('LANGUAGE') and LANGUAGE != 'en'){ 
			$criteria->params[':lan'] = LANGUAGE;
			$criteria->distinct = 't.state_id'; 
			$criteria->join  .= ' left join `mw_translate_relation` `translationRelation` on translationRelation.state_id = t.state_id   LEFT  JOIN mw_translation_data tdata ON (`translationRelation`.translate_id=tdata.translation_id and tdata.lang=:lan) ';
			$criteria->select .= ' ,CASE WHEN tdata.message IS NOT NULL THEN    tdata.message ELSE t.state_name END  AS state_name ';
			}
			else{
				$criteria->select .= ' ,t.state_name';
			} 
		return   self::model()->find($criteria);
	}
	public function  all_cities()
    { 
		if($limit==0 and !empty($country_id) ){
			$cacheKey =  'all_cities'.Yii::app()->options->get('system.common.city_cache','abcdefg').COUNTRY_ID;
			if(defined('LANGUAGE')){$cacheKey .= LANGUAGE ;   }
			if ($items = Yii::app()->cache->get($cacheKey)) { 
		 
				 return $items;
			}
		}
			$criteria=new CDbCriteria;
		$criteria->select = 't.state_id';
		$criteria->condition = ' t.country_id = :country_id   ';
		$criteria->params[':country_id'] = COUNTRY_ID ;
		if(defined('LANGUAGE') and LANGUAGE != 'en'){ 
			$criteria->params[':lan'] = LANGUAGE;
			$criteria->distinct = 't.state_id'; 
			$criteria->join  .= ' left join `mw_translate_relation` `translationRelation` on translationRelation.state_id = t.state_id   LEFT  JOIN mw_translation_data tdata ON (`translationRelation`.translate_id=tdata.translation_id and tdata.lang=:lan) ';
			$criteria->select .= ' ,CASE WHEN tdata.message IS NOT NULL THEN    tdata.message ELSE t.state_name END  AS state_name ';
			}
			else{
				$criteria->select .= ' ,t.state_name';
			}
		$criteria->order = '-t.priority desc,state_name asc'; 
		$arra =  $this->findAll($criteria);
		$items =array();
		 if($arra)
		 {
			 foreach($arra as $k=>$v)
			 {
				$items[$v->state_id]  = $v->state_name;
			 }
		 } 
		Yii::app()->cache->set($cacheKey, $items,60 * 60 * 24 * 360  );
		return $items; 
	}
	public function  getStatebyId($id=null)
    { 
		 
		$criteria=new CDbCriteria;
		$criteria->condition  = '1 and t.state_id = :id';
		$criteria->params[':id']  = (int)$id;
		$criteria->select = 't.state_name,t.state_id';
 
		if(defined('LANGUAGE') and LANGUAGE != 'en'){ 
			$criteria->params[':lan'] = LANGUAGE;
			$criteria->distinct = 't.state_id'; 
			$criteria->join  .= ' left join `mw_translate_relation` `translationRelation` on translationRelation.state_id = t.state_id   LEFT  JOIN mw_translation_data tdata ON (`translationRelation`.translate_id=tdata.translation_id and tdata.lang=:lan) ';
			$criteria->select .= ' ,CASE WHEN tdata.message IS NOT NULL THEN    tdata.message ELSE t.state_name END  AS state_name ';
			}
			else{
				$criteria->select .= ' ,t.state_name';
			} 
		return   self::model()->find($criteria);
	}
	public $region_slug; 
	public function  all_cities_list()
    { 
		if($limit==0 and !empty($country_id) ){
			$cacheKey =  'all_cities-nrew'.Yii::app()->options->get('system.common.city_cache','abcdefg').COUNTRY_ID;
			if(defined('LANGUAGE')){$cacheKey .= LANGUAGE ;   }
			if ($items = Yii::app()->cache->get($cacheKey) and !isset($_GET['refresh'])) { 
		 
				 return $items;
			}
		}
			$criteria=new CDbCriteria;
		$criteria->select = 't.slug,mr.slug as region_slug';
		$criteria->condition = ' t.country_id = :country_id   ';
		$criteria->join .=' INNER JOIN {{main_region}} mr on mr.region_id = t.region_id ';
		$criteria->params[':country_id'] = COUNTRY_ID ;
		if(defined('LANGUAGE') and LANGUAGE != 'en'){ 
			$criteria->params[':lan'] = LANGUAGE;
			$criteria->distinct = 't.state_id'; 
			$criteria->join  .= ' left join `mw_translate_relation` `translationRelation` on translationRelation.state_id = t.state_id   LEFT  JOIN mw_translation_data tdata ON (`translationRelation`.translate_id=tdata.translation_id and tdata.lang=:lan) ';
			$criteria->join  .= ' left join `mw_translate_relation` `translationRelation2` on translationRelation2.region_id = t.region_id   LEFT  JOIN mw_translation_data tdata2 ON (`translationRelation2`.translate_id=tdata2.translation_id and tdata2.lang=:lan) ';
	
			$criteria->select .= ' ,CASE WHEN tdata.message IS NOT NULL THEN    tdata.message ELSE t.state_name END  AS state_name ,CASE WHEN tdata2.message IS NOT NULL THEN    tdata2.message ELSE mr.name END  AS region_name ';
			}
			else{
				$criteria->select .= ' ,t.state_name,mr.name as region_name';
			}
		$criteria->order = '-t.priority desc,state_name asc'; 
		$arra =  $this->findAll($criteria);
		$items =array();
		 if($arra)
		 {
			 foreach($arra as $k=>$v)
			 {
			 
				$items[$v->region_slug]  = array('name'=> $v->region_name,"id"=>$v->region_slug);
				$items[$v->slug]  = array('name'=> $v->state_name,"id"=>$v->slug, "groupName"=>$v->region_name,"groupId"=>$v->region_slug,'region'=>$v->region_slug);
			 }
		 } 
		Yii::app()->cache->set($cacheKey, $items,60 * 60 * 24 * 360  );
		return $items; 
	}
	public $t_state;  
	 public function getAllCommunitiesPostedAd(){
		$criteria=new CDbCriteria;
		$criteria->condition = '1';
		$criteria->select = 'count(t.state_id) as t_state,t.slug,reg.slug as reg_slug'; 
	 	$criteria->join .=  ' inner join {{place_an_ad}} ad on ad.state = t.state_id' ;
	 	$criteria->join .=  ' inner join {{main_region}} reg on reg.region_id = t.region_id' ;
	 	$criteria->group  = 'ad.state'; 
		$criteria->order  = 'count(t.state_id)  desc '; 
		$datas =   States::model()->findAll($criteria);
		$community_list =array();$city_list = array();
		$items = array();
		foreach($datas as $state_list){
		    $community_list[] = $state_list->slug; 
		    $city_list[$state_list->reg_slug] = $state_list->reg_slug; 
		}
		$items['community'] = $community_list; 
		$items['region'] = $city_list; 
		return $items; 
	 
	 }
}
 
