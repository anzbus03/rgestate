<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * Article
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2014 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 * @since 1.0
 */
 
/**
 * This is the model class for table "article".
 *
 * The followings are the available columns in table 'article':
 * @property integer $article_id
 * @property string $title
 * @property string $slug
 * @property string $content
 * @property string $status
 * @property string $date_added
 * @property string $last_updated
 *
 * The followings are the available model relations:
 * @property ArticleCategory[] $categories
 * @property ArticleCategory[] $activeCategories
 */
class BlogArticle extends Article
{
 
    public function search($return=false)
    {
        $criteria=new CDbCriteria;
        $criteria->condition = '1';
        $criteria->compare('title', $this->title, true);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('f_type', 'Bl');
    	if(defined('LANGUAGE')){
    	    $blan =''; 
    	    switch(LANGUAGE){
    	        case 'en':
    	            $blan = 'E';
    	        break;
    	        case 'ar':
    	             $blan = 'A';
    	        break;
    	    }
    	    if(!empty( $blan)){
		    $criteria->condition .= ' and ( t.blan = "0" or  t.blan = :blan ) ';
		    $criteria->params[':blan'] = $blan ; 
    	    }
		}
       	if(defined('COUNTRY_ID')){
			  	$criteria->join  .= ' left join {{blog_countries}} secCoutry on  secCoutry.country_id =  :country  and secCoutry.article_id = t.article_id  ';
				$criteria->params[':country']   =COUNTRY_ID;
				$criteria->condition .= " and  ( t.show_all = '0' OR secCoutry.country_id is  not    null )";
		  }
		if($return){
			return  $criteria;
		}
        return new CActiveDataProvider(get_class($this), array(
            'criteria'      => $criteria,
            'pagination'    => array(
                'pageSize'  => $this->paginationOptions->getPageSize(),
                'pageVar'   => 'page',
            ),
            'sort'  => array(
                'defaultOrder' => array(
                    'article_id' => CSort::SORT_DESC,
                ),
            ),
        ));
    }
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
     public function getAvailableCategoriesArray()
    {
	 
        $category = new ArticleCategory();
        return $category->getRelationalCategoriesArray_blog();
    }
    
