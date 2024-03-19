<?php defined('MW_PATH') || exit('No direct script access allowed');

 
 
class Advertise_interestController extends Controller
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
    public function actionIndex()
    {
		// $this->layout = 'advertise';
		$model = new AdvertisementContact;
		$notify = Yii::app()->notify;
		if (isset($_POST['ajax'])) {
		echo CActiveForm::validate($model);
		Yii::app()->end();
		}
		$show = false ;
		if($notify->hasSuccess){
			$show = true ;  
		}
        if (Yii::app()->request->isPostRequest && ($attributes = (array)Yii::app()->request->getPost($model->modelName, array()))) {
		
		$model->attributes = $attributes;
		if($model->save())
		{
				  $notify->addSuccess(Yii::t('app', 'Your message was successfully sent to the {p} Support Team. One of our representative will contact you soon.'  ,array('{p}'=>$this->options->get('system.common.site_name') )));
				  $this->refresh() ;
					 
					 
		}
		else
		{
		 
		   $notify->addError(Yii::t('app',  'Please fix the following Errors' ));
		}
	    }
	 
       $this->setData(array(
            'pageTitle'     => 'Advertise with RGEstate - Reach Your Real Estate Audience Effectively', 
            'pageMetaDescription'   =>  'Leverage our platform to reach your target audience. Explore advertising opportunities with RGEstate and enhance your real estate brand\'s visibility.' , 
            'metaKeywords'   =>  'Advertise with RGEstate - Reach Your Real Estate Audience Effectively' , 
            'sticky_head'   => 'Banner Advertise' , 
        ));
        $this->render("index" , compact('model','show'));
    }
    
       public function actionBanner($position_id=null,$sector=null,$listing_type=null)
    {
		$position = BannerPosition::model()->findByPk($position_id);
		if(empty($position)){
			throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}
		$model = new BannerRequest;
		$model->position_id = $position->position_id;
		$model->section_id =$sector;
		$model->category_id =$listing_type;
		$notify = Yii::app()->notify;
		if (isset($_POST['ajax'])) {
			
		echo CActiveForm::validate($model);
		Yii::app()->end();
		}
		$show = false ;
		if($notify->hasSuccess){
			$show = true ;  
		}
        if (Yii::app()->request->isPostRequest && ($attributes = (array)Yii::app()->request->getPost($model->modelName, array()))) {
		
		$model->attributes = $attributes;
		 $uploadedFile=CUploadedFile::getInstance($model,'image');
            $fileName = rand(100,1000).$uploadedFile;
        
            if($uploadedFile)
            {	
				 
				$model->image = $fileName;
			}
		if($model->save())
		{
			 
				$options = $this->options; 
				 
			    $emailTemplate =  CustomerEmailTemplate::model()->getTemplateByUid("pm707mzq6t092");
			    $emailTemplate_customer =  CustomerEmailTemplate::model()->getTemplateByUid("gx06237qoaa7c");
			    $server = DeliveryServer::pickServer();  
				$emailTemplate_common = $options->get('system.email_templates.common');
				 
			    if($emailTemplate)
			    {
					$subject		= $emailTemplate->subject;
					$emailTemplate = $emailTemplate->content;
					$emailTemplate = str_replace('{name}',$model->name, $emailTemplate);
					$emailTemplate = str_replace('{phone}', $model->phone, $emailTemplate);
					$emailTemplate = str_replace('{email}', $model->email, $emailTemplate);
					$emailTemplate = str_replace('{url}',  '<a href="'.Yii::app()->apps->getAppUrl('backend', 'banner_request/update/id/'.$model->banner_id, true).'">View</ahref>' , $emailTemplate);
					//$emailTemplate = str_replace('{message}', nl2br($model->meassage), $emailTemplate);
					//$emailTemplate = str_replace('{subject}',  $model->city , $emailTemplate);
				
					$common_name =   $options->get('system.common.site_name');
					$emailTemplate = str_replace('[CONTENT]', $emailTemplate, $emailTemplate_common);
					$params = array(
					'to'            =>   Yii::app()->options->get('system.common.advertisement_email'),
					'fromName'      =>   $common_name,
					'subject'       =>	 $subject,
					'body'          =>   $emailTemplate,
					'mailerPlugins' => array(
					'logger'    => true,
					),
					);
				 	$status = 'S';
				 
					$adminEmail = new Email();			 
					$adminEmail->subject = $subject ;
					$adminEmail->message = $emailTemplate;
					$receipeints = serialize(array( Yii::app()->options->get('system.common.admin_email')));
					$adminEmail->status = $status;
					$adminEmail->receipeints = $receipeints;
					$adminEmail->sent_on =   1;
					$adminEmail->type =   'REGISTER';
					$adminEmail->sent_on_utc =   new CDbExpression('NOW()');
					$adminEmail->save(false); 
					$adminEmail->send;
				}
				if( $emailTemplate_customer){
					$subject		= $emailTemplate_customer->subject;
					$emailTemplate = $emailTemplate_customer->content;
					$common_name =   $options->get('system.common.site_name');
					$emailTemplate = str_replace('[NAME]',$model->name, $emailTemplate);
					$emailTemplate = str_replace('[CONTENT]', $emailTemplate, $emailTemplate_common);
					$params = array(
					'to'            =>   $model->email,
					'fromName'      =>   $common_name,
					'subject'       =>	 $subject,
					'body'          =>   $emailTemplate,
					'mailerPlugins' => array(
					'logger'    => true,
					),
					);
					
				 	$status = 'S';
				 
					$adminEmail = new Email();			 
					$adminEmail->subject = $subject ;
					$adminEmail->message = $emailTemplate;
					$receipeints = serialize(array($model->email));
					$adminEmail->status = $status;
					$adminEmail->receipeints = $receipeints;
					$adminEmail->sent_on =   1;
					$adminEmail->type =   'REGISTER';
					$adminEmail->sent_on_utc =   new CDbExpression('NOW()');
					$adminEmail->save(false); 
					$adminEmail->send;
				}
				 
				  $notify->addSuccess(Yii::t('app', 'Your message was successfully sent to the {p} Support Team. One of our representative will contact you soon.'  ,array('{p}'=>$this->project_name)));
				  $this->refresh() ;
					 
					 
		}
		else
		{
		 
		   $notify->addError(Yii::t('app',  'Please fix the following Errors' ));
		}
	    }
	 
      
           $this->setData(array(
            'pageTitle'     => 'Advertise with RGEstate - Reach Your Real Estate Audience Effectively', 
            'pageMetaDescription'   =>  'Leverage our platform to reach your target audience. Explore advertising opportunities with RGEstate and enhance your real estate brand\'s visibility.' , 
            'metaKeywords'   =>  'Advertise with RGEstate - Reach Your Real Estate Audience Effectively' , 
            'sticky_head'   => 'Banner Advertise' , 
        ));
           $this->getData('pageStyles')->mergeWith(array(
                array('src' => Yii::app()->apps->getBaseUrl('assets/css/jui-bs/jquery-ui-1.10.3.custom.css'), 'priority' => -1001),
            ));
            $this->layout ='advertisement';
        $this->render("banner" , compact('model','show','position'));
    }
    public function actionValidate(){
		$model = new AdvertisementContact();
		if (isset($_POST['ajax'])) {
		echo CActiveForm::validate($model);
		Yii::app()->end();
		}
	} 
		public function actionSend(){
		$request    = Yii::app()->request;
		$model  = new AdvertisementContact();
		if ($request->isPostRequest && ($attributes = (array)$request->getPost($model->modelName, array()))) {
			  $model->attributes = $attributes;
			  if(!$model->save()){
				  echo json_encode(array('status'=>'0','msg'=>'<div class="alert alert-danger1"><strong>Error!</strong> '.CHtml::errorSummary($model).'. </div>'));
				  Yii::app()->end();
			  }
			  else{
				  echo json_encode(array('status'=>'1','name'=>$model->name , 'msg'=>'<div class="alert alert-success"><strong>Success!</strong> Succesfully submited. </div>'));
				  Yii::app()->end();
			  }
		 
		}
	}
}
