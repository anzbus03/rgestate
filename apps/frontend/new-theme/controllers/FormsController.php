<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * ArticlesController
 * 
 * Handles the actions for artciles related tasks
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2014 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 * @since 1.0
 */
 
class FormsController  extends Controller
{
    /**
     * List available published articles 
     */
      public $headerImage;
  public function init(){
	 parent::init();
        // register class paths for extension captcha extended
        Yii::$classMap = array_merge( Yii::$classMap, array(
            'CaptchaExtendedAction' => Yii::getPathOfAlias('root.apps.extensions.captchaExtended').DIRECTORY_SEPARATOR.'CaptchaExtendedAction.php',
            'CaptchaExtendedValidator' => Yii::getPathOfAlias('root.apps.extensions.captchaExtended').DIRECTORY_SEPARATOR.'CaptchaExtendedValidator.php'
        ));
    }
    public function actionMortgage()
    {	
		$this->boxshdw = '1';
		 $model = new ApplyLoan;
		   $notify = Yii::app()->notify;
		if (isset($_POST['ajax'])) {
		echo CActiveForm::validate($model);
		Yii::app()->end();
		}
          
        $this->sec_id = 'mortgage' ;
        $this->setData(array(
            'pageMetaTitle'     =>Yii::app()->options->get('system.common.site_name').' | '.Yii::t('articles', 'Contact Us'), 
            'pageBreadcrumbs'   => array()
        ));
           $this->setData(array(
            'pageTitle'     =>$this->tag->getTag('mortgage_calculator','Mortgage Calculator'), 
            'pageMetaDescription'   => 'Questions or comments? We can help you. Reach us today or email at office@askaan.com', 
            'metaKeywords'   => 'Contact Us', 
        ));
$bankModel = Bank::model()->findByBankId(1);
  $banks = Bank::model()->ListData();
		 
		
        $this->render("mortgage" , compact('model','bankModel','banks'));
    }
    public function actionMortgage_calculator()
    {	
		$this->boxshdw = '1';
		$this->no_header = '1'; 
       
        $this->setData(array(
            'pageTitle'     =>'RGEstate By Riveria Global Group - Reach Out to Our Real Estate Experts Today!', 
            'pageMetaDescription'   => 'Get in touch with RGEstate\'s experienced team for all your real estate needs. Whether you\'re buying, selling, or just have questions, our experts are here to help. Contact us today.', 
            'metaKeywords'   => 'Contact Us', 
        ));
 $banks = Bank::model()->ListData();
		
        $this->render("mortgage_calculator" , compact('model','bankModel','banks'));
    }
    
    public function actionSuccess()
    {  
 
        $this->setData(array(
            'pageMetaTitle'     =>Yii::app()->options->get('system.common.site_name').' | '.Yii::t('articles', 'Contact Us'), 
            'pageBreadcrumbs'   => array()
        ));
        $this->setData(array(
            'pageTitle'     =>'RGEstate By Riveria Global Group - Reach Out to Our Real Estate Experts Today!', 
            'pageMetaDescription'   => 'Get in touch with RGEstate\'s experienced team for all your real estate needs. Whether you\'re buying, selling, or just have questions, our experts are here to help. Contact us today.', 
            'metaKeywords'   => 'Contact Us', 
        ));

        $this->render("success"  );
    }
    
