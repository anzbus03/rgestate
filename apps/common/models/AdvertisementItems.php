<?php

/**
 * This is the model class for table "{{advertisement_items}}".
 *
 * The followings are the available columns in table '{{advertisement_items}}':
 * @property integer $row_id
 * @property integer $layout_id
 * @property string $section
 * @property integer $ad_id
 * @property integer $banner_id
 * @property integer $article_id
 *
 * The followings are the available model relations:
 * @property Article $article
 * @property PlaceAnAd $ad
 * @property Banner $banner
 */
class AdvertisementItems extends  ActiveRecord
{
    /**
     * @return string the associated database table name
     */
     public $main_ad ; 
     const HOME_FEATURED_BANNER = '4';
       const NEW_ID       	  = 3; 
    public function tableName()
    {
        return '{{advertisement_items}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('row_id, layout_id, section , main_ad,row_number ', 'required'),
            array('row_id, layout_id, ad_id, banner_id, article_id', 'numerical', 'integerOnly'=>true),
            array('section', 'length', 'max'=>2),
           
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('row_id, layout_id, section, ad_id, banner_id, article_id', 'safe', 'on'=>'search'),
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
            'article' => array(self::BELONGS_TO, 'Article', 'article_id'),
            'ad' => array(self::BELONGS_TO, 'PlaceAnAd', 'ad_id'),
            'banner' => array(self::BELONGS_TO, 'Banner', 'banner_id'),
        );
    }
	public function beforeSave(){
		parent::beforeSave();
		switch($this->section){
			case 'A':
			$this->ad_id = $this->main_ad;
			$this->banner_id = null;
			$this->article_id = null;
			break;
			case 'B':
			$this->ad_id = null ; 
			$this->banner_id = $this->main_ad;;
			$this->article_id = null;
			break;
			case 'Bl':
			$this->ad_id = null ; 
			$this->banner_id = null ; 
			$this->article_id = $this->main_ad;
			break;
			default:
			$this->ad_id = null ; 
			$this->banner_id = null ; 
			$this->article_id = null;
			break;
		}
		return true; 
	}
    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'row_id' => 'Row',
            'layout_id' => 'Layout',
            'section' => 'Section',
            'ad_id' => 'Ad',
            'banner_id' => 'Banner',
            'article_id' => 'Article',
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
     public $ad_image ; 
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('row_id',$this->row_id);
        $criteria->compare('layout_id',$this->layout_id);
        $criteria->compare('section',$this->section,true);
        $criteria->compare('ad_id',$this->ad_id);
        $criteria->compare('banner_id',$this->banner_id);
        $criteria->compare('article_id',$this->article_id);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
    public $ad_title ; 
    public $banner_title ; 
    public $blog_title ; 
    public function getAdTitle(){
		switch($this->section){
			case 'A':
			return $this->ad_title;
			break;
			case 'B':
			return $this->banner_title;
			break;
			case 'Bl':
				return $this->blog_title;
			break;
		}
	}
	public $ad_description ; 
    public $banner_description ; 
    public $blog_description ; 
    public function getAdDescription(){
		switch($this->section){
			case 'A':
			return $this->ad_description;
			break;
			case 'B':
			return $this->banner_description;
			break;
			case 'Bl':
				return $this->blog_description;
			break;
		}
	}
    public function getAdImage(){
		switch($this->section){
			case 'A':
			return Yii::app()->apps->getBaseUrl('uploads/images/'.$this->ad_image);
			break;
			case 'B':
			return Yii::app()->apps->getBaseUrl('uploads/banner/'.$this->ad_image);
			break;
			case 'Bl':
			 preg_match('/< *img[^>]*src *= *["\']?([^"\']*)/i', $this->blog_description, $imges);
			return @$imges['1'];
			break;
		}
	}
	public $ad_slug;
	public $banner_slug;
	public $blog_slug;
	public $section_id;
    public function getDetailUrl(){
		switch($this->section){
			case 'A':
			if($this->section_id==self::NEW_ID){
			return Yii::app()->createUrl('detail/project',array('slug'=>$this->ad_slug));
			}
			return Yii::app()->createUrl('detail/index',array('slug'=>$this->ad_slug));
			break;
			case 'B':
			return $this->banner_slug;
			break;
			case 'Bl':
				return Yii::app()->createUrl($this->blog_slug.'/blog');;
			break;
		}
	}
	public function getShortDescription($length = 130)
    {
        return StringHelper::truncateLength($this->AdDescription, (int)$length);
    }
    

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return AdvertisementItems the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    
    public function home_featured_banner(){
			$criteria=new CDbCriteria;
			$criteria->select = 't.*, ad.section_id,ad.slug as ad_slug,ban.link_url as banner_slug , art.slug as blog_slug  , ad.ad_description as ad_description, ad.ad_title as ad_title,ban.title as banner_title , art.title as blog_title  , ad.ad_description as ad_description,ban.description as banner_description , art.content as blog_description  ,  (CASE WHEN  t.section = "A" THEN  (SELECT image_name FROM {{ad_image}} img  WHERE  img.ad_id = t.ad_id and  img.status="A" and  img.isTrash="0"  limit 1  )  WHEN t.section = "B" THEN ban.image  ELSE 0 END ) as      ad_image ';
			$criteria->join  .= ' left join {{place_an_ad}} ad ON ad.id = t.ad_id  ';
			$criteria->join  .= ' left join {{banner}} ban ON ban.banner_id = t.banner_id ';
			$criteria->join  .= ' left join {{article}} art ON art.article_id = t.article_id ';
			$criteria->condition  .= ' 1  and  t.layout_id = :layout_id ';
			$criteria->params[':layout_id']   = self::HOME_FEATURED_BANNER ;
			return self::model()->findAll($criteria);

	}
}