   public function beforeSave(){
	   parent::beforeSave();
	   $this->f_type = 'Bl'; 
	   return true;
   }
       public function latestBlogs($limit=10){
			$criteria = $this->search(1);
			$criteria->order = 't.article_id DESC';
			$criteria->condition .= ' and t.status=:pub  ';
			$criteria->params[':pub']      = self::STATUS_PUBLISHED ;
		 
			$langaugae = defined('LANGUAGE') ? LANGUAGE : '';
			$criteria->distinct = 't.article_id';
			if(!empty($langaugae) and  $langaugae != 'en'){
				$criteria->params[':lan'] = $langaugae;
				$criteria->join  .= 'left join `mw_translate` `translate` on (  translate.source_tag = concat("BlogArticle_title_",t.article_id) )          left join `mw_translate_relation` `translationRelation` on translationRelation.article_id = t.article_id  and  translationRelation.translate_id = translate.translate_id  LEFT  JOIN mw_translation_data tdata ON (`translationRelation`.translate_id=tdata.translation_id and tdata.lang=:lan  ) ';
				$criteria->join  .= ' left join `mw_translate` `translate1` on ( translate1.source_tag = concat("BlogArticle_content_","",t.article_id) )   left join `mw_translate_relation` `translationRelation1` on translationRelation1.article_id = t.article_id  and  translationRelation1.translate_id = translate1.translate_id  LEFT  JOIN mw_translation_data tdata1 ON (`translationRelation1`.translate_id=tdata1.translation_id and tdata1.lang=:lan  ) ';
				$criteria->distinct = 'article_id';
				$criteria->select   .= ' , CASE WHEN tdata.message IS NOT NULL AND translate.source_tag IS NOT NULL    THEN  tdata.message ELSE t.title END	 as  title , CASE WHEN tdata1.message IS NOT NULL AND translate1.source_tag IS NOT NULL THEN  tdata1.message    ELSE t.content END	 as  content ';
				$criteria->group = 't.article_id';
			
			} 
		
			$criteria->limit = $limit; 
			return  $this->findAll($criteria); 
	}
       public function blogBySlug($slug=null){
			$criteria = $this->search(1);
			$criteria->order = 't.article_id DESC';
			$criteria->condition .= ' and t.status=:pub and t.slug =:slug  ';
			$criteria->params[':pub']      = self::STATUS_PUBLISHED ;
			$criteria->params[':slug']      = $slug ;
		 
			$langaugae = defined('LANGUAGE') ? LANGUAGE : '';
			if(!empty($langaugae) and  $langaugae != 'en'){
				$criteria->params[':lan'] = $langaugae;
				$criteria->join  .= 'left join `mw_translate` `translate` on (  translate.source_tag = concat("BlogArticle_title_",t.article_id) )          left join `mw_translate_relation` `translationRelation` on translationRelation.article_id = t.article_id  and  translationRelation.translate_id = translate.translate_id  LEFT  JOIN mw_translation_data tdata ON (`translationRelation`.translate_id=tdata.translation_id and tdata.lang=:lan  ) ';
				$criteria->join  .= ' left join `mw_translate` `translate1` on ( translate1.source_tag = concat("BlogArticle_content_","",t.article_id) )   left join `mw_translate_relation` `translationRelation1` on translationRelation1.article_id = t.article_id  and  translationRelation1.translate_id = translate1.translate_id  LEFT  JOIN mw_translation_data tdata1 ON (`translationRelation1`.translate_id=tdata1.translation_id and tdata1.lang=:lan  ) ';
				$criteria->distinct = 'article_id';
				$criteria->select   .= ' , CASE WHEN tdata.message IS NOT NULL AND translate.source_tag IS NOT NULL    THEN  tdata.message ELSE t.title END	 as  title , CASE WHEN tdata1.message IS NOT NULL AND translate1.source_tag IS NOT NULL THEN  tdata1.message    ELSE t.content END	 as  content ';
				$criteria->group = 't.article_id';
			
			} 
			return  $this->find($criteria); 
	}
   public function getArticles($id,$full=false)
    {
		$criteria = new CDbCriteria();
        $criteria->order = 't.article_id DESC';
        $criteria->with = array('categories') ;
        if(empty($full)){
        $criteria->select = 't.title,t.slug'; ;
		}else{
			     $criteria->select = 't.*';  
		}
        $criteria->condition = 't.status=:pub and  categories.category_id=:parent';
        
		$criteria->params[':parent']   = $id  ;
		//$criteria->params[':notin']   = $notid  ;
	    $criteria->together =true;
		$criteria->params[':pub']      = self::STATUS_PUBLISHED ;
        $criteria->limit = 10; 
       return  $this->findAll($criteria);
	}
	public function getPermalink($absolute = false)
    {
        return Yii::app()->apps->getAppUrl('frontend', $this->slug .'/blog', $absolute);
    }
     public function countryOption(){
		return array(
		'0' =>'All listing  countries',
		'1' =>'Only for selected countries',
		
		);
	}
    public function afterSave(){
		parent::aftersave();
		if(!$this->isNewRecord){
					BlogCountries::model()->deleteAllByAttributes(array('article_id'=>$this->primaryKey));
		}
		 
		$cn_model = new BlogCountries();
				if(!empty($this->listing_countries) and $this->show_all== '1'){
					foreach($this->listing_countries as $country){
						$cn_model_new = clone $cn_model;
						$cn_model_new->article_id    = $this->primaryKey;
						$cn_model_new->country_id    = $country;
						$cn_model_new->save();
						
					}
				}
					$this->getUpdateTag();
		return true; 
	}
	 public function getUpdateTag(){
		$array = array('title','content' );
		$relationID= $this->article_id;
		$relation  = 'article_id';$lan   =   'ar' ;
		 foreach($array as $field){
			 
				if(empty($this->$field)){ continue; }
				$id = 'BlogArticle_'.$field.'_'.$this->article_id ;
				
				$message = $this->getTranslateCurl($field);
				 
				if(empty($message)){ continue; }
				$model =   Translate::model()->findByAttributes(array('source_tag'=>$id));
				
				if($model){
				$variable =  TranslationData::model()->findByAttributes(array('lang'=>$lan,'translation_id'=>$model->primaryKey));
				if($variable){
					$model->translation = $message; 
				}
				}
				else{
					$model = new Translate();
				}
				 
				$model->lan  = 'ar' ;
				$model->source_tag  =  $id;
				$model->translation = $message;
				if($model->save()){
					 $data = 	TranslationData::model()->findByAttributes(array('lang'=>$lan,'translation_id'=>$model->primaryKey));
				  if($data){ 
						$data->message =  $message  ;
						$data->save();
						
				  }
				  else{
						$data = new TranslationData();
						$data->translation_id =  $model->primaryKey;
						$data->lang 		  =  $lan;
						$data->message 		  =   $message ; 
						$data->save();
				  }
				  $foundRelation = TranslateRelation::model()->findByAttributes(array('translate_id'=>$model->primaryKey ,$relation=>$relationID));
				  if(!$foundRelation){
						$saveRelation = new TranslateRelation();
						$saveRelation->$relation		= $relationID;
						$saveRelation->translate_id 	= $model->primaryKey;
						$saveRelation->rec				= 1;
						$saveRelation->save(false);
				  }
				}
				 
		 }
    }
    	public function   is_rtl( $string ) {
		$rtl_chars_pattern = '/[\x{0590}-\x{05ff}\x{0600}-\x{06ff}]/u';
		return preg_match($rtl_chars_pattern, $string);
	}
    	 public function getTranslateCurl($field){
			$handle = curl_init();

			if (FALSE === $handle)
			throw new Exception('failed to initialize');

			curl_setopt($handle, CURLOPT_URL,'https://www.googleapis.com/language/translate/v2');
			curl_setopt($handle, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
			 if($this->is_rtl($this->$field)  ){ $source = 'ar';$target = 'en';  }else{ $source = 'en';$target = 'ar';  }
			curl_setopt($handle, CURLOPT_POSTFIELDS, array('key'=> 'AIzaSyAR_JNtjus6l2meQne8BqyCrFWtOBioN5Y', 'format'=>'text','q' => $this->$field, 'source' => $source , 'target' => $target));
			curl_setopt($handle,CURLOPT_HTTPHEADER,array('X-HTTP-Method-Override: GET'));
			$response = curl_exec($handle);
            
			$data = json_decode($response,true); 
			if(isset($data['data']['translations']['0']['translatedText'])){
				return   $data['data']['translations']['0']['translatedText']; 
			}

	 }
	 
	
}
