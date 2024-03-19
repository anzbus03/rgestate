<?php defined('MW_PATH') || exit('No direct script access allowed');
 
class DetailController extends Controller
{
   
	public function init(){
	 
	  parent::Init();
      
    }
 
    public function actionIndex($slug=null)
    {  		
		    $criteria=new CDbCriteria;
			$criteria->select = 't.*,sec.slug as sec_slug,con.country_name as country_name,sub_com.sub_community_name as sub_community_name,st.slug as state_slug,cat.category_name as  category_name,sub.sub_category_name as sub_category_name,usr.description as user_description,usr.image as user_image,usr.first_name,usr.last_name,usr.phone as user_number,usr.address as user_address,usr.user_type as user_type,sec.section_name,st.state_name as state_name,com.community_name,(SELECT image_name FROM {{ad_image}} img  WHERE  img.ad_id = t.id and  img.status="A" and  img.isTrash="0" limit 1 )   as ad_image';
			$criteria->condition = '1';
			if(Yii::app()->request->getQuery('showTrash','0')=='0'){
		    	$criteria->compare('t.isTrash','0');
				$criteria->compare('t.status','A');
			}
		 
		
			$criteria->join  .= ' left join {{section}} sec ON sec.section_id = t.section_id ';
			$criteria->join  .= ' left join {{category}} cat ON cat.category_id = t.category_id ';
			$criteria->join  .= ' left join {{subcategory}} sub ON sub.sub_category_id = t.sub_category_id ';
			$criteria->join  .= ' left join {{community}} com ON com.community_id = t.community_id ';
			$criteria->join  .= ' left join {{sub_community}} sub_com ON sub_com.sub_community_id = t.sub_community_id ';
			$criteria->join  .= ' left join {{states}} st ON st.state_id = t.state ';
			$criteria->join  .= ' left join {{countries}} con ON con.country_id = t.country ';
			$criteria->join  .=   ' INNER JOIN {{listing_users}} usr on usr.user_id = t.user_id ';
			if(Yii::app()->user->getId()){
			$criteria->select .= ' ,fav.ad_id as fav ';
			$criteria->join  .= ' left join {{ad_favourite}} fav ON fav.ad_id = t.id and fav.user_id =:user_me';
			$criteria->params[':user_me'] = Yii::app()->user->getId();
			}
			$criteria->condition .= ' and usr.status = "A" and usr.isTrash="0"' ;
			$criteria->condition .= ' and t.slug=:slug ' ;
			$criteria->params[':slug'] = $slug;
			$model = PlaceAnAd::model()->find($criteria);
			if(empty($model)){
				throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
			}
	    	$this->getData('pageStyles')->mergeWith(array(
                array('src' => $this->appAssetUrl('css/property-web.css') , 'priority' => '1'),
                array('src' => $this->appAssetUrl('css/icons.css') , 'priority' => '9' ),
                array('src' => $this->appAssetUrl('css/search-web.css') , 'priority' =>'2' ),
                array('src' => $this->appAssetUrl('css/inner-style.css') , 'priority' =>'3' ),
                array('src' => $this->appAssetUrl('css/main11.css') , 'priority' =>'4' ),
            ));
 
          $this->getData('pageScripts')->add(array('src' => $this->appAssetUrl('scripts/_right_detail1.js'), 'priority' => -100));   
          $this->getData('pageScripts')->add(array('src' => $this->appAssetUrl('scripts/owl.carousel.min.js'), 'priority' => -100));   
			$this->setData(array(
                    'pageTitle'         => Yii::t('app', '{name}', array('{name}' =>!empty($model->meta_title) ? $model->meta_title : $model->ad_title   ,'{p}'=> $this->options->get('system.common.site_name'))), 
                      'pageMetaDescription'   => !empty($model->meta_description) ? $model->meta_description : StringHelper::truncateLength($model->ad_description, 150) ,
                  
                    'image'   =>     $model->ad_image ,
                    'title'   =>   $model->ad_title ,
                      'shareUrl' => $model->detailUrlAbsolute,
                    'description'   =>   $model->ShortDescription ,
                ));
		 $floor = $model->adFloorPlans;
		 $this->render( 'index',compact('model','floor'));
    }
    
