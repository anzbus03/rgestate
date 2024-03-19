<?php

/**
 * This is the model class for table "mw_banner".
 *
 * The followings are the available columns in table 'mw_banner':
 * @property integer $banner_id
 * @property integer $position_id
 * @property string $image
 * @property string $status
 * @property string $isTrash
 * @property integer $priority
 *
 * The followings are the available model relations:
 * @property BannerPosition $position
 */
class BlogBanner extends ActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'mw_banner';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
              array('script', 'required', 'on' => 'scriptAD'),
            array('position_id, priority', 'numerical', 'integerOnly'=>true),
            array('link_url,title', 'required' ),
            array('country_id', 'safe' ),
            array('image', 'length', 'max'=>250),
            array('image', 'file', 'types'=>'jpg,jpeg, gif, png','allowEmpty'=>false,'on'=>'insert'),
            array('image', 'file', 'types'=>'jpg,jpeg, gif, png','allowEmpty'=>true,'on'=>'update'),
            array('status, isTrash', 'length', 'max'=>1),
          array('script,link_url', 'safe'),
          array('link_url', 'url'),
          
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('banner_id, position_id, image, status, isTrash, priority ,script', 'safe', 'on'=>'search'),
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
            'position' => array(self::BELONGS_TO, 'BannerPosition', 'position_id','on'=>"position.isTrash='0'",'joinType'=>'INNER JOIN'),
       
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'banner_id' => 'Banner',
            'position_id' => 'Position',
            'image' => 'Image',
            'status' => 'Status',
            'isTrash' => 'Is Trash',
            'priority' => 'Priority',
            'country_id' => 'Browsing Country',
        );
    }
    const DETAIL_BANNER = '9';
    public $banner_width;
    public $banner_height;
    public function  detail_baaner()
    {
		 $criteria=new CDbCriteria;
		 $criteria->select = "t.image,pos.banner_width,pos.banner_height,link_url";
		 $criteria->condition = "t.isTrash='0' and t.status='A' and t.position_id = '".self::DETAIL_BANNER."' ";
		 $criteria->join=" LEFT JOIN {{banner_position}} pos on pos.position_id = t.position_id ";
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
     public function beforeSave(){
		 parent::beforeSave();
		 $cacheKey =  'blog_banners'.Yii::app()->options->get('system.common.blog_banner_cache','123s421');
         Yii::app()->cache->delete($cacheKey);
         Yii::app()->options->set('system.common.blog_banner_cache',time());
		 $this->f_type = 'Z';
		 return true;
	 }
   public $country_name;
   public function fetchBanners($browse_country='',$default_country='')
    { 
       
        $cacheKey =  'blog_banners1'.Yii::app()->options->get('system.common.blog_banner_cache','123s421');
		if(defined('COUNTRY_ID')){ $cacheKey .=	COUNTRY_ID;	}
       	if ($items = Yii::app()->cache->get($cacheKey)) {
		     
		  return $items;
		}
		$criteria=new CDbCriteria;
		$criteria->select = 't.banner_id,t.image,t.link_url,t.title';
        $criteria->compare('t.isTrash',0);
        $criteria->compare('t.status','A');
        $criteria->compare('f_type','Z');
        if(defined('COUNTRY_ID')){ $criteria->condition.=' and CASE WHEN t.country_id IS NULL THEN 1 ELSE t.country_id = :COUNTRY END ';$criteria->params[':COUNTRY'] = COUNTRY_ID; 	}
        $criteria->order="-t.priority desc";
        $ar =  $this->findAll($criteria);
        $count = 0; 
        $items = array();
        foreach($ar  as $k=>$v){
			
			
			$items[ $count] = array('link_url'=>$v->link_url, 'image'=>$v->image , 'title'=>$v->title) ; 
			 $count++;
		}
        Yii::app()->cache->set($cacheKey, $items,60 * 60 * 24 * 360  );
		return $items; 
	}
	public function listCountryBanners(){
		$criteria=new CDbCriteria;
		$criteria->select = 't.*';
        $criteria->compare('t.isTrash',0);
        $criteria->compare('t.status','A');
        $criteria->compare('f_type','Z');
        $criteria->order="-t.priority desc";
        $criteria->limit = '6';
        $ar =  $this->findAll($criteria);
        return $ar;
	}
	public function country_banners(){
		if(Yii::app()->options->get('system.common.enable_db_cache','yes')=='no'){ 
			return $this->listCountryBanners();
		}
		$cacheKey =  'blog_banners'.Yii::app()->options->get('system.common.blog_banners','1');
	
		if ($items = Yii::app()->cache->get($cacheKey)) {
			 return $items;
		}
		 
		$items = $this->listCountryBanners();
	 
		Yii::app()->cache->set($cacheKey, $items,60 * 60 * 24 * 360  );
		return $items; 
	}
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;
		$criteria->select = 't.*';
         $criteria->compare('banner_id',$this->banner_id);
        $criteria->compare('position_id',$this->position_id);
        $criteria->compare('image',$this->image,true);
        $criteria->compare('t.isTrash',0);
        $criteria->compare('t.status',$this->status);
        $criteria->compare('f_type','Z');
        $criteria->compare('priority',$this->priority);
        $criteria->order="-t.priority desc";
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
     * @return Banner the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    public function getBanner($id)
	{
		 
		 
		return $this->findByPk($id) ;
		 
	}
	public function getLinkUrl(){
	 return CHtml::link($this->title,$this->link_url,array('target'=>'_blank'));
	}

 public function imgDefault()
    {
        static $_defaultImgModel;
        if ($_defaultImgModel !== null) {
            return $_defaultImgModel;
        }
		$_defaultImgModel =  $ref=new imageResize;;
		 
		 
        return $_defaultImgModel;
    }
    	public function getGenerateBannerLink($image){
 	       
		if(defined('DISABLE_WEBP') or Yii::App()->isAppName('backend')){
					    return Yii::app()->apps->getBaseUrl('uploads/files/'. $image);
	    }
		 $ref= self::imgDefault();
		 $file_format='webp';	
		 $src =   'uploads/files/'.$image ;
		 $ref->resize($src,'uploads/mobile_images',1204,91,$file_format,FALSE);
		 return Yii::app()->apps->getBaseUrl($ref->newfilename);;
	}
 	public function getBannerLink($atBack=0){
 	      
		if(defined('DISABLE_WEBP') or Yii::App()->isAppName('backend')){
					    return Yii::app()->apps->getBaseUrl('uploads/files/'. $this->image);
	    }
		 $ref= self::imgDefault();
		 $file_format='webp';	
		 $src =   'uploads/files/'.	  $this->image ;
		 $ref->resize($src,'uploads/mobile_images',400,91,$file_format,FALSE);
		 return Yii::app()->apps->getBaseUrl($ref->newfilename);;
	}
}
