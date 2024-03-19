<?php

/**
 * This is the model class for table "mw_ad_image".
 *
 * The followings are the available columns in table 'mw_ad_image':
 * @property integer $id
 * @property integer $ad_id
 * @property string $image_name
 * @property integer $priority
 * @property string $isTrash
 *
 * The followings are the available model relations:
 * @property PlaceAnAd $ad
 */
class ArticleView extends ActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'mw_article_view';
    }

  
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('article_id, ip_address', 'required'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('article_id, ip_address, date_added', 'safe', 'on'=>'search'),
            array('article_id, ip_address, date_added', 'safe'),
        );
    }
	 public static function model($className=__CLASS__)
		{
			return parent::model($className);
		}
    public function HighestPriorityImage($ad_id)
    {
		 $criteria=new CDbCriteria;
		 $criteria->condition = "t.ad_id=:ad_id and isTrash='0' and status='A'";
		 $criteria->params[':ad_id'] = $ad_id;
		 $criteria->order = "priority";
		 return $this->find($criteria);
	}
    public function findIPwithId($article,$ip)
    {
	 
		
		 $criteria=new CDbCriteria;
		 $criteria->condition = "t.article_id=:article_id and t.ip_address=:ip";
		 $criteria->params[':article_id'] = $article;
		 $criteria->params[':ip'] = $ip;
		 return $this->find($criteria);
	}
       public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;

    
        $criteria->compare('article_id',$this->article_id);
        $criteria->compare('ip_address',$this->ip_address);
        $criteria->compare('date_added',$this->date_added);
         

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

}