    public function actionInsurance($slug=null,$property_id=null)
    {	
		
		$HomeInsuraceCompany = HomeInsuraceCompany::model()->ListData();
		if (empty($HomeInsuraceCompany)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
     
       
        
        
		$this->boxshdw = '1'; $this->sec_id = '' ;
		 $model = new InsuranceForm1;
		 
		  if(!empty($property_id)){
			$model->scenario = 'ask_insurance';
			$model->property_id = $property_id;
			 $this->no_header = '1';
			 
		}
		   $notify = Yii::app()->notify;
		if (isset($_POST['ajax'])) {
		echo CActiveForm::validate($model);
		Yii::app()->end();
		}
         
        $this->sec_id = 'Home_Insurance' ;
        $this->setData(array(
            'pageMetaTitle'     =>Yii::app()->options->get('system.common.site_name').' | '.Yii::t('articles', 'Contact Us'), 
            'pageBreadcrumbs'   => array()
        ));
           $this->setData(array(
            'pageTitle'     => $this->tag->getTag('home_insurance','Home Insurance'), 
            'pageMetaDescription'   => 'Questions or comments? We can help you. Reach us today or email at office@askaan.com', 
            'metaKeywords'   => 'Contact Us', 
        ));
        if(Yii::app()->user->getId()){
            
            	$model->f_name = $this->mem->fullName; 	$model->email = $this->mem->email; 	$model->phone_false = $this->mem->full_number; 
        }
  
		if($model->scenario=='ask_insurance'){ 
			$this->render("ask_insurance_property" , compact('model','HomeInsuraceCompany','slug'));
		}
		else{
			$this->render("insurance" , compact('model','HomeInsuraceCompany','slug'));
		}
		
        
    }
    
    
    
    
   public function actionValidateInsurance(){
		$model = new InsuranceForm1;
		if (isset($_POST['ajax'])) {
		echo CActiveForm::validate($model);
		Yii::app()->end();
		}
	} 
   public function actionValidateInsurance_ask(){
		$model = new InsuranceForm1;
		$model->scenario = 'ask_insurance';
		if (isset($_POST['ajax'])) {
		echo CActiveForm::validate($model);
		Yii::app()->end();
		}
	} 
 
		public function actionSendInsurance(){
		$request    = Yii::app()->request;
		$model  = new InsuranceForm1();
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
		public function actionSendInsurance_ask(){
		$request    = Yii::app()->request;
		$model  = new InsuranceForm1();
		$model->scenario = 'ask_insurance';
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
	
	
   public function actionValidateValuation(){
		$model = new PropertyValuation;
		if (isset($_POST['ajax'])) {
		echo CActiveForm::validate($model);
		Yii::app()->end();
		}
	} 
   public function actionValidateValuation_ask(){
		$model = new PropertyValuation;
		$model->scenario = 'ask_valuation';
		if (isset($_POST['ajax'])) {
		echo CActiveForm::validate($model);
		Yii::app()->end();
		}
	} 
		public function actionSendValuation(){
		$request    = Yii::app()->request;
		$model  = new PropertyValuation();
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
		public function actionSendValuation_ask(){
		$request    = Yii::app()->request;
		$model  = new PropertyValuation();
		$model->scenario = 'ask_valuation';
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
	
	
	 public function actionProperty_valuation($slug=null,$property_id=null)
    {	
		
		 $HomeInsuraceCompany = ValuationCompany::model()->ListData();
 if (empty($HomeInsuraceCompany)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
		$this->boxshdw = '1'; $this->sec_id = '' ;
		 $model = new PropertyValuation;
		 
		 if(!empty($property_id)){
			$model->scenario = 'ask_valuation';
			$model->property_id = $property_id;
			 $this->no_header = '1';
			 
		}
		
		   $notify = Yii::app()->notify;
		if (isset($_POST['ajax'])) {
		echo CActiveForm::validate($model);
		Yii::app()->end();
		}
          
        $this->sec_id = 'Property_Valuation' ;
        $this->setData(array(
            'pageMetaTitle'     =>Yii::app()->options->get('system.common.site_name').' | '.Yii::t('articles', 'Contact Us'), 
            'pageBreadcrumbs'   => array()
        ));
           $this->setData(array(
            'pageTitle'     => $this->tag->getTag('property_valuation_form','Property Valuation Form'), 
            'pageMetaDescription'   => $this->tag->getTag('calculate_property_valuation_o','Calculate property valuation online &amp; get right price of your property. Estimate Property market value for investment. Real Estate Calculator will help you to buy/ sale property.'), 
            'metaKeywords'   => 'Property Valuation', 
        ));
  if(Yii::app()->user->getId()){
            
            	$model->f_name = $this->mem->fullName; 	$model->email = $this->mem->email; 	$model->phone_false = $this->mem->full_number; 
        }
		if($model->scenario=='ask_valuation'){ 
			$this->render("ask_valuation" , compact('model','HomeInsuraceCompany','slug'));
		}
		else{
		$apps = $this->app->apps;
		$this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('assets/js/dropzone.min.js') ));
		$this->getData('pageStyles')->add(array('src' =>$apps->getBaseUrl('backend/assets/css/dropzone.css')));
        $this->render("valuation" , compact('model','HomeInsuraceCompany','slug'));
		}
    }
     public function actionReview_agent($slug=null)
    {	
		
		  $criteria=new CDbCriteria;
			$criteria->select = 't.*,cn.country_name,st.state_name,st.slug as state_slug , p_usr.company_name as parent_company , p_usr.slug as parent_slug  ';
			$criteria->select .= ',(select COALESCE(count(ad.id),0) from {{place_an_ad}} ad where t.user_id = ad.user_id and ad.status="A" and ad.isTrash="0" and ad.section_id = "1" ) as sale_total';
				$criteria->select .= ',(select COALESCE(count(ad.id),0) from {{place_an_ad}} ad where t.user_id = ad.user_id and ad.status="A" and ad.isTrash="0" and ad.section_id =  "2" ) as rent_total';
				
			$criteria->compare('t.isTrash','0');
			$criteria->compare('t.status','A');
			$criteria->compare('t.user_type!','U');
			$criteria->condition .= ' and t.slug=:slug ' ;
			$criteria->join  .= ' left join {{countries}} cn ON cn.country_id = t.country_id ';
			$criteria->join  .= ' left join {{states}} st ON st.state_id = t.state_id ';
			$criteria->join  .=   ' LEFT JOIN {{listing_users}} p_usr on p_usr.user_id = t.parent_user ';
			$criteria->join   .= ' LEFT JOIN {{master}} des on des.master_id = t.role_id    ';
        	$criteria->select .= ',des.master_name as role_id';
			$criteria->params[':slug'] = $slug;
			if(defined('LANGUAGE')){
			$langaugae = LANGUAGE;
			if(!empty($langaugae) and  $langaugae != 'en'){
				 
 	        $criteria->join  .= ' left join `mw_translate_relation` `translationRelation9` on translationRelation9.master_id = t.role_id   LEFT  JOIN mw_translation_data tdata9 ON (`translationRelation9`.translate_id=tdata9.translation_id and tdata9.lang=:lan) ';
			$criteria->select .= ' ,CASE WHEN tdata9.message IS NOT NULL THEN tdata9.message ELSE des.master_name END as  role_id  ';
			$criteria->select .= ' ,CASE WHEN p_usr.company_name_ar IS NOT NULL THEN  p_usr.company_name_ar ELSE  p_usr.company_name END as parent_company  ';
		
				$criteria->distinct   = 't.id';
				$criteria->params[':lan'] = $langaugae;
				
			}
			}
			$agentmodel = Agents::model()->find($criteria);
	 
		if (empty($agentmodel)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
		$this->boxshdw = '1'; $this->sec_id = '' ;
		 $model = new AgentReview;
		 
		 
		   $notify = Yii::app()->notify;
		if (isset($_POST['ajax'])) {
		echo CActiveForm::validate($model);
		Yii::app()->end();
		}
          
          $this->setData(array(
            'pageMetaTitle'     =>Yii::app()->options->get('system.common.site_name').' | '.Yii::t('articles', 'Agent Review'), 
            'pageBreadcrumbs'   => array()
        ));
           $this->setData(array(
            'pageTitle'     => $this->tag->getTag('agent_review','Agent Review'), 
            'pageMetaDescription'   => $this->tag->getTag('agent_review','Agent Review'), 
            'metaKeywords'   => 'Agent Review', 
        ));
		if(Yii::app()->user->getId()){
            
            	$model->name = $this->mem->fullName; 	$model->email = $this->mem->email; 	$model->phone_false = $this->mem->full_number; 
        }
		 
		$apps = $this->app->apps;
        $this->render("review" , compact('model','HomeInsuraceCompany','slug','agentmodel'));
		 
    }
    
		public function actionSendReview(){
		$request    = Yii::app()->request;
		$model  = new AgentReview();
		if ($request->isPostRequest && ($attributes = (array)$request->getPost($model->modelName, array()))) {
			  $model->attributes = $attributes;
			  $model->phone = $model->phone_false; 
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
	  public function actionValidateReview(){
		$model = new AgentReview;
		if (isset($_POST['ajax'])) {
		echo CActiveForm::validate($model);
		Yii::app()->end();
		}
	} 
	public function actionValidateInsurance2(){
		$model = new Lonsdale;
		if (isset($_POST['ajax'])) {
		echo CActiveForm::validate($model);
		Yii::app()->end();
		}
	}
	public function actionSendInsurance2(){
		$request    = Yii::app()->request;
		$model  = new Lonsdale();
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
