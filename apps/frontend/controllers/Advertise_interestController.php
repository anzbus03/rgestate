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
		$this->layout = 'advertise';
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
				$options = $this->options; 
			    $emailTemplate =  CustomerEmailTemplate::model()->getTemplateByUid("dw607ztgc99ff");
			    
		
			    
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
				
					$common_name =   $this->options->get('system.common.site_name');
					$emailTemplate = str_replace('[CONTENT]', $emailTemplate, $emailTemplate_common);
					
						
					$params = array(
					'to'            =>   Yii::app()->options->get('system.common.admin_email','advertise@askaan.com'),
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
					$receipeints = serialize(array( Yii::app()->options->get('system.common.admin_email','advertise@askaan.com')));
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
					$common_name =   $this->options->get('system.common.site_name');
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
    
   
}