    public function actionProject($slug=null)
    {  		
		    $criteria=new CDbCriteria;
			$criteria->select = 't.*,sec.slug as sec_slug,con.country_name as country_name,sub_com.sub_community_name as sub_community_name,st.slug as state_slug,cat.category_name as  category_name,sub.sub_category_name as sub_category_name,usr.description as user_description,usr.image as user_image,usr.first_name,usr.last_name,usr.description as user_description,usr.phone as user_number,usr.email as user_email,usr.company_name as company_name,usr.website as user_website,usr.address as user_address,usr.user_type as user_type,usr.slug as user_slug,sec.section_name,st.state_name as state_name,com.community_name,(SELECT image_name FROM {{ad_image}} img  WHERE  img.ad_id = t.id and  img.status="A" and  img.isTrash="0" limit 1 )   as ad_image';
		 	$criteria->condition = '1';
		 	if(Yii::app()->request->getQuery('showTrash','0')=='0'){
			$criteria->compare('t.isTrash','0');  
			$criteria->compare('t.status','A');
			}
			$criteria->join  .= ' left join {{section}} sec ON sec.section_id = t.section_id ';
			$criteria->join  .= ' left join {{category}} cat ON cat.category_id = t.category_id ';
			$criteria->join  .= ' left join {{subcategory}} sub ON sub.sub_category_id = t.sub_category_id ';
			$criteria->join  .= ' left join {{community}} com ON com.community_id = t.community_id ';
			$criteria->join  .= ' left join {{sub_community}} sub_com ON sub_com.sub_community_id = t.sub_community_id ';
			$criteria->join  .= ' left join {{states}} st ON st.state_id = t.state ';
			$criteria->join  .= ' left join {{countries}} con ON con.country_id = t.country ';
			$criteria->join  .=   ' INNER JOIN {{listing_users}} usr on usr.user_id = t.user_id ';
			$criteria->condition .= ' and usr.status = "A" and usr.isTrash="0"' ;
			$criteria->condition .= ' and t.slug=:slug ' ;
			if(Yii::app()->user->getId()){
			$criteria->select .= ' ,fav.ad_id as fav ';
			$criteria->join  .= ' left join {{ad_favourite}} fav ON fav.ad_id = t.id and fav.user_id =:user_me';
			$criteria->params[':user_me'] = Yii::app()->user->getId();
			}
			$criteria->params[':slug'] = $slug;
			$model = PlaceAnAd::model()->find($criteria);
			if(empty($model)){
				throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
			}
			
			$apps = Yii::app()->apps;
				$this->getData('pageStyles')->mergeWith(array(
                array('src' => $this->appAssetUrl('css/property-web.css') , 'priority' => '1'),
                array('src' => $this->appAssetUrl('css/icons.css') , 'priority' => '9' ),
                array('src' =>  $apps->getBaseUrl('assets/css/fancybox/style.css?q=2') , 'priority' => '9' ),
                array('src' =>  $apps->getBaseUrl('assets/css/fancybox/jquery.fancybox-1.3.4.css') , 'priority' => '9' ),
                array('src' =>  $this->appAssetUrl('css/zerogrid.css') , 'priority' => '9' ),
               ));
			$this->getData('pageScripts')->add(array('src' => $this->appAssetUrl('scripts/map_detail.js'), 'priority' => -100));   
			$this->getData('pageScripts')->add(array('src' => $this->appAssetUrl('scripts/jquery.mixitup.min.js'), 'priority' => -100));   
			$this->getData('pageScripts')->add(array('src' => $this->appAssetUrl('scripts/swiper.min.js'), 'priority' => -100));   
			$this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('assets/css/fancybox/jquery.fancybox.pack.js'), 'priority' => -100));   
			$this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('assets/css/fancybox/jquery.fancybox-media.js'), 'priority' => -100));   
			$this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('assets/css/fancybox/jquery.fancybox-thumbs.js'), 'priority' => -100));   
			$floor = $model->adFloorPlans;
         	$this->setData(array(
                    'pageTitle'         => Yii::t('app', '{name}', array('{name}' =>!empty($model->meta_title) ? $model->meta_title : $model->ad_title   ,'{p}'=> $this->options->get('system.common.site_name'))), 
                    'pageMetaDescription'   => !empty($model->meta_description) ? $model->meta_description : StringHelper::truncateLength($model->ad_description, 150) ,
                   
                     'image'   =>     $model->ad_image ,
                    'title'   =>   $model->ad_title ,
                    'shareUrl' => $model->detailUrlAbsolute,
                    'description'   =>   $model->ShortDescription ,
                     
                ));
	
		$this->render( 'index_project',compact('model','floor'));
		//$this->render( 'index',compact('model'));
    }
    public function actionValidateEnquiry(){
		$model = new SendEnquiry;
		if (isset($_POST['ajax'])) {
		echo CActiveForm::validate($model);
		Yii::app()->end();
		}
	} 
		public function actionSendEnquiry(){
		$request    = Yii::app()->request;
		$model  = new SendEnquiry();
		if ($request->isPostRequest && ($attributes = (array)$request->getPost($model->modelName, array()))) {
			  $model->attributes = $attributes;
			  if(!$model->save()){
				  echo json_encode(array('status'=>'0','msg'=>'<div class="alert alert-danger"><strong>Error!</strong> '.CHtml::errorSummary($model).'. </div>'));
				  Yii::app()->end();
			  }
			  else{
				  echo json_encode(array('status'=>'1','msg'=>'<div class="alert alert-success"><strong>Success!</strong> Succesfully submited. </div>'));
				  Yii::app()->end();
			  }
		 
		}
	}
    public function actionValidateEnquiry2(){
		$model = new SendEnquiry2;
		if (isset($_POST['ajax'])) {
		echo CActiveForm::validate($model);
		Yii::app()->end();
		}
	} 
		public function actionSendEnquiry2(){
		$request    = Yii::app()->request;
		$model  = new SendEnquiry2();

		if ($request->isPostRequest && ($attributes = (array)$request->getPost($model->modelName, array()))) {
			  $model->attributes = $attributes;
			  if(!$model->save()){
				  echo json_encode(array('status'=>'0','msg'=>'<div class="alert alert-danger"><strong>Error!</strong> '.CHtml::errorSummary($model).'. </div>'));
				  Yii::app()->end();
			  }
			  else{
				  echo json_encode(array('status'=>'1','msg'=>'<div class="alert alert-success"><strong>Success!</strong> Succesfully submited. </div>'));
				  Yii::app()->end();
			  }
		 
		}
	}
}
