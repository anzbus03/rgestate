<?php

/**
 * This is the model class for table "{{main_region}}".
 *
 * The followings are the available columns in table '{{main_region}}':
 * @property integer $region_id
 * @property string $name
 * @property string $last_updated
 * @property string $status
 * @property integer $priority
 */
class MainRegion extends ActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{main_region}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, country_id, status', 'required'),
            array('priority', 'numerical', 'integerOnly'=>true),
            array('name', 'length', 'max'=>250),
            array('status', 'length', 'max'=>1),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('region_id, name, last_updated, status, priority', 'safe', 'on'=>'search'),
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
    public $country_name;
    public function attributeLabels()
    {
        return array(
            'region_id' => 'Region',
            'country_id' => 'Country',
            'name' => 'Name',
            'last_updated' => 'Last Updated',
            'status' => 'Status',
            'priority' => 'Priority',
        );
    }
   public function getStateWithCountry_2($id)
	{
		 $criteria=new CDbCriteria;
		 $criteria->select="name,region_id";
		 $criteria->condition="t.status='A' and country_id=:con";
		 $criteria->params[":con"]= (int)$id ;
		 $criteria->order ="-t.priority desc , t.name asc";
		 return $this->findAll($criteria);
		 
	}
    public function beforeSave(){
		parent:: beforeSave();
		
	 		$cacheKey =  'pak_city_cache'.Yii::app()->options->get('system.common.region_cache','123s421');
			Yii::app()->cache->delete($cacheKey);
			Yii::app()->options->set('system.common.region_cache',date('Ymdhis').time());
		 
		return true; 
	}
	 public function getStateWithCountry_2datas($id)
	{
			$cacheKey =  'region_cache11'.Yii::app()->options->get('system.common.region_cache','12312').$id;
			if(defined('LANGUAGE')){$cacheKey .= LANGUAGE ;   }
			if ($items = Yii::app()->cache->get($cacheKey) and !isset($_GET['refresh'])) { 
		 
				 return $items;
			}
			
		 $criteria=new CDbCriteria;
		 $criteria->select="name,t.region_id,slug";
		 	if(defined('LANGUAGE') and LANGUAGE != 'en'){ 
			$criteria->params[':lan'] = LANGUAGE;
			$criteria->distinct = 't.region_id'; 
			$criteria->join  .= ' left join `mw_translate_relation` `translationRelation` on translationRelation.region_id = t.region_id   LEFT  JOIN mw_translation_data tdata ON (`translationRelation`.translate_id=tdata.translation_id and tdata.lang=:lan) ';
			$criteria->select .= ' ,CASE WHEN tdata.message IS NOT NULL THEN    tdata.message ELSE t.name END  AS name ';
			}
			
		 $criteria->condition="t.status='A' and t.country_id=:con";
		 $criteria->params[":con"]= (int)$id ;
		 $criteria->order ="-t.priority desc , t.name asc";
		 $fdat = $this->findAll($criteria);
		 $ar = array();
		 if(!empty($fdat)){
			 foreach($fdat as $k=>$v){
				 $ar[$v->region_id] = array('name'=>$v->name,'slug'=>$v->slug);
			 }
		 }
		 
	 
		   Yii::app()->cache->set($cacheKey, $ar,60 * 60 * 24 * 1  );
		  
		 return $ar ; 
	}
   public function getStateWithCountry_2dataslug($id)
	{
			$cacheKey =  'region_cache1dd11'.Yii::app()->options->get('system.common.region_cache','12312').$id;
			if(defined('LANGUAGE')){$cacheKey .= LANGUAGE ;   }
			if ($items = Yii::app()->cache->get($cacheKey)) { 
		 
				 return $items;
			}
			
		 $criteria=new CDbCriteria;
		 $criteria->select="name,t.region_id,slug";
		 	if(defined('LANGUAGE') and LANGUAGE != 'en'){ 
			$criteria->params[':lan'] = LANGUAGE;
			$criteria->distinct = 't.region_id'; 
			$criteria->join  .= ' left join `mw_translate_relation` `translationRelation` on translationRelation.region_id = t.region_id   LEFT  JOIN mw_translation_data tdata ON (`translationRelation`.translate_id=tdata.translation_id and tdata.lang=:lan) ';
			$criteria->select .= ' ,CASE WHEN tdata.message IS NOT NULL THEN    tdata.message ELSE t.name END  AS name ';
			}
			
		 $criteria->condition="t.status='A' and t.country_id=:con";
		 $criteria->params[":con"]= (int)$id ;
		 $criteria->order ="-t.priority desc , t.name asc";
		 $fdat = $this->findAll($criteria);
		 $ar = array();
		 if(!empty($fdat)){
			 foreach($fdat as $k=>$v){
				 $ar[$v->slug] =  array('name'=>$v->name,'id'=>$v->region_id);
			 }
		 }
		   Yii::app()->cache->set($cacheKey, $ar,60 * 60 * 24 * 1  );
		  
		 return $ar ; 
	}
	
	public function getStateWithCountry_2dataslugModel($id)
	{
			$cacheKey =  'region_cache1dd11'.Yii::app()->options->get('system.common.region_cache','12312').$id;
			if(defined('LANGUAGE')){$cacheKey .= LANGUAGE ;   }
			if ($items = Yii::app()->cache->get($cacheKey)) { 
		 
				 return $items;
			}
			
		 $criteria=new CDbCriteria;
		 $criteria->select="name,t.region_id,slug";
		 	if(defined('LANGUAGE') and LANGUAGE != 'en'){ 
			$criteria->params[':lan'] = LANGUAGE;
			$criteria->distinct = 't.region_id'; 
			$criteria->join  .= ' left join `mw_translate_relation` `translationRelation` on translationRelation.region_id = t.region_id   LEFT  JOIN mw_translation_data tdata ON (`translationRelation`.translate_id=tdata.translation_id and tdata.lang=:lan) ';
			$criteria->select .= ' ,CASE WHEN tdata.message IS NOT NULL THEN    tdata.message ELSE t.name END  AS name ';
			}
			
		 $criteria->condition="t.status='A' and t.country_id=:con";
		 $criteria->params[":con"]= (int)$id ;
		 $criteria->order ="-t.priority desc , t.name asc";
		 return $this->findAll($criteria); 
		   
	}
	public $city_name; 
	public function byIdIterate(){
    	$cacheKey =  'pak_city_cache12_item2s'.Yii::app()->options->get('system.common.region_cache','123s421').$country_id;
		if(defined('LANGUAGE')){$cacheKey .= LANGUAGE ;   }
		if ($items = Yii::app()->cache->get($cacheKey)) { 
	 
			 return $items;
		}
	    $data = self::model()->getStateWithCountry_2dataslugModel(COUNTRY_ID);
	    $ar = array();
	    foreach($data as $k=>$v){
	        $ar[$v->primaryKey] =  array('name'=>$v->name,'slug'=>$v->slug);
	    }
	     Yii::app()->cache->set($cacheKey, $ar,60 * 60 * 24 * 360  );
	     return  $ar;
	}
	
	  public function behaviors(){
    return array_merge(parent::behaviors(),array(
        'SlugBehavior' => array(
            'class' => 'common.models.SlugBehavior.SlugBehavior',
            'slug_col' => 'slug',
            'title_col' => 'name',
            'overwrite' => true
        ))
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
     public function getPrimaryField(){
		 return 'region_id';
	 }
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;
        $criteria->select = 't.*,cn.country_name ';

        $criteria->compare('region_id',$this->region_id);
        $criteria->compare('name',$this->name,true);
        $criteria->compare('last_updated',$this->last_updated,true);
        $criteria->compare('status',$this->status,true);
        $criteria->compare('priority',$this->priority);
$criteria->join .= ' LEFT JOIN {{countries}} cn on cn.country_id = t.country_id ';
$criteria->order = 't.last_updated desc';
if(!empty($this->country_id)){
	  $criteria->compare('cn.country_name',$this->country_id,true);
}
           return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            //  'pagination'    => array(
            //     'pageSize'  => $this->paginationOptions->getPageSize(),
            //     'pageVar'   => 'page',
            // ),
			'pagination' => false
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return MainRegion the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
