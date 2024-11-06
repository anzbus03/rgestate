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
 
class ContactController extends Controller
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
 
        $this->boxshdw = '1';
    
   
		 $model = new ContactUs;
		   $notify = Yii::app()->notify;
		if (isset($_POST['ajax'])) {
		echo CActiveForm::validate($model);
		Yii::app()->end();
		}
        if (Yii::app()->request->isPostRequest && ($attributes = (array)Yii::app()->request->getPost($model->modelName, array()))) {
	
		$model->attributes = $attributes;
	if($model->save())
		{
		    	$options =Yii::app()->options;
			    $emailTemplate =  CustomerEmailTemplate::model()->getTemplateByUid("az3438eqlm2fc");;
			    $emailTemplate_customer =  CustomerEmailTemplate::model()->getTemplateByUid("gc385h18fmdcc");;
			     $emailTemplate_common = $model->commonTemplate()   ;
			     if($emailTemplate)
			    {
					if(!empty($emailTemplate->receiver_list)){
						$list_receivers = array_filter(explode(',',$emailTemplate->receiver_list));
					}
					$subject		= $emailTemplate->subject;
					$emailTemplate  = $emailTemplate->content;
					$emailTemplate = str_replace('{name}',$model->name, $emailTemplate);
					$emailTemplate = str_replace('{phone}', $model->phone, $emailTemplate);
					$emailTemplate = str_replace('{email}', $model->email, $emailTemplate);
					$emailTemplate = str_replace('{message}', nl2br($model->meassage), $emailTemplate);
					//$emailTemplate = str_replace('{subject}',  $model->city , $emailTemplate);					 
					$emailTemplate = str_replace('[CONTENT]', $emailTemplate, $emailTemplate_common);
					$status = 'S'; 
					$adminEmail = new Email();			 
					$adminEmail->subject = $subject ;
					$adminEmail->message = $emailTemplate;
					if(!empty($list_receivers)){
						$receipeints = serialize($list_receivers);
					}
					else{
						$receipeints = serialize(array($options->get('system.common.admin_email')));
					}
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
					$emailTemplate = str_replace('[NAME]',$model->name, $emailTemplate);
					//$emailTemplate = str_replace('[CONTENT]', $emailTemplate, $emailTemplate_common);
				 
					
				    $status = 'S'; 
					$adminEmail = new Email();			 
					$adminEmail->subject = $subject ;
					$adminEmail->message =   Yii::t('app',$emailTemplate_common, array('[CONTENT]'=>$emailTemplate));  
					$receipeints = serialize(array($model->email));
					$adminEmail->status = $status;
					$adminEmail->receipeints = $receipeints;
					$adminEmail->sent_on =   1;
					$adminEmail->type =   'REGISTER';
					$adminEmail->sent_on_utc =   new CDbExpression('NOW()');
					$adminEmail->save(false); 
					$adminEmail->send;
				}
				//$notify->addSuccess(Yii::t('app','Your message was successfully sent to the {p} Support Team. One of our representative will contact you soon.'  ,array('{p}'=>$options->get('system.common.site_name'))));
				$this->redirect(Yii::app()->CreateUrl('contact/success')) ;
		}
		else
		{
		 
		   $notify->addError(Yii::t('app', 'Please fix the following Errors'));
		}
	    }
		 
 
        $this->setData(array(
            'pageMetaTitle'     =>Yii::app()->options->get('system.common.site_name').' | '.Yii::t('articles', 'Contact Us'), 
            'pageBreadcrumbs'   => array()
        ));
        $this->setData(array(
            'pageTitle'     =>'RGEstate By Riveria Global Group - Reach Out to Our Real Estate Experts Today!', 
            'pageMetaDescription'   => 'Get in touch with RGEstate\'s experienced team for all your real estate needs. Whether you\'re buying, selling, or just have questions, our experts are here to help. Contact us today.', 
            'metaKeywords'   => 'Contact Us', 
        ));

        $this->render("index" , compact('model'));
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
    
   public function actionValidate(){
		$model = new ContactUs();
		if (isset($_POST['ajax'])) {
		echo CActiveForm::validate($model);
		Yii::app()->end();
		}
	} 
	public function actionSend(){
		$request    = Yii::app()->request;
		$requestParms = $request->getPost("ContactUs");
		$model  = new ContactUs();
		if ($request->isPostRequest && ($attributes = (array)$request->getPost($model->modelName, array()))) {
			  $model->attributes = $attributes;
		}
		
		// Firstly get the customer id from the crm
		$customersUrl = 'https://crm.rgestate.com/rest/158/x0g9p2hpse2h48si/crm.contact.list.json?select[]=EMAIL&order["DATE_CREATE"]=DESC';
		
		$contextCustomerOptions = [
            'http' => [
                'method' => 'GET',
                'header' => 'Content-Type: application/x-www-form-urlencoded',
            ],
        ];
        $contextCustomers = stream_context_create($contextCustomerOptions);
        $customerId = 0;
        /*
            This code is commented because it checks if customer already exists then get its id
            Currently this method is so slow we will refactor later to a faster method
        */
        // $attemptCount = 0;
//         do {
//     		try {
//                 // Send the HTTP request using file_get_contents
//                 $nextUrl = $customersUrl . '&start=' . $customerId;
            
//                 // Send the HTTP request using file_get_contents
//                 $data = file_get_contents($nextUrl, false, stream_context_create($contextCustomerOptions));
//                 $response = json_decode($data, true);
//         		// Loop through the result
//                 foreach ($response['result'] as $contact) {
//                     if (isset($contact['EMAIL'])) {
//                         foreach ($contact['EMAIL'] as $email) {
//                             if ($email['VALUE'] === $requestParms['email']) {
//                                 $customerId = $contact['ID'];
//                                 break 3;
//                             }
//                         }
//                     }
//                 }
//                 $customerId = $response['next'] ?? 0;
//                 $attemptCount++;

//             } catch (Exception $e) {
//                 // Handle exceptions, e.g., connection errors
//     				echo json_encode(array('status'=>'0','msg'=>'<div class="alert alert-danger1"><strong>Error!</strong> '.CHtml::errorSummary($e->getMessage()).'. </div>'));
//             }
    	    
//     	} while (isset($response['next']) && $response['next'] > 0 && $attemptCount < 2);
// 		// Check if the customer does not exist we need to send a request with the new customer details to create new one
// 		if ($customerId == 0){

	    $createCustomerUrl = 'https://crm.rgestate.com/rest/158/x0g9p2hpse2h48si/crm.contact.add.json';
    		    
        // Prepare data for the request
        $fullName = $requestParms['name'];
        
        // Split the full name into an array using spaces as the delimiter
        $nameParts = explode(' ', $fullName);
        
        // Extract the first and last names
        $firstName = isset($nameParts[0]) ? $nameParts[0] : null;
        $lastName = isset($nameParts[1]) ? $nameParts[1] : null;

        $crmCustomerData = [
            'fields' => [
                'NAME' => $firstName,
                'SECOND_NAME' => $lastName,
                "TYPE_ID" => "CLIENT",
                "SOURCE_ID" => "SELF",
                "EMAIL" => [[ "VALUE" => $requestParms['email'], "VALUE_TYPE" => "WORK" ]],
                "PHONE" => [[ "VALUE" => $requestParms['phone'], "VALUE_TYPE" => "WORK" ]]
            ],
        ];
        $postCustomerData = http_build_query($crmCustomerData);
        $contextCusotomerOptions = [
            'http' => [
                'method' => 'POST',
                'header' => 'Content-Type: application/x-www-form-urlencoded',
                'content' => $postCustomerData,
            ],
        ];
        $contextCreateCustomer = stream_context_create($contextCusotomerOptions);
    	try {
            // Send the HTTP request using file_get_contents
            $data = file_get_contents($createCustomerUrl, false, $contextCreateCustomer);
            $response = json_decode($data, true);
            $customerId = $response['result'];
            // Handle the CRM response as needed

        } catch (Exception $e) {
            // Handle exceptions, e.g., connection errors
				echo json_encode(array('status'=>'0','msg'=>'<div class="alert alert-danger1"><strong>Error!</strong> '.CHtml::errorSummary($e->getMessage()).'. </div>'));
        }
		
		$crmUrl = 'https://crm.rgestate.com/rest/158/x0g9p2hpse2h48si/crm.lead.add.json';

        // Prepare data for the request
        $crmData = [
            'FIELDS' => [
                'TITLE' => 'RGestate Lead - Contact Form',
                'CATEGORY_ID' => 16,
                'PHONE' => [[ "VALUE" => $requestParms['phone'], "VALUE_TYPE" => "WORK" ]],
                "EMAIL" => [[ "VALUE" => $requestParms['email'], "VALUE_TYPE" => "WORK" ]],
                'LEAD_LAST_NAME' => $lastName,
                'LEAD_NAME' => $firstName,
                'LEAD_EMAIL' => $requestParms['email'],
                'CONTACT_ID' => $customerId,
                'COMMENTS' => $requestParms['meassage'],
                'ASSIGNED_BY_ID' => 22
            ],
        ];

        // Convert data to a query string
        $postData = http_build_query($crmData);

        // Set up options for the stream context
        $contextOptions = [
            'http' => [
                'method' => 'POST',
                'header' => 'Content-Type: application/x-www-form-urlencoded',
                'content' => $postData,
            ],
        ];

        $context = stream_context_create($contextOptions);


		try {
            // Send the HTTP request using file_get_contents
            $response = file_get_contents($crmUrl, false, $context);
           
            // Handle the CRM response as needed

        } catch (Exception $e) {
            // Handle exceptions, e.g., connection errors
          
				echo json_encode(array('status'=>'0','msg'=>'<div class="alert alert-danger1"><strong>Error!</strong> '.CHtml::errorSummary($e->getMessage()).'. </div>'));
        }
        if ($model->hasErrors()) {
			echo json_encode(array('status'=>'0','msg'=>'<div class="alert alert-danger1"><strong>Error!</strong> '.CHtml::errorSummary($model).'. </div>'));
        } else {
            if(!$model->save()){
				echo json_encode(array('status'=>'0','msg'=>'<div class="alert alert-danger1"><strong>Error!</strong> '.CHtml::errorSummary($model).'. </div>'));
			}else{
				echo json_encode(array('status'=>'1','email'=>$model->name ,'name'=>$model->email , 'msg'=>'<div class="alert alert-success"><strong>Success!</strong> Succesfully submited. </div>'));
		    }
        }

        // End the request to prevent any further output
         Yii::app()->end();
	}
}
